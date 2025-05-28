<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - KitesurfingVS</title>
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
                            class="px-3 py-2 rounded-md text-sm font-medium text-white bg-accent">My Bookings</a>
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900">Available Kitesurfing Packages</h2>
            <p class="mt-2 text-gray-600">Select one of our packages below to book your next kitesurfing lesson</p>
        </div>

        <div class="mt-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- Package 1: Private Lesson -->
                <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform hover:scale-105 border-t-4 border-accent">
                    <div class="px-6 py-8">
                        <h3 class="text-xl font-bold text-gray-900">Private Lesson</h3>
                        <div class="mt-2 flex items-baseline text-gray-900">
                            <span class="text-3xl font-extrabold tracking-tight">€175</span>
                            <span class="ml-1 text-sm font-medium text-gray-500">/person</span>
                        </div>
                        <p class="mt-5 text-gray-600">One-on-one instruction tailored to your skill level.</p>

                        <ul class="mt-6 space-y-3">
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">2.5 hours of instruction</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">All equipment included</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">Perfect for beginners</p>
                            </li>
                        </ul>
                    </div>
                    <div class="px-6 py-4 bg-gray-50">
                        <a href="{{ route('bookings.create', ['package' => 1]) }}"
                            class="w-full block text-center bg-accent hover:bg-cyan-400 text-gray-900 font-medium py-2 px-4 rounded-md transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>

                <!-- Package 2: Single Duo Lesson -->
                <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform hover:scale-105 border-t-4 border-accent">
                    <div class="px-6 py-8">
                        <h3 class="text-xl font-bold text-gray-900">Single Duo Lesson</h3>
                        <div class="mt-2 flex items-baseline text-gray-900">
                            <span class="text-3xl font-extrabold tracking-tight">€135</span>
                            <span class="ml-1 text-sm font-medium text-gray-500">/person</span>
                        </div>
                        <p class="mt-5 text-gray-600">Learn with a friend for added fun.</p>

                        <ul class="mt-6 space-y-3">
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">3.5 hours of instruction</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">2 persons with instructor</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">Social learning experience</p>
                            </li>
                        </ul>
                    </div>
                    <div class="px-6 py-4 bg-gray-50">
                        <a href="{{ route('bookings.create', ['package' => 2]) }}"
                            class="w-full block text-center bg-accent hover:bg-cyan-400 text-gray-900 font-medium py-2 px-4 rounded-md transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>

                <!-- Package 3: 3 Lesson Package -->
                <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform hover:scale-105 border-t-4 border-accent relative">
                    <div
                        class="absolute top-0 right-0 bg-yellow-400 text-gray-900 text-xs font-bold px-3 py-1 transform translate-x-2 -translate-y-1 rotate-45 shadow-sm">
                        POPULAR
                    </div>
                    <div class="px-6 py-8">
                        <h3 class="text-xl font-bold text-gray-900">Duo 3-Lesson Package</h3>
                        <div class="mt-2 flex items-baseline text-gray-900">
                            <span class="text-3xl font-extrabold tracking-tight">€375</span>
                            <span class="ml-1 text-sm font-medium text-gray-500">/person</span>
                        </div>
                        <p class="mt-5 text-gray-600">Comprehensive training over multiple sessions.</p>

                        <ul class="mt-6 space-y-3">
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">10.5 hours total instruction</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">2 persons with instructor</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">Skill progression tracking</p>
                            </li>
                        </ul>
                    </div>
                    <div class="px-6 py-4 bg-gray-50">
                        <a href="{{ route('bookings.create', ['package' => 3]) }}"
                            class="w-full block text-center bg-accent hover:bg-cyan-400 text-gray-900 font-medium py-2 px-4 rounded-md transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>

                <!-- Package 4: 5 Lesson Package -->
                <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform hover:scale-105 border-t-4 border-accent">
                    <div class="px-6 py-8">
                        <h3 class="text-xl font-bold text-gray-900">Duo 5-Lesson Package</h3>
                        <div class="mt-2 flex items-baseline text-gray-900">
                            <span class="text-3xl font-extrabold tracking-tight">€675</span>
                            <span class="ml-1 text-sm font-medium text-gray-500">/person</span>
                        </div>
                        <p class="mt-5 text-gray-600">Our most comprehensive training program.</p>

                        <ul class="mt-6 space-y-3">
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">17.5 hours total instruction</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">2 persons with instructor</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-accent" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                </div>
                                <p class="ml-2 text-sm text-gray-600">Certificate upon completion</p>
                            </li>
                        </ul>
                    </div>
                    <div class="px-6 py-4 bg-gray-50">
                        <a href="{{ route('bookings.create', ['package' => 4]) }}"
                            class="w-full block text-center bg-accent hover:bg-cyan-400 text-gray-900 font-medium py-2 px-4 rounded-md transition-colors">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">My Bookings</h1>
            <a href="{{ route('bookings.create') }}"
                class="px-4 py-2 bg-accent text-gray-900 font-medium rounded-md hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-accent">
                Book New Lesson
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if ($bookings->isEmpty())
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <div class="mb-4">
                    <i class="fas fa-calendar-alt text-accent text-5xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">No Bookings Yet</h2>
                <p class="text-gray-600 mb-4">You haven't booked any kitesurfing lessons yet.</p>
                <a href="{{ route('bookings.create') }}"
                    class="inline-block px-4 py-2 bg-accent text-gray-900 font-medium rounded-md hover:bg-cyan-400">
                    Book Your First Lesson
                </a>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Reference
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Package
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Location
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Total
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($bookings as $booking)
                                <tr class="hover:bg-offwhite">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->payment_reference }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->package->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->location->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ date('d/m/Y', strtotime($booking->preferred_date)) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        €{{ number_format($booking->total_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($booking->status === 'Confirmed')
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                {{ $booking->status }}
                                            </span>
                                        @elseif ($booking->status === 'Pending')
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $booking->status }}
                                            </span>
                                        @elseif ($booking->status === 'Completed')
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                {{ $booking->status }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                                {{ $booking->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('bookings.show', $booking) }}"
                                                class="text-accent hover:text-cyan-400">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if($booking->status === 'Pending' || $booking->status === 'Confirmed')
                                                <!-- Direct Edit Link with Full URL -->
                                                <a href="/student/bookings/{{ $booking->id }}/edit"
                                                    class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                
                                                <!-- Modal trigger button -->
                                                <button type="button" 
                                                    onclick="confirmDelete({{ $booking->id }})" 
                                                    class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash-alt"></i> Cancel
                                                </button>
                                                
                                                <!-- Direct delete link for testing -->
                                                <a href="{{ route('bookings.test-destroy', $booking->id) }}"
                                                   class="text-red-600 hover:text-red-800 underline ml-2">
                                                   Test Delete
                                                </a>
                                            @endif
                                            
                                            @if(!$booking->is_paid)
                                                <a href="{{ route('bookings.payment', $booking) }}"
                                                    class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-credit-card"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Upcoming Lessons Section -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Your Upcoming Lessons</h2>

            @php
                $upcomingLessons = collect([]);
                foreach ($bookings as $booking) {
                    foreach ($booking->lessonSessions as $lesson) {
                        if (
                            strtotime($lesson->lesson_date) >= strtotime(date('Y-m-d')) &&
                            $lesson->status !== 'Cancelled'
                        ) {
                            $upcomingLessons->push(
                                (object) [
                                    'booking_ref' => $booking->payment_reference,
                                    'package_name' => $booking->package->name,
                                    'location' => $booking->location->name,
                                    'lesson_number' => $lesson->lesson_number,
                                    'date' => $lesson->lesson_date,
                                    'time' =>
                                        date('H:i', strtotime($lesson->start_time)) .
                                        ' - ' .
                                        date('H:i', strtotime($lesson->end_time)),
                                    'status' => $lesson->status,
                                    'booking_id' => $booking->id,
                                ],
                            );
                        }
                    }
                }
                $upcomingLessons = $upcomingLessons->sortBy('date');
            @endphp

            @if ($upcomingLessons->isEmpty())
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <div class="mb-4">
                        <i class="fas fa-surfing text-accent text-5xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">No Upcoming Lessons</h3>
                    <p class="text-gray-600">You don't have any upcoming lessons scheduled.</p>
                </div>
            @else
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Package
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Lesson
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Location
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Time
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($upcomingLessons as $lesson)
                                    <tr class="hover:bg-offwhite">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $lesson->package_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Lesson {{ $lesson->lesson_number }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $lesson->location }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ date('d/m/Y', strtotime($lesson->date)) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $lesson->time }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $lesson->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Package Selection Section -->

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-10 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Cancel Booking</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to cancel this booking? This action cannot be undone.
                                    Any payment already made will be subject to our refund policy.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirm-delete-btn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel Booking
                    </button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Keep Booking
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden form for delete submission -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        let bookingIdToDelete = null;

        function confirmDelete(bookingId) {
            bookingIdToDelete = bookingId;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
            const deleteForm = document.getElementById('deleteForm');

            confirmDeleteBtn.addEventListener('click', function() {
                if (bookingIdToDelete) {
                    deleteForm.action = `/student/bookings/${bookingIdToDelete}`;
                    deleteForm.submit();
                }
            });
        });
    </script>
</body>

</html>
