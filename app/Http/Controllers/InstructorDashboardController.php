<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InstructorDashboardController extends Controller
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
     * Display the instructor's students page.
     */
}
