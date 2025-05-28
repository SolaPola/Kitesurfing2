<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - KitesurfingVS</title>
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
        .card-input {
            letter-spacing: 0.125em;
        }
        .card-logo {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
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
                    <div class="rounded-full w-8 h-8 bg-accent flex items-center justify-center text-white text-sm font-bold">
                        2
                    </div>
                    <div class="absolute -bottom-6 w-max text-center text-xs text-accent font-medium">
                        Payment Details
                    </div>
                </div>
                <div class="flex-1 h-1 bg-gray-300"></div>
                <div class="flex items-center relative">
                    <div class="rounded-full w-8 h-8 bg-gray-300 flex items-center justify-center text-white text-sm">
                        3
                    </div>
                    <div class="absolute -bottom-6 w-max text-center text-xs text-gray-500 font-medium">
                        Confirmation
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Payment Form -->
            <div class="md:col-span-2">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6 bg-gray-900 text-white">
                        <h1 class="text-2xl font-bold">Payment Details</h1>
                    </div>

                    <div class="p-6">
                        @if ($errors->any())
                            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                                <p class="font-bold">Please fix the following errors:</p>
                                <ul class="list-disc ml-4">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('bookings.process-payment', $booking) }}" method="POST">
                            @csrf

                            <div class="mb-6">
                                <label for="card_holder" class="block text-sm font-medium text-gray-700 mb-1">Cardholder Name</label>
                                <input type="text" id="card_holder" name="card_holder" required
                                    placeholder="John Doe"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                            </div>

                            <div class="mb-6 relative">
                                <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                                <input type="text" id="card_number" name="card_number" required
                                    placeholder="1234 5678 9012 3456" maxlength="16"
                                    class="card-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                <div class="card-logo">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div>
                                    <label for="expiration_month" class="block text-sm font-medium text-gray-700 mb-1">Month</label>
                                    <select id="expiration_month" name="expiration_month" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div>
                                    <label for="expiration_year" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                                    <select id="expiration_year" name="expiration_year" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                        @for ($i = date('Y'); $i <= date('Y') + 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div>
                                    <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                    <input type="text" id="cvv" name="cvv" required
                                        placeholder="123" maxlength="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between items-center">
                                <a href="{{ route('bookings.create') }}" class="text-accent hover:underline">
                                    <i class="fas fa-arrow-left mr-1"></i> Back
                                </a>
                                <button type="submit"
                                    class="px-6 py-3 bg-accent text-gray-900 font-medium rounded-md hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-accent">
                                    Complete Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4 bg-gray-100 border-b border-gray-200">
                        <h2 class="font-bold text-gray-800">Order Summary</h2>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Package:</span>
                            <span class="font-medium">{{ $booking->package->name }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Location:</span>
                            <span class="font-medium">{{ $booking->location->name }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Date:</span>
                            <span class="font-medium">{{ date('d/m/Y', strtotime($booking->preferred_date)) }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Participants:</span>
                            <span class="font-medium">{{ $booking->number_of_participants }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Experience Level:</span>
                            <span class="font-medium">{{ $booking->experience_level }}</span>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Price per person:</span>
                                <span class="font-medium">€{{ number_format($booking->package->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between font-bold text-lg mt-2">
                                <span>Total:</span>
                                <span>€{{ number_format($booking->total_price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                This is a demo payment page. No actual payment will be processed.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format credit card input
            const cardNumberInput = document.getElementById('card_number');
            if (cardNumberInput) {
                cardNumberInput.addEventListener('input', function(e) {
                    // Remove non-digits
                    let value = e.target.value.replace(/\D/g, '');
                    // Limit to 16 digits
                    value = value.substring(0, 16);
                    e.target.value = value;
                });
            }

            // Format CVV input
            const cvvInput = document.getElementById('cvv');
            if (cvvInput) {
                cvvInput.addEventListener('input', function(e) {
                    // Remove non-digits
                    let value = e.target.value.replace(/\D/g, '');
                    // Limit to 3 digits
                    value = value.substring(0, 3);
                    e.target.value = value;
                });
            }
        });
    </script>
</body>
</html>
