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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        // Add debugging to see if this method is even being called
        \Log::info('Edit method called for booking ID: ' . $booking->id);
        
        // Check if the booking belongs to the current user
        if ($booking->student_id != Auth::id()) {
            return redirect()->route('bookings.index')->with('error', 'You do not have permission to edit this booking.');
        }

        // Check if the booking is in a state that can be edited (Pending or Confirmed)
        if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
            return redirect()->route('bookings.show', $booking)->with('error', 'This booking cannot be edited.');
        }

        $packages = Package::all();
        $locations = Location::all();

        return view('bookings.edit', compact('booking', 'packages', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // Check if the booking belongs to the current user
        if ($booking->student_id != Auth::id()) {
            return redirect()->route('bookings.index')->with('error', 'You do not have permission to update this booking.');
        }

        // Check if the booking is in a state that can be updated (Pending or Confirmed)
        if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
            return redirect()->route('bookings.show', $booking)->with('error', 'This booking cannot be updated.');
        }

        // Validate the request data
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'location_id' => 'required|exists:locations,id',
            'preferred_date' => 'required|date',
            'timeslot_id' => 'nullable|exists:timeslots,id',
            'number_of_participants' => 'required|integer|min:1',
            'experience_level' => 'required|string|in:Beginner,Novice,Intermediate,Advanced',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        // Calculate the total price
        $package = Package::findOrFail($validated['package_id']);
        $totalPrice = $package->price * $validated['number_of_participants'];

        // If the booking is confirmed, add a note about the modification
        $additionalInfo = '';
        if ($booking->status === 'Confirmed' && !str_contains($booking->special_requests ?? '', 'Modified on')) {
            $additionalInfo = "(Modified on " . now()->format('Y-m-d H:i') . ") ";
            
            // Append to existing special requests or create new
            if (!empty($validated['special_requests'])) {
                $validated['special_requests'] = $additionalInfo . $validated['special_requests'];
            } else {
                $validated['special_requests'] = $additionalInfo . "Booking was modified after confirmation.";
            }
        }

        // Update the booking
        $booking->update([
            'package_id' => $validated['package_id'],
            'location_id' => $validated['location_id'],
            'preferred_date' => $validated['preferred_date'],
            'timeslot_id' => $validated['timeslot_id'],
            'number_of_participants' => $validated['number_of_participants'],
            'experience_level' => $validated['experience_level'],
            'special_requests' => $validated['special_requests'],
            'total_price' => $totalPrice,
        ]);

        // Redirect to the booking details page with a success message
        return redirect()->route('bookings.show', $booking)->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // Add debugging information
        \Log::info('Destroy method called for booking ID: ' . $booking->id);

        // Check if the booking belongs to the current user
        if ($booking->student_id != Auth::id()) {
            \Log::warning('User attempted to delete booking that does not belong to them: ' . $booking->id);
            return redirect()->route('bookings.index')->with('error', 'You do not have permission to cancel this booking.');
        }

        // Check if the booking is in a state that can be cancelled
        if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
            \Log::warning('User attempted to delete booking in invalid state: ' . $booking->status);
            return redirect()->route('bookings.show', $booking)->with('error', 'This booking cannot be cancelled.');
        }

        try {
            // If the booking is paid, mark it as cancelled but don't delete it
            if ($booking->is_paid) {
                $booking->update(['status' => 'Cancelled']);
                \Log::info('Booking marked as cancelled (paid booking): ' . $booking->id);
                return redirect()->route('bookings.index')->with('success', 'Booking cancelled successfully. Our team will contact you regarding the refund process.');
            }

            // If not paid, delete the booking
            $bookingId = $booking->id;
            $booking->delete();
            \Log::info('Booking deleted successfully: ' . $bookingId);
            
            return redirect()->route('bookings.index')->with('success', 'Booking cancelled successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting booking: ' . $e->getMessage());
            return redirect()->route('bookings.index')->with('error', 'There was an error cancelling your booking: ' . $e->getMessage());
        }
    }

    // Test route for simple deletion
    public function testDestroy($id)
    {
        $booking = Booking::findOrFail($id);
        
        try {
            // If the booking is paid, mark it as cancelled but don't delete it
            if ($booking->is_paid) {
                $booking->update(['status' => 'Cancelled']);
                return redirect()->route('bookings.index')->with('success', 'Booking marked as cancelled.');
            }

            // If not paid, delete the booking
            $booking->delete();
            return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('bookings.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
