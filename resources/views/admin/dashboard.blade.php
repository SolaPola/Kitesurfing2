<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KitesurfingVS</title>
    <!-- Tailwind CSS -->
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
    <!-- Font Awesome for icons -->
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
                <span class="text-sm text-white">Welcome, {{ Auth::user()->name }}</span>
                <div class="relative">
                    <button id="notifications-btn" class="text-white hover:text-accent">
                        <i class="fas fa-bell"></i>
                        <span
                            class="absolute -top-1 -right-1 bg-accent text-primary text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                    </button>
                </div>
                <div class="h-8 w-8 rounded-full bg-accent flex items-center justify-center">
                    <span class="text-xs font-medium text-primary">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
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
                    class="block px-4 py-3 rounded-lg bg-accent text-white font-medium mb-1">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="{{ route('accounts.index') }}"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-users mr-3"></i>User Overview
                </a>
                <a href="#"
                    class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-offwhite hover:text-accent mb-1">
                    <i class="fas fa-calendar-alt mr-3"></i>Lesson Schedule
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
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-600">Welcome to your admin dashboard. Here's an overview of your business.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-accent">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Total Users</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\User::count() }}</h3>
                        </div>
                        <div class="h-12 w-12 bg-accent/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-accent text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-2">
                        <div class="bg-offwhite rounded-lg p-2">
                            <p class="text-xs text-gray-600">Active</p>
                            <p class="text-sm font-bold text-gray-900">
                                {{ \App\Models\User::where('is_active', true)->count() }}</p>
                        </div>
                        <div class="bg-offwhite rounded-lg p-2">
                            <p class="text-xs text-gray-600">Inactive</p>
                            <p class="text-sm font-bold text-gray-900">
                                {{ \App\Models\User::where('is_active', false)->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-gray-900">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Lessons Booked</p>
                            <h3 class="text-2xl font-bold text-gray-900">37</h3>
                        </div>
                        <div class="h-12 w-12 bg-gray-900/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-check text-gray-900 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-green-500 mt-2">
                        <i class="fas fa-arrow-up mr-1"></i> 8% from last month
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Revenue</p>
                            <h3 class="text-2xl font-bold text-gray-900">$5,680</h3>
                        </div>
                        <div class="h-12 w-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-green-500 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-green-500 mt-2">
                        <i class="fas fa-arrow-up mr-1"></i> 23% from last month
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Equipment Usage</p>
                            <h3 class="text-2xl font-bold text-gray-900">87%</h3>
                        </div>
                        <div class="h-12 w-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-life-ring text-yellow-500 text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-yellow-500 mt-2">
                        <i class="fas fa-arrow-right mr-1"></i> 3% same as last month
                    </p>
                </div>
            </div>

            <!-- User Overview Summary -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">User Overview</h2>
                    <a href="{{ route('accounts.index') }}" class="text-accent hover:text-accent/80 text-sm">
                        View all users <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-offwhite rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-accent/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user-plus text-accent"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">New Users (30 days)</p>
                                <p class="text-xl font-bold text-gray-900">
                                    {{ \App\Models\User::where('created_at', '>=', now()->subDays(30))->count() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-offwhite rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-green-500/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-users-cog text-green-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Admin Users</p>
                                <p class="text-xl font-bold text-gray-900">
                                    {{ \App\Models\User::whereHas('role', function ($query) {$query->where('name', 'admin');})->count() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-offwhite rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-yellow-500/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user-graduate text-yellow-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Student Users</p>
                                <p class="text-xl font-bold text-gray-900">
                                    {{ \App\Models\User::whereHas('role', function ($query) {$query->where('name', 'student');})->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Recently registered users</p>
                    <div class="mt-2">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Birthdate
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach (\App\Models\User::orderBy('created_at', 'desc')->take(5)->get() as $user)
                                    <tr class="hover:bg-offwhite">
                                        <td class="px-3 py-2 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-8 w-8 rounded-full bg-accent/10 flex items-center justify-center mr-3">
                                                    <span class="text-xs font-medium text-accent">
                                                        {{ strtoupper(substr($user->firstname, 0, 1) . substr($user->lastname, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $user->firstname }}
                                                        {{ $user->lastname }}</div>
                                                    <div class="text-xs text-gray-500">Registered
                                                        {{ $user->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') }}
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap">
                                            @if ($user->is_active)
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">
                                            <a href="{{ route('accounts.edit', $user) }}"
                                                class="text-accent hover:text-accent/80">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & Upcoming Lessons -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-md">
                    <!-- ...existing code... -->
                </div>

                <!-- Upcoming Lessons -->
                <div class="bg-white rounded-lg shadow-md">
                    <!-- ...existing code... -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
