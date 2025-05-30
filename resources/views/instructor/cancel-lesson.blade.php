<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Lesson - KitesurfingVS</title>
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
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="mb-6">
            <a href="{{ route('instructor.lessons') }}" class="text-accent hover:text-cyan-400 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Lessons
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6 bg-gray-900 text-white">
                <h1 class="text-2xl font-bold">Cancel Lesson</h1>
            </div>

            <div class="p-6">
                @if($errors->any())
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                        <p class="font-bold">Please fix the following errors:</p>
                        <ul class="list-disc ml-4">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Lesson Information</h2>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Student</p>
                                <p class="font-medium">{{ $booking->user->firstname }} {{ $booking->user->lastname }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Package</p>
                                <p class="font-medium">{{ $booking->package->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Date</p>
                                <p class="font-medium">{{ date('d/m/Y', strtotime($session->lesson_date)) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Time</p>
                                <p class="font-medium">{{ date('H:i', strtotime($session->start_time)) }} - {{ date('H:i', strtotime($session->end_time)) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Location</p>
                                <p class="font-medium">{{ $booking->location->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status</p>
                                <p class="font-medium">{{ $session->status }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('instructor.lessons.cancel', $session->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label for="cancel_reason" class="block text-sm font-medium text-gray-700 mb-1">Reason for Cancellation</label>
                        <select id="cancel_reason_type" name="cancel_reason_type" class="w-full mb-3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent">
                            <option value="" disabled selected>Select a reason...</option>
                            <option value="Weather">Bad Weather Conditions</option>
                            <option value="Illness">Instructor Illness</option>
                            <option value="Equipment">Equipment Problems</option>
                            <option value="Other">Other (please specify)</option>
                        </select>
                        
                        <textarea id="cancel_reason" name="cancel_reason" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent" placeholder="Please provide details about the cancellation reason..."></textarea>
                    </div>
                    
                    <div class="mb-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="notify_student" name="notify_student" type="checkbox" value="1" checked class="h-4 w-4 text-accent border-gray-300 rounded focus:ring-accent">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="notify_student" class="font-medium text-gray-700">Notify student about cancellation</label>
                                <p class="text-gray-500">An email will be sent to the student with the cancellation details and reason.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Warning:</strong> Cancelling this lesson may affect your instructor rating and the student's experience. Please only cancel when necessary.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between">
                        <a href="{{ route('instructor.lessons') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Confirm Cancellation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reasonTypeSelect = document.getElementById('cancel_reason_type');
            const reasonTextarea = document.getElementById('cancel_reason');
            
            reasonTypeSelect.addEventListener('change', function() {
                const selectedReason = this.value;
                
                if (selectedReason === "Weather") {
                    reasonTextarea.value = "Due to bad weather conditions (";
                } else if (selectedReason === "Illness") {
                    reasonTextarea.value = "Due to instructor illness (";
                } else if (selectedReason === "Equipment") {
                    reasonTextarea.value = "Due to equipment problems (";
                } else {
                    reasonTextarea.value = "";
                }
                
                // Focus on the textarea for the user to continue typing
                reasonTextarea.focus();
                // Place cursor at the end
                reasonTextarea.selectionStart = reasonTextarea.value.length;
                reasonTextarea.selectionEnd = reasonTextarea.value.length;
            });
        });
    </script>
</body>

</html>
