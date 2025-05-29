<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Registration - KitesurfingVS</title>
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
            background-image: url('img/1600x900.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="antialiased">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-900 bg-opacity-70">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <a href="{{ route('home') }}">
                    <h2 class="text-4xl font-bold text-accent mt-6">KitesurfingVS</h2>
                </a>
                <h2 class="mt-4 text-2xl font-bold text-white">Complete Your Registration</h2>
                <p class="mt-2 text-sm text-gray-300">
                    Set up your account details to start booking kitesurfing adventures
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                @if (session('status'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-800">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form class="mt-6 space-y-4" method="POST" action="{{ route('password.set') }}">
                    @csrf

                    <!-- Hidden Fields -->
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="hidden" name="hash" value="{{ $hash }}">

                    <!-- First Name -->
                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input id="firstname" name="firstname" type="text" required autofocus
                            value="{{ old('firstname') }}"
                            class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent text-lg"
                            placeholder="Enter your first name">
                        @error('firstname')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input id="lastname" name="lastname" type="text" required value="{{ old('lastname') }}"
                            class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent text-lg"
                            placeholder="Enter your last name">
                        @error('lastname')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input id="username" name="username" type="text" required value="{{ old('username') }}"
                            class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent text-lg"
                            placeholder="Choose a username">
                        @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Birthdate Field -->
                    <div>
                        <label for="birthdate" class="block text-sm font-medium text-gray-700">Birthdate</label>
                        <input id="birthdate" name="birthdate" type="date" required value="{{ old('birthdate') }}"
                            max="{{ date('Y-m-d') }}"
                            class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent text-lg">
                        @error('birthdate')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="new-password"
                            class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent text-lg"
                            placeholder="Create a secure password">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="mt-3 p-3 bg-blue-50 rounded-md">
                            <h4 class="text-sm font-medium text-blue-800">Password Requirements:</h4>
                            <ul class="mt-1 pl-5 text-sm text-blue-700 list-disc">
                                <li>At least 12 characters long</li>
                                <li>Include at least one uppercase letter</li>
                                <li>Include at least one number</li>
                                <li>Include at least one special character (e.g., @, #, $)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            autocomplete="new-password"
                            class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent text-lg"
                            placeholder="Confirm your password">
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-gray-900 bg-accent hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent">
                            Complete Registration
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-4">
                <p class="text-sm text-gray-300">
                    By completing registration, you agree to our <a href="#"
                        class="font-medium text-accent hover:text-cyan-400">Terms of Service</a> and
                    <a href="#" class="font-medium text-accent hover:text-cyan-400">Privacy Policy</a>.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
