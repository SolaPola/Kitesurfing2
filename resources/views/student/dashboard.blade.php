<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - KitesurfingVS</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#111827', // Gray-900 hex
                        'accent': '#06B6D4', // Tailwind's cyan-500
                        'offwhite': '#F8FAFC', // Tailwind's slate-50
                    }
                }
            }
        }
    </script>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Roboto font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-offwhite">
    <!-- Top Navigation Bar -->
    <div class="bg-gray-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <span class="text-accent font-bold text-xl">KitesurfingVS</span>
                <span class="ml-2 text-sm bg-accent/20 text-accent px-2 py-0.5 rounded">Student</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-white">Welcome, {{ Auth::user()->firstname }}</span>
                <div class="relative">
                    <button id="notifications-btn" class="text-white hover:text-accent">
                        <i class="fas fa-bell"></i>
                        @if (isset($notifications) && count($notifications) > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-accent text-primary text-xs rounded-full h-4 w-4 flex items-center justify-center">
                                {{ count($notifications) }}
                            </span>
                        @endif
                    </button>
                </div>
                <div class="h-8 w-8 rounded-full bg-accent flex items-center justify-center">
                    <span class="text-xs font-medium text-gray-900">
                        {{ strtoupper(substr(Auth::user()->firstname, 0, 1) . substr(Auth::user()->lastname, 0, 1)) }}
                    </span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-white hover:text-accent">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row gap-6">
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 bg-gray-900 text-white">
                <h2 class="font-medium">Student Portal</h2>
            </div>
            <nav class="p-2">
                <a href="{{ route('student.dashboard') }}"
                    class="block px-4 py-3 rounded-lg bg-accent text-white font-medium mb-1">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="{{ route('bookings.index') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-calendar-alt mr-3"></i>My Bookings
                </a>
                <a href="{{ route('bookings.create') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-plus-circle mr-3"></i>New Booking
                </a>
                <a href="#"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-chart-line mr-3"></i>My Progress
                </a>
                <a href="{{ route('settings.profile') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-cog mr-3"></i>Settings
                </a>
                <a href="{{ route('return.homepage') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mt-6 bg-gray-50 border border-gray-200">
                    <i class="fas fa-home mr-3"></i>Return to Homepage
                </a>
            </nav>
        </div>

        <!-- Content Area -->
        <div class="flex-1">
            <!-- Page header -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Student Dashboard</h1>
                <p class="text-gray-600">Welcome to your kitesurfing student portal. Track your progress and manage your
                    bookings.</p>
            </div>

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Upcoming Lessons Card -->
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-accent">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Upcoming Lessons</p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ isset($upcomingLessons) ? $upcomingLessons : 0 }}
                            </h3>
                        </div>
                        <div class="h-12 w-12 bg-accent/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-check text-accent text-xl"></i>
                        </div>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="mt-4 text-sm text-accent hover:underline block">View
                        schedule</a>
                </div>

                <!-- Total Hours Card -->
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Total Hours</p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ isset($totalHours) ? $totalHours : '0' }}
                            </h3>
                        </div>
                        <div class="h-12 w-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-green-500 text-xl"></i>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-gray-600">Hours of kitesurfing instruction</p>
                </div>

                <!-- Progress Card -->
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Skill Level</p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ isset($skillLevel) ? $skillLevel : 'Beginner' }}
                            </h3>
                        </div>
                        <div class="h-12 w-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-trophy text-yellow-500 text-xl"></i>
                        </div>
                    </div>
                    <a href="#" class="mt-4 text-sm text-accent hover:underline block">View skills</a>
                </div>
            </div>

            <!-- Next Lesson Alert -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="bg-accent/10 p-4 border-l-4 border-accent">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-accent text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-gray-900">Your Next Lesson</h3>
                            @if (isset($nextLesson))
                                <div class="mt-2 text-sm text-gray-600">
                                    <p class="font-medium">{{ $nextLesson->date }} at {{ $nextLesson->time }}</p>
                                    <p>Location: {{ $nextLesson->location }}</p>
                                    <p>Instructor: {{ $nextLesson->instructor }}</p>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('bookings.show', $nextLesson->booking_id) }}"
                                        class="bg-accent text-white px-4 py-2 rounded-md text-sm font-medium inline-flex items-center">
                                        <i class="fas fa-eye mr-2"></i> View Details
                                    </a>
                                </div>
                            @else
                                <div class="mt-2 text-sm text-gray-600">
                                    <p>You don't have any upcoming lessons scheduled.</p>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('bookings.create') }}"
                                        class="bg-accent text-white px-4 py-2 rounded-md text-sm font-medium inline-flex items-center">
                                        <i class="fas fa-plus-circle mr-2"></i> Book a Lesson
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Bookings -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4 bg-gray-900 text-white flex justify-between items-center">
                        <h2 class="font-bold">Recent Bookings</h2>
                        <a href="{{ route('bookings.index') }}" class="text-xs text-accent hover:underline">View
                            All</a>
                    </div>
                    <div class="p-4">
                        <div class="space-y-4">
                            @if (isset($recentBookings) && count($recentBookings) > 0)
                                @foreach ($recentBookings as $booking)
                                    <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">{{ $booking->package }}
                                                </h4>
                                                <p class="text-xs text-gray-500">{{ $booking->date }} -
                                                    {{ $booking->location }}</p>
                                            </div>
                                            <div>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $booking->status === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $booking->status }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-6">
                                    <div class="inline-block p-3 rounded-full bg-gray-100 mb-3">
                                        <i class="fas fa-calendar text-gray-400 text-xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-500">No booking history yet</p>
                                    <a href="{{ route('bookings.create') }}"
                                        class="mt-3 inline-block text-accent hover:underline">Book your first
                                        lesson</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tips & Weather -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4 bg-gray-900 text-white">
                        <h2 class="font-bold">Kitesurfing Tips & Weather</h2>
                    </div>
                    <div class="p-4">
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tip of the Day</h3>
                            <p class="text-sm text-gray-600">
                                "Always check your gear before heading out to the water. Inspect your kite for any tears
                                or damage, and ensure your lines are not tangled."
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Weather Forecast</h3>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="bg-gray-50 p-3 rounded-lg text-center">
                                    <p class="text-xs text-gray-500">Today</p>
                                    <i class="fas fa-sun text-yellow-400 text-xl my-2"></i>
                                    <p class="text-sm font-medium">21°C</p>
                                    <p class="text-xs text-gray-500">Wind: 18 km/h</p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg text-center">
                                    <p class="text-xs text-gray-500">Tomorrow</p>
                                    <i class="fas fa-cloud-sun text-gray-400 text-xl my-2"></i>
                                    <p class="text-sm font-medium">19°C</p>
                                    <p class="text-xs text-gray-500">Wind: 22 km/h</p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg text-center">
                                    <p class="text-xs text-gray-500">Day After</p>
                                    <i class="fas fa-cloud text-gray-400 text-xl my-2"></i>
                                    <p class="text-sm font-medium">18°C</p>
                                    <p class="text-xs text-gray-500">Wind: 15 km/h</p>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2 text-center">
                                * Weather data is for demonstration purposes only
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
