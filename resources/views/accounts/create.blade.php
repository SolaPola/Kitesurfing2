<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - KitesurfingVS</title>
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
                <span class="ml-2 text-sm bg-accent/20 text-accent px-2 py-0.5 rounded">Admin</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-white">Welcome, {{ Auth::user()->firstname }}</span>
                <div class="relative">
                    <button id="notifications-btn" class="text-white hover:text-accent">
                        <i class="fas fa-bell"></i>
                        <span
                            class="absolute -top-1 -right-1 bg-accent text-primary text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
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
                <h2 class="font-medium">Admin Panel</h2>
            </div>
            <nav class="p-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="{{ route('accounts.index') }}"
                    class="block px-4 py-3 rounded-lg bg-accent text-white font-medium mb-1">
                    <i class="fas fa-users mr-3"></i>User Overview
                </a>
                <a href="#"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-calendar-alt mr-3"></i>Lessons
                </a>
                <a href="#"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-life-ring mr-3"></i>Equipment
                </a>
                <a href="#"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-chart-line mr-3"></i>Analytics
                </a>
                <a href="#"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-cog mr-3"></i>Settings
                </a>
            </nav>

            <div class="p-4 bg-offwhite border-t border-gray-200 mt-2">
                <div class="flex items-center">
                    <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                    <span class="text-sm text-gray-600">System Status: Online</span>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-1">
            <!-- Page header -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Create New User</h2>
                        <p class="text-gray-600 mt-1">Add a new user to the system</p>
                    </div>
                    <a href="{{ route('accounts.index') }}" class="text-accent hover:text-accent/80">
                        <i class="fas fa-arrow-left mr-1"></i> Back to users
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('accounts.store') }}" method="POST">
                        @csrf

                        <!-- Form errors -->
                        @if ($errors->any())
                            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                                <div class="font-medium">Please fix the following errors:</div>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Form sections -->
                        <div class="space-y-8">
                            <!-- Personal Information -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Personal Information
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label for="firstname"
                                            class="block text-sm font-medium text-gray-700 mb-1">First Name <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="firstname" id="firstname"
                                            value="{{ old('firstname') }}" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                    </div>

                                    <div>
                                        <label for="infix"
                                            class="block text-sm font-medium text-gray-700 mb-1">Infix</label>
                                        <input type="text" name="infix" id="infix" value="{{ old('infix') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                    </div>

                                    <div>
                                        <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Last
                                            Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="lastname" id="lastname"
                                            value="{{ old('lastname') }}" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label for="birthdate"
                                        class="block text-sm font-medium text-gray-700 mb-1">Birthdate <span
                                            class="text-red-500">*</span></label>
                                    <input type="date" name="birthdate" id="birthdate"
                                        value="{{ old('birthdate') }}" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                </div>
                            </div>

                            <!-- Account Information -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Account Information
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="username"
                                            class="block text-sm font-medium text-gray-700 mb-1">Username <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="username" id="username"
                                            value="{{ old('username') }}" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                    </div>

                                    <div>
                                        <label for="email"
                                            class="block text-sm font-medium text-gray-700 mb-1">Email Address <span
                                                class="text-red-500">*</span></label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email') }}" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                    </div>
                                </div>

                                <!-- Auto-generated password note -->
                                {{-- <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-blue-800">Password Information</h3>
                                            <div class="mt-1 text-sm text-blue-700">
                                                <p>A temporary password will be automatically generated and sent to the user's email address.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                                <!-- Role Information -->
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Role Information
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="role_id"
                                                class="block text-sm font-medium text-gray-700 mb-1">Role <span
                                                    class="text-red-500">*</span></label>
                                            <select name="role_id" id="role_id" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                                                <option value="">-- Select Role --</option>
                                                @foreach (\App\Models\Role::whereIn('name', ['student', 'instructor'])->get() as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="flex justify-end space-x-3 pt-4 border-t">
                                    <a href="{{ route('accounts.index') }}"
                                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                        Cancel
                                    </a>
                                    <button type="submit"
                                        class="px-4 py-2 bg-accent text-white rounded-md hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-accent">
                                        Create User
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
