<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KitesurfingVS</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#111827', // Changed from #000000 to gray-900 hex
                        'accent': '#06B6D4', // Tailwind's cyan-500
                        'offwhite': '#F8FAFC', // Tailwind's slate-50
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
                        <span class="text-accent font-bold text-xl">KitesurfingVS</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center justify-between space-x-4">
                    <div class="flex items-baseline space-x-4">
                        <a href="#"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">Home</a>
                        <a href="#"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">Services</a>
                        <a href="#"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">Lessons</a>
                        <a href="#"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">About
                            Us</a>
                        <a href="#"
                            class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-gray-800 hover:bg-opacity-70">Contact</a>
                    </div>
                    <div class="ml-4 flex items-center space-x-2">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-900 bg-accent hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-900 bg-accent hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white border-accent hover:bg-gray-800 hover:bg-opacity-70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent">
                                Sign Up
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-gray-900 overflow-hidden">
        <!-- Hero background image with aerial kitesurfing trick -->
        <div class="absolute inset-0">
            <img src="{{ asset('img/person-surfing-flying-parachute-same-time-kitesurfing-bonaire-caribbean.jpg') }}"
                alt="Kitesurfing action" class="w-full h-full object-cover opacity-40">
            <!-- This is where your first kitesurfing jump image will be displayed as a background -->
        </div>
        <div class="relative max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    <span class="block">Experience the Thrill of</span>
                    <span class="block text-accent">KiteSurfing</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-offwhite sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Learn to ride the waves and winds with our professional instructors.
                    Unforgettable adventure awaits on the water!
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="#"
                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-gray-900 bg-accent hover:bg-cyan-400 md:py-4 md:text-lg md:px-10">
                            Book a Lesson
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="#"
                            class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-900 border-white hover:bg-gray-800 hover:bg-opacity-70 md:py-4 md:text-lg md:px-10">
                            View Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-x-0 bottom-0 h-1 bg-accent"></div>
    </div>

    <!-- Package Selection Section -->
    <div class="py-16 bg-offwhite">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Choose Your Kitesurfing Package
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Select the perfect option that matches your experience level and preferences
                </p>
            </div>

            <!-- Package Selection Cards -->
            <div class="mt-12">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
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
                                    <p class="ml-2 text-sm text-gray-600">Safety briefing</p>
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
                            <button type="button" data-package="Private Lesson" data-price="175" data-hours="2.5"
                                data-id="1"
                                class="package-select-btn w-full bg-accent hover:bg-cyan-400 text-gray-900 font-medium py-2 px-4 rounded-md transition-colors">
                                Select Package
                            </button>
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
                            <button type="button" data-package="Single Duo Lesson" data-price="135"
                                data-hours="3.5" data-id="2"
                                class="package-select-btn w-full bg-accent hover:bg-cyan-400 text-gray-900 font-medium py-2 px-4 rounded-md transition-colors">
                                Select Package
                            </button>
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
                                    <p class="ml-2 text-sm text-gray-600">3 lessons × 3.5 hours (10.5h total)</p>
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
                            <button type="button" data-package="Duo 3-Lesson Package" data-price="375"
                                data-hours="10.5" data-id="3"
                                class="package-select-btn w-full bg-accent hover:bg-cyan-400 text-gray-900 font-medium py-2 px-4 rounded-md transition-colors">
                                Select Package
                            </button>
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
                                    <p class="ml-2 text-sm text-gray-600">5 lessons × 3.5 hours (17.5h total)</p>
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
                            <button type="button" data-package="Duo 5-Lesson Package" data-price="675"
                                data-hours="17.5" data-id="4"
                                class="package-select-btn w-full bg-accent hover:bg-cyan-400 text-gray-900 font-medium py-2 px-4 rounded-md transition-colors">
                                Select Package
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Form Panel - Initially Hidden -->
            <div id="booking-panel" class="mt-12 bg-white rounded-lg shadow-lg overflow-hidden hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900">Book Your Package</h3>
                    <p class="mt-1 text-gray-600" id="selected-package-info">Complete your booking details below</p>
                </div>

                <form id="booking-form" action="{{ route('bookings.store') }}" method="POST" class="p-6">
                    @csrf
                    <input type="hidden" name="package_id" id="package_id" value="">

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="location_id" class="block text-sm font-medium text-gray-700 mb-1">Select
                                Location</label>
                            <select id="location_id" name="location_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                <option value="" selected disabled>Choose a location</option>
                                @foreach (App\Models\Location::where('is_active', true)->get() as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="preferred_date" class="block text-sm font-medium text-gray-700 mb-1">Preferred
                                Date</label>
                            <input type="date" id="preferred_date" name="preferred_date" required
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                        </div>
                        <div>
                            <label for="number_of_participants"
                                class="block text-sm font-medium text-gray-700 mb-1">Number of
                                Participants</label>
                            <input type="number" id="number_of_participants" name="number_of_participants"
                                min="1" required value="1"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                        </div>
                        <div>
                            <label for="experience_level"
                                class="block text-sm font-medium text-gray-700 mb-1">Experience Level</label>
                            <select id="experience_level" name="experience_level" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                <option value="Beginner">Beginner - Never tried kitesurfing</option>
                                <option value="Novice">Novice - 1-2 lessons before</option>
                                <option value="Intermediate">Intermediate - Can ride but want to improve</option>
                                <option value="Advanced">Advanced - Want to learn new tricks</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-1">Special
                            Requests (Optional)</label>
                        <textarea id="special_requests" name="special_requests" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent"
                            placeholder="Any special requirements or questions?"></textarea>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600">Selected Package: <span id="final-package"
                                        class="font-medium">-</span></p>
                                <p class="text-sm text-gray-600">Price: <span id="final-price"
                                        class="font-medium">-</span></p>
                            </div>
                            <div class="flex space-x-3">
                                <button type="button" id="cancel-booking"
                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                    Cancel
                                </button>
                                @auth
                                    <button type="submit"
                                        class="px-4 py-2 bg-accent text-gray-900 font-medium rounded-md hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-accent">
                                        Continue to Payment
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="px-4 py-2 bg-accent text-gray-900 font-medium rounded-md hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-accent flex items-center justify-center">
                                        Login to Book
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Our Services
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Discover the perfect kitesurfing experience tailored to your needs
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="pt-6">
                        <div class="flow-root bg-white rounded-lg shadow-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span
                                        class="inline-flex items-center justify-center p-3 bg-accent rounded-md shadow-lg">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </span>
                                </div>

                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Priveles 2,5 hour
                                </h3>
                                <h4 class="mt-4 text-sm font-normal text-gray-900 tracking-tight">175$ including all
                                    gear</h4>

                                <p class="mt-5 text-base text-gray-600">
                                    Perfect for newcomers to the sport. Learn safety, basic techniques, and equipment
                                    handling with our expert instructors. For a Day
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-6">
                        <div class="flow-root bg-white rounded-lg shadow-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span
                                        class="inline-flex items-center justify-center p-3 bg-accent rounded-md shadow-lg">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </span>
                                </div>

                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Priveles 2,5 hour
                                </h3>
                                <h4 class="mt-4 text-sm font-normal text-gray-900 tracking-tight">175$ including all
                                    gear</h4>

                                <p class="mt-5 text-base text-gray-600">
                                    Perfect for newcomers to the sport. Learn safety, basic techniques, and equipment
                                    handling with our expert instructors. For a Day
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-white rounded-lg shadow-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span
                                        class="inline-flex items-center justify-center p-3 bg-accent rounded-md shadow-lg">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Advanced Training
                                </h3>
                                <p class="mt-5 text-base text-gray-600">
                                    For experienced riders looking to perfect their techniques and learn new tricks.
                                    Take your skills to the next level with our advanced courses.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-white rounded-lg shadow-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span
                                        class="inline-flex items-center justify-center p-3 bg-accent rounded-md shadow-lg">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 tracking-tight">Equipment Rental</h3>
                                <p class="mt-5 text-base text-gray-600">
                                    High-quality kitesurfing gear available for rental, from boards to kites and safety
                                    equipment.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Image Section -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Experience the Rush
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Capture the exhilarating moments of your kitesurfing journey
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('img/risco-del-paso-kitesurf-rental-description.jpg') }}"
                        alt="Kitesurfer performing aerial trick" class="w-full h-80 object-cover">
                    <div class="bg-white p-6">
                        <h3 class="text-xl font-bold text-gray-900">Master Aerial Tricks</h3>
                        <p class="mt-2 text-gray-600">Advanced courses will teach you how to achieve impressive jumps
                            and tricks.</p>
                    </div>
                </div>
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('img/pexels-sergk1-18696622.jpg') }}" alt="Kitesurfing lesson on the beach"
                        class="w-full h-80 object-cover">
                    <div class="bg-white p-6">
                        <h3 class="text-xl font-bold text-gray-900">Learn from Experts</h3>
                        <p class="mt-2 text-gray-600">Our professional instructors will guide you through every step of
                            your learning journey.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section with Image -->
    <div class="bg-offwhite py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-accent rounded-lg shadow-xl overflow-hidden lg:grid lg:grid-cols-2 lg:gap-4">
                <div class="pt-10 pb-12 px-6 sm:pt-16 sm:px-16 lg:py-16 lg:pr-0 xl:py-20 xl:px-20">
                    <div class="lg:self-center">
                        <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                            <span class="block">Ready to catch some waves?</span>
                        </h2>
                        <p class="mt-4 text-lg leading-6 text-white">
                            Book your first lesson today and discover why kitesurfing is the ultimate water sport
                            adventure!
                        </p>
                        <a href="#"
                            class="mt-8 bg-gray-900 border border-transparent rounded-md shadow px-5 py-3 inline-flex items-center text-base font-medium text-white hover:bg-gray-800">
                            Get Started
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <img src="{{ asset('img/1536x864_cmsv2_193b2680-389f-5ffe-83f6-e7e726f8df10-7260216.webp') }}"
                        alt="Kitesurfing action" class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-accent font-bold text-lg mb-4">KitesurfingVS</h3>
                    <p class="text-white text-sm">
                        Professional kitesurfing lessons and adventures. Our mission is to help you experience the
                        freedom of riding the wind and waves.
                    </p>
                </div>
                <div>
                    <h3 class="text-accent font-bold text-lg mb-4">Contact</h3>
                    <ul class="text-white text-sm">
                        <li class="mb-2">Beach Avenue 123</li>
                        <li class="mb-2">Ocean City, CA 12345</li>
                        <li class="mb-2">info@kitesurfingvs.com</li>
                        <li>+1 (555) 123-4567</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-accent font-bold text-lg mb-4">Lesson Hours</h3>
                    <ul class="text-white text-sm">
                        <li class="mb-2">Monday - Friday: 09:00 - 18:00</li>
                        <li class="mb-2">Saturday: 08:00 - 17:00</li>
                        <li>Sunday: 10:00 - 16:00</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-accent pt-8 md:flex md:items-center md:justify-between">
                <p class="text-white text-sm">
                    &copy; {{ date('Y') }} KitesurfingVS. All rights reserved.
                </p>
                <div class="mt-4 md:mt-0">
                    <div class="flex space-x-6">
                        <a href="#" class="text-white hover:text-accent">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-accent">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Add before closing body tag -->
    <script>
        // Package selection functionality
        document.addEventListener('DOMContentLoaded', function() {
            const packageButtons = document.querySelectorAll('.package-select-btn');
            const bookingPanel = document.getElementById('booking-panel');
            const cancelButton = document.getElementById('cancel-booking');
            const finalPackage = document.getElementById('final-package');
            const finalPrice = document.getElementById('final-price');
            const packageInfo = document.getElementById('selected-package-info');
            const packageIdInput = document.getElementById('package_id');

            // Add click event to all package buttons
            packageButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const packageName = this.dataset.package;
                    const price = this.dataset.price;
                    const hours = this.dataset.hours;
                    const packageId = this.dataset.id;

                    // Update booking panel information
                    finalPackage.textContent = packageName;
                    finalPrice.textContent = `€${price} per person`;
                    packageInfo.textContent = `${packageName} (${hours} hours of instruction)`;
                    packageIdInput.value = packageId;

                    // Show booking panel and scroll to it
                    bookingPanel.classList.remove('hidden');
                    bookingPanel.scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Cancel booking button
            cancelButton.addEventListener('click', function() {
                bookingPanel.classList.add('hidden');
            });
        });
    </script>
</body>

</html>
