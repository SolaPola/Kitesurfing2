<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::with('role')->paginate(10); // Change to paginate instead of get()
        return view('accounts.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Validate the base user data
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'infix' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required|exists:roles,id',
            // is_active validation removed
        ]);

        // Generate a random password
        $password = Str::random(10);

        // Create the user
        $user = User::create([
            'firstname' => $validated['firstname'],
            'infix' => $validated['infix'] ?? '',
            'lastname' => $validated['lastname'],
            'birthdate' => $validated['birthdate'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
            'role_id' => $validated['role_id'],
            'is_active' => true, // Set is_active to true by default
        ]);

        // Determine the role
        $role = Role::findOrFail($request->role_id);

        // Create role-specific record if needed
        if ($role->name === 'student') {
            Student::create([
                'user_id' => $user->id,
                'relation_number' => 'S-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                'isactive' => true, // Set isactive to true by default
                'remark' => null,
            ]);
        } elseif ($role->name === 'instructor') {
            Instructor::create([
                'user_id' => $user->id,
                'number' => 'I-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                'isactive' => true, // Set isactive to true by default
                'remark' => null,
            ]);
        }

        // Here you would typically send an email with the temporary password
        // Mail::to($user->email)->send(new NewUserWelcomeMail($user, $password));

        return redirect()
            ->route('accounts.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('accounts.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        // Get additional info if the user is a student or instructor
        $studentInfo = null;
        $instructorInfo = null;

        if ($user->isStudent()) {
            $studentInfo = Student::where('user_id', $user->id)->first();
        } elseif ($user->isInstructor()) {
            $instructorInfo = Instructor::where('user_id', $user->id)->first();
        }

        return view('accounts.edit', compact('user', 'roles', 'studentInfo', 'instructorInfo'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the base user data
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'infix' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role_id' => 'required|exists:roles,id',
            'is_active' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            // Update user data
            $user->update([
                'firstname' => $validated['firstname'],
                'infix' => $validated['infix'] ?? '',
                'lastname' => $validated['lastname'],
                'birthdate' => $validated['birthdate'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'is_active' => $request->has('is_active') ? true : false,
                'role_id' => $validated['role_id'],
            ]);

            // Handle role changes and related records
            $oldRole = $user->role;
            $newRole = Role::find($validated['role_id']);

            // If role changed from student to something else, remove student record
            if ($oldRole->name === 'student' && $newRole->name !== 'student') {
                Student::where('user_id', $user->id)->delete();
            }

            // If role changed from instructor to something else, remove instructor record
            if ($oldRole->name === 'instructor' && $newRole->name !== 'instructor') {
                Instructor::where('user_id', $user->id)->delete();
            }

            // If new role is student and user wasn't previously a student, create student record
            if ($newRole->name === 'student' && $oldRole->name !== 'student') {
                Student::create([
                    'user_id' => $user->id,
                    'relation_number' => 'S-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                    'isactive' => $request->has('is_active') ? true : false,
                    'remark' => null,
                ]);
            }

            // If new role is instructor and user wasn't previously an instructor, create instructor record
            if ($newRole->name === 'instructor' && $oldRole->name !== 'instructor') {
                Instructor::create([
                    'user_id' => $user->id,
                    'number' => 'I-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                    'isactive' => $request->has('is_active') ? true : false,
                    'remark' => null,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('accounts.index')
                ->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('accounts.edit', $user)
                ->with('error', 'Failed to update user: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            // Delete related records based on user role
            if ($user->isStudent()) {
                Student::where('user_id', $user->id)->delete();
            } elseif ($user->isInstructor()) {
                Instructor::where('user_id', $user->id)->delete();
            }

            // Delete the user
            $user->delete();

            DB::commit();

            return redirect()
                ->route('accounts.index')
                ->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('accounts.index')
                ->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
}
