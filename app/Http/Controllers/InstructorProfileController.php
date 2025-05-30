<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InstructorProfileController extends Controller
{
    /**
     * Display the instructor profile page
     */
    public function index()
    {
        // Get the instructor with their associated user data
        $instructor = Instructor::where('user_id', Auth::id())
            ->with('user')
            ->first();

        if (!$instructor) {
            // Create an empty instructor profile if none exists
            $instructor = new Instructor();
            $instructor->user_id = Auth::id();
        }

        return view('instructor.profile', compact('instructor'));
    }

    /**
     * Update the instructor's profile
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'before:today'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:10'],
            'bsn' => ['required', 'string', 'min:8', 'max:9', 'regex:/^[0-9]{8,9}$/'],
        ], [
            'bsn.regex' => 'The BSN number must be 8 or 9 digits.'
        ]);

        // Update user data
        $user = Auth::user();
        $user->update([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'birthdate' => $validated['birthdate'],
        ]);

        // Update or create instructor data
        Instructor::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'bsn' => $validated['bsn'],
            ]
        );

        return redirect()->route('instructor.profile')->with('success', 'Profile updated successfully!');
    }
}
