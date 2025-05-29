<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Only validate email initially
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        ]);

        // Generate a temporary username and random values for required fields
        $username = explode('@', $request->email)[0] . '_' . Str::random(5);

        // Create user with temporary values
        $user = User::create([
            'firstname' => 'Temporary', // Will be updated later
            'lastname' => 'User', // Will be updated later
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make(Str::random(32)), // Temporary password
            'role_id' => 1, // Student role
            'birthdate' => '2000-01-01', // Default birthdate, will be updated later
        ]);

        // Create a student record for this user
        Student::create([
            'user_id' => $user->id,
            'relation_number' => Str::random(10), // Random registration number
        ]);


        event(new Registered($user));

        // Redirect to confirmation page with the email in session
        return redirect()->route('registration.confirmation')->with('registered_email', $request->email);
    }

    /**
     * Display the password setup form.
     */
    public function showSetPasswordForm(Request $request, string $id, string $hash): View
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('status', 'Your email has already been verified and account activated.');
        }

        return view('auth.set-password', ['id' => $id, 'hash' => $hash, 'email' => $request->email]);
    }

    /**
     * Handle the password setup.
     */
    public function setPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required'],
            'hash' => ['required'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $request->id],
            'birthdate' => ['required', 'date', 'before:today'],
            'password' => ['required', 'confirmed', 'min:12', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[^A-Za-z0-9]/'],
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one number, and one special character.',
        ]);

        $user = User::findOrFail($request->id);

        if (!hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        // Update user data with all the information from the second form
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->birthdate = $request->birthdate;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();

        // Update the student record with any additional information if provided
        if ($student = $user->student) {
            // You could add additional fields here if you collect them in the form
            $student->save();
        }

        Auth::login($user);

        return redirect()->route('student.dashboard')->with('status', 'Account activated successfully! Welcome to KitesurfingVS.');
    }

    /**
     * Show the email confirmation page after registration.
     */
    public function showConfirmation(): View
    {
        return view('auth.email-confirmation');
    }

    /**
     * Resend the verification email.
     */
    public function resendVerificationEmail(Request $request): RedirectResponse
    {
        $email = session('registered_email') ?? $request->email;

        if (!$email) {
            return back()->withErrors(['email' => 'Email address is required']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('status', 'Email already verified. Please login to continue.');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'Verification link sent!');
    }
}
