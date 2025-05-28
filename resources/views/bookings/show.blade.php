<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - KitesurfingVS</title>
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

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('bookings.index') }}" class="text-accent hover:text-cyan-400 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to My Bookings
            </a>
        </div>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6 bg-gray-900 text-white flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">Booking Details</h1>
                    <p class="text-sm text-gray-300 mt-1">Reference: {{ $booking->payment_reference }}</p>
                </div>
                <div>
                    @if ($booking->status === 'Confirmed')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> {{ $booking->status }}
                        </span>
                    @elseif ($booking->status === 'Pending')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i> {{ $booking->status }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            {{ $booking->status }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Booking Details -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-3">Booking Information</h2>
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-sm text-gray-500">Package</p>
                                    <p class="font-medium">{{ $booking->package->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Location</p>
                                    <p class="font-medium">{{ $booking->location->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date</p>
                                    <p class="font-medium">{{ date('d/m/Y', strtotime($booking->preferred_date)) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Experience Level</p>
                                    <p class="font-medium">{{ $booking->experience_level }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Participants</p>
                                    <p class="font-medium">{{ $booking->number_of_participants }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Total Duration</p>
                                    <p class="font-medium">{{ $booking->package->hours }} hours</p>
                                </div>
                            </div>

                            @if ($booking->special_requests)
                                <div class="mt-3 pt-3 border-t border-gray-200">
                                    <p class="text-sm text-gray-500">Special Requests</p>
                                    <p class="mt-1">{{ $booking->special_requests }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-3">Payment Information</h2>
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-sm text-gray-500">Total Price</p>
                                    <p class="font-medium">€{{ number_format($booking->total_price, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Payment Status</p>
                                    <p class="font-medium {{ $booking->is_paid ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $booking->is_paid ? 'Paid' : 'Unpaid' }}
                                    </p>
                                </div>
                                @if ($booking->is_paid)
                                    <div>
                                        <p class="text-sm text-gray-500">Payment Method</p>
                                        <p class="font-medium">{{ $booking->payment_method }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Payment Date</p>
                                        <p class="font-medium">{{ date('d/m/Y', strtotime($booking->paid_at)) }}</p>
                                    </div>
                                @else
                                    <div class="col-span-2">
                                        <a href="{{ route('bookings.payment', $booking) }}" 
                                           class="mt-2 inline-flex items-center px-4 py-2 bg-accent text-gray-900 rounded-md hover:bg-cyan-400">
                                            <i class="fas fa-credit-card mr-2"></i> Complete Payment
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lesson Schedule -->
                <div class="mt-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-3">Lesson Schedule</h2>
                    
                    @if ($booking->lessonSessions->count() > 0)
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Lesson
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Time
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Instructor
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($booking->lessonSessions as $session)
                                        <tr class="hover:bg-offwhite">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                Lesson {{ $session->lesson_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ date('d/m/Y', strtotime($session->lesson_date)) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ date('H:i', strtotime($session->start_time)) }} - {{ date('H:i', strtotime($session->end_time)) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if ($booking->instructor_id)
                                                    {{ $booking->instructor ? $booking->instructor->user->firstname . ' ' . $booking->instructor->user->lastname : 'To be assigned' }}
                                                @else
                                                    To be assigned
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($session->status === 'Scheduled')
                                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                                        {{ $session->status }}
                                                    </span>
                                                @elseif ($session->status === 'Completed')
                                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                        {{ $session->status }}
                                                    </span>
                                                @elseif ($session->status === 'Cancelled')
                                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                                        {{ $session->status }}
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                                        {{ $session->status }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Lesson schedules will be available once your booking is confirmed.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Information Box -->
                <div class="mt-8 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">What to bring to your lesson</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside pl-2 space-y-1">
                                    <li>Swimwear</li>
                                    <li>Towel</li>
                                    <li>Sunscreen</li>
                                    <li>Water bottle</li>
                                    <li>Change of clothes</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
