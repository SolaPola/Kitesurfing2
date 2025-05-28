<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Location;
use App\Models\Instructor;
use App\Models\Timeslot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Show the form for creating a new booking.
     */
    public function create(Request $request)
    {
        $packages = Package::where('is_active', true)->get();
        $locations = Location::where('is_active', true)->get();

        $selectedPackage = null;
        if ($request->has('package')) {
            $selectedPackage = Package::find($request->input('package'));
        }

        return view('bookings.create', compact('packages', 'locations', 'selectedPackage'));
    }

    /**
     * Get available timeslots for a specific date and location.
     */
    public function getAvailableTimeslots(Request $request)
    {
        $locationId = $request->input('location_id');
        $date = $request->input('date');

        if (!$locationId || !$date) {
            return response()->json(['error' => 'Missing required parameters'], 400);
        }

        // Get all timeslots for the location
        $timeslots = Timeslot::where('location_id', $locationId)
            ->where('is_active', true)
            ->get()
            ->map(function ($timeslot) use ($date) {
                $remainingSpots = $timeslot->remainingSpots($date);
                return [
                    'id' => $timeslot->id,
                    'formatted_time' => $timeslot->formatted_time,
                    'is_available' => $remainingSpots > 0,
                    'remaining_spots' => $remainingSpots,
                    'start_time' => $timeslot->start_time,
                    'end_time' => $timeslot->end_time
                ];
            });

        return response()->json($timeslots);
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'location_id' => 'required|exists:locations,id',
            'preferred_date' => 'required|date|after:today',
            'timeslot_id' => 'required|exists:timeslots,id',
            'number_of_participants' => 'required|integer|min:1',
            'experience_level' => 'required|string',
            'special_requests' => 'nullable|string',
        ]);

        $package = Package::findOrFail($validatedData['package_id']);
        $timeslot = Timeslot::findOrFail($validatedData['timeslot_id']);

        // Check if the timeslot is still available for the selected date
        if (!$timeslot->isAvailable($validatedData['preferred_date'])) {
            return back()->withErrors([
                'timeslot_id' => 'This timeslot is no longer available for the selected date. Please choose another time.'
            ])->withInput();
        }

        // Check if the number of participants is valid for this package
        if (
            $validatedData['number_of_participants'] < $package->min_participants ||
            $validatedData['number_of_participants'] > $package->max_participants
        ) {
            return back()->withErrors([
                'number_of_participants' => "This package requires between {$package->min_participants} and {$package->max_participants} participants."
            ])->withInput();
        }

        // Calculate total price based on package price and number of participants
        $totalPrice = $package->price * $validatedData['number_of_participants'];

        // Create booking
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->package_id = $validatedData['package_id'];
        $booking->location_id = $validatedData['location_id'];
        $booking->preferred_date = $validatedData['preferred_date'];
        $booking->timeslot_id = $validatedData['timeslot_id'];
        $booking->number_of_participants = $validatedData['number_of_participants'];
        $booking->experience_level = $validatedData['experience_level'];
        $booking->special_requests = $validatedData['special_requests'];
        $booking->total_price = $totalPrice;
        $booking->status = 'Pending';
        $booking->payment_reference = 'REF-' . Str::random(10);
        $booking->save();

        // Redirect to payment page
        return redirect()->route('bookings.payment', $booking);
    }

    /**
     * Show the payment page for a booking.
     */
    public function showPayment(Booking $booking)
    {
        // Make sure only the booking owner can see the payment page
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }

        return view('bookings.payment', compact('booking'));
    }

    /**
     * Process the payment for a booking.
     */
    public function processPayment(Request $request, Booking $booking)
    {
        // Make sure only the booking owner can process payment
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }

        // Validate payment details
        $request->validate([
            'card_number' => 'required|string|size:16',
            'card_holder' => 'required|string|max:255',
            'expiration_month' => 'required|integer|between:1,12',
            'expiration_year' => 'required|integer|between:' . date('Y') . ',' . (date('Y') + 10),
            'cvv' => 'required|string|size:3',
        ]);

        // In a real app, you would process payment with a payment gateway here
        // Since this is a demo, we'll just mark the booking as paid

        $booking->is_paid = true;
        $booking->status = 'Confirmed';
        $booking->paid_at = now();
        $booking->payment_method = 'Credit Card';
        $booking->save();

        // Assign an instructor (if available)
        $instructor = Instructor::where('isactive', true)->inRandomOrder()->first();

        if ($instructor) {
            $booking->instructor_id = $instructor->id;
            $booking->save();
        }

        // Create individual lesson sessions for multi-lesson packages
        if ($booking->package->number_of_lessons > 1) {
            $lessonDate = $booking->preferred_date;

            for ($i = 1; $i <= $booking->package->number_of_lessons; $i++) {
                $booking->lessonSessions()->create([
                    'lesson_number' => $i,
                    'lesson_date' => $lessonDate,
                    'start_time' => '10:00:00', // Default time, would be configurable in a real app
                    'end_time' => '13:30:00',   // Based on package duration
                    'status' => 'Scheduled',
                    'instructor_id' => $booking->instructor_id,
                ]);

                // Schedule next lesson for following week
                $lessonDate = date('Y-m-d', strtotime($lessonDate . ' +7 days'));
            }
        } else {
            // Single lesson package
            $booking->lessonSessions()->create([
                'lesson_number' => 1,
                'lesson_date' => $booking->preferred_date,
                'start_time' => '10:00:00',
                'end_time' => $booking->package->hours < 3 ? '12:30:00' : '13:30:00',
                'status' => 'Scheduled',
                'instructor_id' => $booking->instructor_id,
            ]);
        }

        return redirect()->route('bookings.confirmation', $booking);
    }

    /**
     * Display the booking confirmation page.
     */
    public function confirmation(Booking $booking)
    {
        // Make sure only the booking owner can see the confirmation
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }

        return view('bookings.confirmation', compact('booking'));
    }

    /**
     * Display all bookings for the authenticated user.
     */
    public function index()
    {
        $bookings = Auth::user()->bookings()->with(['package', 'location', 'lessonSessions'])->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Display the specified booking.
     */
    public function show(Booking $booking)
    {
        // Make sure only the booking owner can see the details
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }

        $booking->load(['package', 'location', 'lessonSessions']);
        return view('bookings.show', compact('booking'));
    }
}
