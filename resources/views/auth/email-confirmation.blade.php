<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation - KitesurfingVS</title>
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
            background-image: url('img/kitesurfing1.webp');
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
                <h2 class="mt-4 text-2xl font-bold text-white">Registration Confirmation</h2>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">Registration Email Sent Successfully</h3>
                            <div class="mt-2 text-sm text-green-700">
                                @if (session('registered_email'))
                                    <p>We've sent an activation link to
                                        <strong>{{ session('registered_email') }}</strong>.</p>
                                @else
                                    <p>We've sent an activation link to your email address.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">What happens next?</h2>
                    <ol class="list-decimal list-inside space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span
                                class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-accent text-white font-bold mr-2">1</span>
                            <span>Check your email inbox for a message from KitesurfingVS.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-accent text-white font-bold mr-2">2</span>
                            <span>Click the activation link in the email.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-accent text-white font-bold mr-2">3</span>
                            <span>Complete your profile by providing your personal details and creating a
                                password.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-accent text-white font-bold mr-2">4</span>
                            <span>Start booking your kitesurfing adventures!</span>
                        </li>
                    </ol>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                Didn't receive the email? Check your spam folder or <button type="button"
                                    onclick="resendEmail()"
                                    class="font-medium underline text-blue-700 hover:text-blue-900">click here to
                                    resend</button>.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="text-accent hover:text-cyan-500 font-medium">
                        Return to Login Page
                    </a>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-sm text-white hover:text-accent">
                    Return to Homepage
                </a>
            </div>
        </div>
    </div>

    <form id="resend-form" action="{{ route('verification.resend') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        function resendEmail() {
            document.getElementById('resend-form').submit();
        }
    </script>
</body>

</html>
