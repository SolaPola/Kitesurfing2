<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - KitesurfingVS</title>
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
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">My Bookings</a>
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Payment Steps Indicator -->
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <div class="flex items-center relative">
                    <div class="rounded-full w-8 h-8 bg-green-500 flex items-center justify-center text-white text-sm">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="absolute -bottom-6 w-max text-center text-xs text-green-600 font-medium">
                        Book Lesson
                    </div>
                </div>
                <div class="flex-1 h-1 bg-green-500"></div>
                <div class="flex items-center relative">
                    <div class="rounded-full w-8 h-8 bg-green-500 flex items-center justify-center text-white text-sm">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="absolute -bottom-6 w-max text-center text-xs text-green-600 font-medium">
                        Payment Details
                    </div>
                </div>
                <div class="flex-1 h-1 bg-green-500"></div>
                <div class="flex items-center relative">
                    <div class="rounded-full w-8 h-8 bg-green-500 flex items-center justify-center text-white text-sm">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="absolute -bottom-6 w-max text-center text-xs text-green-600 font-medium">
                        Confirmation
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6 bg-green-500 text-white">
                <div class="flex items-center">
                    <div class="rounded-full bg-white w-12 h-12 flex items-center justify-center mr-4">
                        <i class="fas fa-check text-green-500 text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Booking Confirmed!</h1>
                        <p class="mt-1 text-green-100">Your kitesurfing lesson has been successfully booked.</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Booking Details</h2>
                    <p class="text-gray-600">Booking Reference: <span class="font-medium">{{ $booking->payment_reference }}</span></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-bold text-gray-800 mb-2">Package Details</h3>
                        <div class="bg-gray-100 rounded-lg p-4">
                            <p class="mb-2"><span class="text-gray-600">Package:</span> {{ $booking->package->name }}</p>
                            <p class="mb-2"><span class="text-gray-600">Location:</span> {{ $booking->location->name }}</p>
                            <p class="mb-2"><span class="text-gray-600">Date:</span> {{ date('d/m/Y', strtotime($booking->preferred_date)) }}</p>
                            <p class="mb-2"><span class="text-gray-600">Participants:</span> {{ $booking->number_of_participants }}</p>
                            <p><span class="text-gray-600">Experience Level:</span> {{ $booking->experience_level }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-bold text-gray-800 mb-2">Payment Details</h3>
                        <div class="bg-gray-100 rounded-lg p-4">
                            <p class="mb-2"><span class="text-gray-600">Total Amount:</span> €{{ number_format($booking->total_price, 2) }}</p>
                            <p class="mb-2"><span class="text-gray-600">Status:</span> <span class="text-green-600 font-medium">Paid</span></p>
                            <p class="mb-2"><span class="text-gray-600">Payment Method:</span> {{ $booking->payment_method }}</p>
                            <p><span class="text-gray-600">Date:</span> {{ date('d/m/Y', strtotime($booking->paid_at)) }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="font-bold text-gray-800 mb-2">Lesson Schedule</h3>
                    <div class="bg-gray-100 rounded-lg p-4">
                        @if ($booking->lessonSessions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="border-b border-gray-300">
                                            <th class="py-2 px-3 text-left text-sm font-medium text-gray-700">Lesson</th>
                                            <th class="py-2 px-3 text-left text-sm font-medium text-gray-700">Date</th>
                                            <th class="py-2 px-3 text-left text-sm font-medium text-gray-700">Time</th>
                                            <th class="py-2 px-3 text-left text-sm font-medium text-gray-700">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booking->lessonSessions as $session)
                                            <tr class="border-b border-gray-200">
                                                <td class="py-2 px-3">Lesson {{ $session->lesson_number }}</td>
                                                <td class="py-2 px-3">{{ date('d/m/Y', strtotime($session->lesson_date)) }}</td>
                                                <td class="py-2 px-3">{{ date('H:i', strtotime($session->start_time)) }} - {{ date('H:i', strtotime($session->end_time)) }}</td>
                                                <td class="py-2 px-3">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        {{ $session->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-600">No lessons have been scheduled yet. Our team will contact you to confirm your lesson times.</p>
                        @endif
                    </div>
                </div>
                
                <div class="mt-8 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">What's Next?</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <p>You will receive a confirmation email with all details about your booking.</p>
                                <p class="mt-1">Please arrive 15 minutes before your scheduled lesson time, and don't forget to bring swimwear and a towel!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-accent hover:underline">
                        <i class="fas fa-home mr-1"></i> Return to Homepage
                    </a>
                    <a href="{{ route('bookings.index') }}" class="px-6 py-3 bg-accent text-gray-900 font-medium rounded-md hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-accent">
                        View My Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
