<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - KitesurfingVS</title>
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
            background-image: url('img/quest-ce-que-le-kitesurf.jpg');
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
                <h2 class="mt-4 text-2xl font-bold text-white">Create an Account</h2>
                <p class="mt-2 text-sm text-gray-300">
                    Join our community of kitesurfing enthusiasts
                </p>
            </div>

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

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Enter your email to get started. We\'ll send you an activation link to complete your registration.') }}
                </div>

                <form class="mt-6 space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent text-lg"
                            placeholder="Enter your email">

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-accent hover:text-cyan-400">
                            Already have an account? Sign in
                        </a>
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-lg font-medium rounded-md text-gray-900 bg-accent hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-user-plus text-gray-900 group-hover:text-gray-900"></i>
                            </span>
                            Register
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-300">
                    By registering, you agree to our <a href="#"
                        class="font-medium text-accent hover:text-cyan-400">Terms of Service</a> and <a href="#"
                        class="font-medium text-accent hover:text-cyan-400">Privacy Policy</a>.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
