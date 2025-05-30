<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Lessons - KitesurfingVS</title>
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
                <span class="ml-2 text-sm bg-accent/20 text-accent px-2 py-0.5 rounded">Instructor</span>
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
                <h2 class="font-medium">Instructor Portal</h2>
            </div>
            <nav class="p-2">
                <a href="{{ route('instructor.dashboard') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="{{ route('instructor.lessons') }}"
                    class="block px-4 py-3 rounded-lg bg-accent text-white font-medium mb-1">
                    <i class="fas fa-calendar-alt mr-3"></i>Lessons
                </a>
                <a href="{{ route('instructor.profile') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-user mr-3"></i>Profile
                </a>
                <a href="{{ route('instructor.students') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-users mr-3"></i>Students
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
                <h1 class="text-2xl font-bold text-gray-900">My Lessons</h1>
                <p class="text-gray-600">View and manage your scheduled kitesurfing lessons</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Today's Lessons -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Today's Lessons</h2>

                @if (isset($todayLessons) && count($todayLessons) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Time</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Package</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Location</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lesson #</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($todayLessons as $lesson)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ date('H:i', strtotime($lesson->start_time)) }} -
                                            {{ date('H:i', strtotime($lesson->end_time)) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $lesson->firstname }} {{ $lesson->lastname }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $lesson->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lesson->package_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lesson->location_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lesson->lesson_number }} of {{ $lesson->number_of_lessons }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if ($lesson->status == 'Scheduled') bg-yellow-100 text-yellow-800 
                                            @elseif($lesson->status == 'In Progress') bg-blue-100 text-blue-800
                                            @elseif($lesson->status == 'Completed') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                                {{ $lesson->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <button type="button" onclick="showLessonDetails({{ $lesson->id }})"
                                                    class="text-accent hover:text-cyan-400">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                @if ($lesson->status === 'Scheduled')
                                                    <form
                                                        action="{{ route('instructor.lessons.update-status', $lesson->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="In Progress">
                                                        <button type="submit"
                                                            class="text-blue-600 hover:text-blue-800">
                                                            <i class="fas fa-play"></i> Start
                                                        </button>
                                                    </form>
                                                    
                                                    <a href="{{ route('instructor.lessons.cancel-form', $lesson->id) }}" class="text-red-600 hover:text-red-800">
                                                        <i class="fas fa-ban"></i> Cancel
                                                    </a>
                                                @elseif($lesson->status === 'In Progress')
                                                    <form
                                                        action="{{ route('instructor.lessons.update-status', $lesson->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Completed">
                                                        <button type="submit"
                                                            class="text-green-600 hover:text-green-800">
                                                            <i class="fas fa-check-circle"></i> Complete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-8 text-center">
                        <i class="fas fa-calendar-day text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500">You don't have any lessons scheduled for today.</p>
                    </div>
                @endif
            </div>

            <!-- Upcoming Lessons -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Upcoming Lessons</h2>

                @if (isset($upcomingLessons) && count($upcomingLessons) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Time</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Package</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Location</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lesson #</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($upcomingLessons as $lesson)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ date('d/m/Y', strtotime($lesson->lesson_date)) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ date('H:i', strtotime($lesson->start_time)) }} -
                                            {{ date('H:i', strtotime($lesson->end_time)) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $lesson->firstname }} {{ $lesson->lastname }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $lesson->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lesson->package_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lesson->location_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lesson->lesson_number }} of {{ $lesson->number_of_lessons }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $lesson->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <button type="button" onclick="showLessonDetails({{ $lesson->id }})"
                                                    class="text-accent hover:text-cyan-400">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                
                                                @if($lesson->status === 'Scheduled')
                                                    <a href="{{ route('instructor.lessons.cancel-form', $lesson->id) }}" class="text-red-600 hover:text-red-800">
                                                        <i class="fas fa-ban"></i> Cancel
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-8 text-center">
                        <i class="fas fa-calendar text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500">You don't have any upcoming lessons scheduled.</p>
                    </div>
                @endif
            </div>

            <!-- Past Lessons -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Past Lessons</h2>
                    <a href="#" class="text-accent hover:text-cyan-400 text-sm">View All Past Lessons</a>
                </div>

                @if (isset($pastLessons) && count($pastLessons) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Package</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Location</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lesson #</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pastLessons as $lesson)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ date('d/m/Y', strtotime($lesson->lesson_date)) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $lesson->firstname }} {{ $lesson->lastname }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $lesson->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lesson->package_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lesson->location_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lesson->lesson_number }} of {{ $lesson->number_of_lessons }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if ($lesson->status == 'Completed') bg-green-100 text-green-800 
                                            @elseif($lesson->status == 'Cancelled') bg-red-100 text-red-800
                                            @elseif($lesson->status == 'No-Show') bg-orange-100 text-orange-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                                {{ $lesson->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button type="button" onclick="showLessonDetails({{ $lesson->id }})"
                                                class="text-accent hover:text-cyan-400">
                                                <i class="fas fa-eye"></i> View Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-8 text-center">
                        <i class="fas fa-history text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500">You don't have any past lessons.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Lesson Details Modal -->
    <div id="lessonDetailsModal"
        class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Lesson Details</h3>
                <button onclick="hideLessonDetails()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4" id="lessonDetailsContent">
                <!-- Content will be loaded dynamically -->
                <div class="flex justify-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-accent"></div>
                </div>
            </div>
            <div class="border-t p-4 flex justify-end">
                <button onclick="hideLessonDetails()"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        function showLessonDetails(lessonId) {
            document.getElementById('lessonDetailsModal').classList.remove('hidden');

            // In a real application, you would fetch the lesson details via AJAX
            // For now, we'll use placeholder data
            const content = `
                <div class="space-y-4">
                    <div>
                        <h4 class="font-bold text-gray-700">Student Information</h4>
                        <div class="bg-gray-50 p-3 rounded">
                            <p><span class="font-medium">Name:</span> John Doe</p>
                            <p><span class="font-medium">Email:</span> john@example.com</p>
                            <p><span class="font-medium">Experience:</span> Beginner</p>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="font-bold text-gray-700">Lesson Information</h4>
                        <div class="bg-gray-50 p-3 rounded">
                            <p><span class="font-medium">Package:</span> Private Lesson</p>
                            <p><span class="font-medium">Date:</span> 15/06/2023</p>
                            <p><span class="font-medium">Time:</span> 10:00 - 12:30</p>
                            <p><span class="font-medium">Location:</span> Zandvoort Beach</p>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="font-bold text-gray-700">Add Notes</h4>
                        <form>
                            <textarea class="w-full p-2 border border-gray-300 rounded mt-1" rows="3" placeholder="Enter notes about this lesson..."></textarea>
                            <div class="flex justify-end mt-2">
                                <button type="button" class="px-4 py-2 bg-accent text-white rounded-md hover:bg-cyan-600">Save Notes</button>
                            </div>
                        </form>
                    </div>
                </div>
            `;

            document.getElementById('lessonDetailsContent').innerHTML = content;
        }

        function hideLessonDetails() {
            document.getElementById('lessonDetailsModal').classList.add('hidden');
        }
    </script>
</body>

</html>
