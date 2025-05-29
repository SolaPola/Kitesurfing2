<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking - KitesurfingVS</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#111827',
                        'accent': '#06B6D4',
                        'offwhite': '#F8FAFC',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-offwhite">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="text-accent font-bold text-xl">KitesurfingVS</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center justify-between space-x-4">
                    <div class="flex items-baseline space-x-4">
                        <a href="{{ route('home') }}"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">Home</a>
                        <a href="{{ route('bookings.index') }}"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">My
                            Bookings</a>
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('bookings.show', $booking) }}" class="text-accent hover:text-cyan-400 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Booking
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6 bg-gray-900 text-white">
                <h1 class="text-2xl font-bold">Edit Booking</h1>
                <p class="text-sm text-gray-300 mt-1">Reference: {{ $booking->payment_reference }}</p>
            </div>

            <div class="p-6">
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                        <p class="font-bold">Please fix the following errors:</p>
                        <ul class="list-disc ml-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('bookings.update', $booking) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="package_id" class="block text-sm font-medium text-gray-700 mb-1">Package</label>
                        <select id="package_id" name="package_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}"
                                    {{ $booking->package_id == $package->id ? 'selected' : '' }}>
                                    {{ $package->name }} - €{{ number_format($package->price, 2) }}
                                    ({{ $package->hours }} hours)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="location_id"
                                class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <select id="location_id" name="location_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{ $booking->location_id == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="preferred_date"
                                class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="date" id="preferred_date" name="preferred_date" required
                                value="{{ $booking->preferred_date }}" min="{{ date('Y-m-d') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                        </div>

                        <div>
                            <label for="timeslot_id" class="block text-sm font-medium text-gray-700 mb-1">Time Slot
                                (Optional)</label>
                            <select id="timeslot_id" name="timeslot_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                <option value="">Choose a timeslot (optional)</option>
                                <!-- Timeslots will be loaded dynamically -->
                            </select>
                            <p id="no-timeslots" class="hidden mt-2 text-sm text-yellow-600">
                                No available timeslots for selected date and location. Your booking will be processed
                                and we'll contact you to arrange a suitable time.
                            </p>
                        </div>

                        <div>
                            <label for="number_of_participants" class="block text-sm font-medium text-gray-700 mb-1">
                                Number of Participants
                            </label>
                            <input type="number" id="number_of_participants" name="number_of_participants" required
                                value="{{ $booking->number_of_participants }}" min="1"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                        </div>

                        <div>
                            <label for="experience_level"
                                class="block text-sm font-medium text-gray-700 mb-1">Experience Level</label>
                            <select id="experience_level" name="experience_level" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                <option value="Beginner"
                                    {{ $booking->experience_level == 'Beginner' ? 'selected' : '' }}>
                                    Beginner - Never tried kitesurfing
                                </option>
                                <option value="Novice" {{ $booking->experience_level == 'Novice' ? 'selected' : '' }}>
                                    Novice - 1-2 lessons before
                                </option>
                                <option value="Intermediate"
                                    {{ $booking->experience_level == 'Intermediate' ? 'selected' : '' }}>
                                    Intermediate - Can ride but want to improve
                                </option>
                                <option value="Advanced"
                                    {{ $booking->experience_level == 'Advanced' ? 'selected' : '' }}>
                                    Advanced - Want to learn new tricks
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-1">
                            Special Requests (Optional)
                        </label>
                        <textarea id="special_requests" name="special_requests" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent"
                            placeholder="Any special requirements or questions?">{{ $booking->special_requests }}</textarea>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between items-center">
                        <a href="{{ route('bookings.show', $booking) }}" class="text-accent hover:underline">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-accent text-gray-900 font-medium rounded-md hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-accent">
                            Update Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locationSelect = document.getElementById('location_id');
            const dateInput = document.getElementById('preferred_date');
            const timeslotSelect = document.getElementById('timeslot_id');
            const noTimeslotsMessage = document.getElementById('no-timeslots');
            let currentTimeslotId = {{ $booking->timeslot_id ?? 'null' }};

            // Function to load available timeslots
            function loadAvailableTimeslots() {
                const locationId = locationSelect.value;
                const date = dateInput.value;

                if (!locationId || !date) return;

                // Reset timeslot select
                timeslotSelect.innerHTML = '<option value="">Loading timeslots...</option>';
                noTimeslotsMessage.classList.add('hidden');

                // Use the correct URL for the timeslots endpoint - include the current booking ID
                fetch(`/booking/timeslots?location_id=${locationId}&date=${date}&booking_id={{ $booking->id }}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        timeslotSelect.innerHTML = '';
                        timeslotSelect.innerHTML = '<option value="">Select a time (optional)</option>';

                        if (!data || data.length === 0) {
                            timeslotSelect.innerHTML = '<option value="">No timeslots available</option>';
                            noTimeslotsMessage.classList.remove('hidden');
                            return;
                        }

                        let availableFound = false;

                        // Sort timeslots by start time
                        data.sort((a, b) => a.start_time.localeCompare(b.start_time));

                        data.forEach(slot => {
                            const option = document.createElement('option');
                            option.value = slot.id;

                            // If this is the currently selected timeslot, select it
                            if (slot.id == currentTimeslotId) {
                                option.selected = true;
                            }

                            // Show remaining spots in the option text
                            if (slot.is_available || slot.id == currentTimeslotId) {
                                option.textContent =
                                    `${slot.formatted_time} (${slot.remaining_spots} spot${slot.remaining_spots > 1 ? 's' : ''} left)`;
                                availableFound = true;
                            } else {
                                option.textContent = `${slot.formatted_time} (Full)`;
                                option.disabled = true;
                            }

                            timeslotSelect.appendChild(option);
                        });

                        if (!availableFound && currentTimeslotId === null) {
                            noTimeslotsMessage.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading timeslots:', error);
                        timeslotSelect.innerHTML = '<option value="">Error loading timeslots</option>';
                        noTimeslotsMessage.textContent =
                            'Error loading available times. Please try again later or proceed without selecting a specific time.';
                        noTimeslotsMessage.classList.remove('hidden');
                    });
            }

            // Add event listeners
            locationSelect.addEventListener('change', loadAvailableTimeslots);
            dateInput.addEventListener('change', loadAvailableTimeslots);

            // Load timeslots if location and date are already selected
            if (locationSelect.value && dateInput.value) {
                loadAvailableTimeslots();
            }
        });
    </script>
</body>

</html>
