<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingLessonSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class InstructorController extends Controller
{
    /**
     * Display the instructor dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $instructor = $user->instructor;

        // Create instructor profile if it doesn't exist
        if (!$instructor && $user->isInstructor()) {
            $instructor = new \App\Models\Instructor();
            $instructor->user_id = $user->id;
            $instructor->isactive = true;
            $instructor->save();

            // Refresh the user relationship
            $user->refresh();
        }

        // Get upcoming lessons count for today
        $todayLessonsCount = 0;

        if ($instructor) {
            $todayLessonsCount = DB::table('booking_lesson_sessions')
                ->join('bookings', 'booking_lesson_sessions.booking_id', '=', 'bookings.id')
                ->where('bookings.instructor_id', $instructor->id)
                ->whereDate('lesson_date', Carbon::today())
                ->where('booking_lesson_sessions.status', 'Scheduled')
                ->count();
        }

        $notifications = [];

        return view('instructor.dashboard', compact('notifications', 'todayLessonsCount'));
    }

    /**
     * Display lessons for the instructor
     */
    public function lessons()
    {
        // Get the instructor model related to the current user
        $user = Auth::user();
        $instructor = $user->instructor;

        // Create instructor profile if it doesn't exist
        if (!$instructor && $user->isInstructor()) {
            $instructor = new \App\Models\Instructor();
            $instructor->user_id = $user->id;
            $instructor->isactive = true;
            $instructor->save();

            // Refresh the user relationship
            $user->refresh();
            $instructor = $user->instructor;
        }

        // Initialize empty collections
        $todayLessons = collect();
        $upcomingLessons = collect();
        $pastLessons = collect();

        if ($instructor) {
            // Using joins for better query performance
            $todayLessons = DB::table('booking_lesson_sessions')
                ->join('bookings', 'booking_lesson_sessions.booking_id', '=', 'bookings.id')
                ->join('users', 'bookings.user_id', '=', 'users.id')
                ->join('packages', 'bookings.package_id', '=', 'packages.id')
                ->join('locations', 'bookings.location_id', '=', 'locations.id')
                ->select(
                    'booking_lesson_sessions.*',
                    'bookings.user_id',
                    'bookings.package_id',
                    'bookings.location_id',
                    'users.firstname',
                    'users.lastname',
                    'users.email',
                    'packages.name as package_name',
                    'packages.number_of_lessons',
                    'locations.name as location_name'
                )
                ->where('bookings.instructor_id', $instructor->id)
                ->whereDate('lesson_date', Carbon::today())
                ->orderBy('booking_lesson_sessions.start_time')
                ->get();

            $upcomingLessons = DB::table('booking_lesson_sessions')
                ->join('bookings', 'booking_lesson_sessions.booking_id', '=', 'bookings.id')
                ->join('users', 'bookings.user_id', '=', 'users.id')
                ->join('packages', 'bookings.package_id', '=', 'packages.id')
                ->join('locations', 'bookings.location_id', '=', 'locations.id')
                ->select(
                    'booking_lesson_sessions.*',
                    'bookings.user_id',
                    'bookings.package_id',
                    'bookings.location_id',
                    'users.firstname',
                    'users.lastname',
                    'users.email',
                    'packages.name as package_name',
                    'packages.number_of_lessons',
                    'locations.name as location_name'
                )
                ->where('bookings.instructor_id', $instructor->id)
                ->whereDate('lesson_date', '>', Carbon::today())
                ->where('booking_lesson_sessions.status', '!=', 'Cancelled')
                ->orderBy('booking_lesson_sessions.lesson_date')
                ->orderBy('booking_lesson_sessions.start_time')
                ->get();

            $pastLessons = DB::table('booking_lesson_sessions')
                ->join('bookings', 'booking_lesson_sessions.booking_id', '=', 'bookings.id')
                ->join('users', 'bookings.user_id', '=', 'users.id')
                ->join('packages', 'bookings.package_id', '=', 'packages.id')
                ->join('locations', 'bookings.location_id', '=', 'locations.id')
                ->select(
                    'booking_lesson_sessions.*',
                    'bookings.user_id',
                    'bookings.package_id',
                    'bookings.location_id',
                    'users.firstname',
                    'users.lastname',
                    'users.email',
                    'packages.name as package_name',
                    'packages.number_of_lessons',
                    'locations.name as location_name'
                )
                ->where('bookings.instructor_id', $instructor->id)
                ->whereDate('lesson_date', '<', Carbon::today())
                ->orderByDesc('booking_lesson_sessions.lesson_date')
                ->orderBy('booking_lesson_sessions.start_time')
                ->limit(10)
                ->get();
        }

        return view('instructor.lessons', compact('todayLessons', 'upcomingLessons', 'pastLessons'));
    }

    /**
     * Update a lesson status
     */
    public function updateLessonStatus(Request $request, $id)
    {
        $session = BookingLessonSession::findOrFail($id);
        $user = Auth::user();
        $instructor = $user->instructor;

        // Check if the instructor is assigned to this booking
        $booking = Booking::findOrFail($session->booking_id);

        if (!$instructor || $booking->instructor_id != $instructor->id) {
            return redirect()->route('instructor.lessons')
                ->with('error', 'You are not authorized to update this lesson');
        }

        // Validate the status
        $request->validate([
            'status' => 'required|in:Scheduled,In Progress,Completed,Cancelled,No-Show,Rescheduled',
            'notes' => 'nullable|string|max:500',
        ]);

        // Update the session status
        $session->status = $request->status;

        if ($request->filled('notes')) {
            $session->instructor_notes = $request->notes;
        }

        $session->save();

        return redirect()->route('instructor.lessons')
            ->with('success', 'Lesson status has been updated');
    }
    
    /**
     * Show cancel lesson form
     */
    public function showCancelForm($id)
    {
        $session = BookingLessonSession::findOrFail($id);
        $user = Auth::user();
        $instructor = $user->instructor;
        
        // Check if the instructor is assigned to this booking
        $booking = Booking::findOrFail($session->booking_id);
        
        if (!$instructor || $booking->instructor_id != $instructor->id) {
            return redirect()->route('instructor.lessons')
                ->with('error', 'You are not authorized to cancel this lesson');
        }
        
        // Check if the session can be cancelled
        if ($session->status === 'Completed' || $session->status === 'Cancelled' || $session->status === 'No-Show') {
            return redirect()->route('instructor.lessons')
                ->with('error', 'This lesson cannot be cancelled');
        }
        
        return view('instructor.cancel-lesson', compact('session', 'booking'));
    }
    
    /**
     * Cancel a lesson with reason
     */
    public function cancelLesson(Request $request, $id)
    {
        $session = BookingLessonSession::findOrFail($id);
        $user = Auth::user();
        $instructor = $user->instructor;
        
        // Check if the instructor is assigned to this booking
        $booking = Booking::findOrFail($session->booking_id);
        
        if (!$instructor || $booking->instructor_id != $instructor->id) {
            return redirect()->route('instructor.lessons')
                ->with('error', 'You are not authorized to cancel this lesson');
        }
        
        // Validate the cancellation reason
        $request->validate([
            'cancel_reason' => 'required|string|max:500',
            'notify_student' => 'nullable|boolean'
        ]);
        
        // Update the session status
        $session->status = 'Cancelled';
        $session->instructor_notes = 'Cancelled by instructor: ' . $request->cancel_reason;
        $session->save();
        
        // Notify the student if requested
        if ($request->has('notify_student') && $booking->user) {
            // Here you would normally send an email to the student
            // For now, we'll just log it
            \Log::info('Notification would be sent to: ' . $booking->user->email);
            
            /* 
            // Example email code (not implemented)
            Mail::to($booking->user->email)->send(new LessonCancelled(
                $booking, 
                $session, 
                $request->cancel_reason
            ));
            */
        }
        
        return redirect()->route('instructor.lessons')
            ->with('success', 'Lesson has been cancelled successfully');
    }

    /**
     * Display students assigned to this instructor
     */
    public function students()
    {
        $instructor = Auth::user()->instructor;

        if (!$instructor) {
            return redirect()->route('instructor.dashboard')
                ->with('error', 'Instructor profile not found');
        }

        // Get unique students from this instructor's bookings
        $students = Booking::where('instructor_id', $instructor->id)
            ->with('user')
            ->get()
            ->pluck('user')
            ->unique('id');

        return view('instructor.students', compact('students'));
    }
}
