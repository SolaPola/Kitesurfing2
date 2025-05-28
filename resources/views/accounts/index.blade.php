<!-- filepath: c:\Users\solap\Herd\rijschoolvierkantwielen2\resources\views\accounts\index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - KitesurfingVS</title>
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
                    <h2 class="text-2xl font-bold text-gray-900">User Management</h2>
                    <a href="{{ route('accounts.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-accent text-white border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 transition-all">
                        <i class="fas fa-plus mr-2"></i>Create New User
                    </a>
                </div>
                <p class="text-gray-600 mt-1">Manage user accounts, permissions, and access levels.</p>
            </div>

            <!-- User Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-accent">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Total Users</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $users->count() }}</h3>
                        </div>
                        <div class="h-12 w-12 bg-accent/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-accent text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Active Users</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $users->where('is_active', true)->count() }}
                            </h3>
                        </div>
                        <div class="h-12 w-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-check text-green-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-red-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Inactive Users</p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ $users->where('is_active', false)->count() }}</h3>
                        </div>
                        <div class="h-12 w-12 bg-red-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-slash text-red-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-gray-900">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Online Users</p>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ $users->where('is_logged_in', true)->count() }}</h3>
                        </div>
                        <div class="h-12 w-12 bg-gray-900/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-clock text-gray-900 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md"
                    role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        </div>
                        <div>
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Users Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                    <h3 class="font-bold text-gray-900">User Accounts</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-900">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Username</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Birthdate</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Role</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr class="hover:bg-offwhite">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="h-8 w-8 rounded-full bg-accent/10 flex items-center justify-center mr-3">
                                                <span class="text-xs font-medium text-accent">
                                                    {{ strtoupper(substr($user->firstname, 0, 1) . substr($user->lastname, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->firstname }} {{ $user->infix }} {{ $user->lastname }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $user->username }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-accent/10 text-accent">
                                            {{ ucfirst($user->role->name) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('accounts.edit', $user) }}"
                                                class="bg-accent hover:bg-cyan-400 text-white px-2.5 py-1.5 rounded-md inline-flex items-center text-xs">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('accounts.destroy', $user) }}" method="POST"
                                                class="inline" onsubmit="return confirmDelete(this);">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-2.5 py-1.5 rounded-md inline-flex items-center text-xs">
                                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                        No users found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-gray-200 p-4 flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        Showing <span class="font-medium">{{ $users->firstItem() ?? 0 }}</span> to
                        <span class="font-medium">{{ $users->lastItem() ?? 0 }}</span> of
                        <span class="font-medium">{{ $users->total() }}</span> users
                    </p>

                    <!-- Pagination Links -->
                    <div class="flex items-center space-x-1">
                        @if ($users->onFirstPage())
                            <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-md cursor-not-allowed">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}"
                                class="px-3 py-1 bg-white hover:bg-offwhite text-gray-700 rounded-md border border-gray-200">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </a>
                        @endif

                        @foreach ($users->getUrlRange(max($users->currentPage() - 2, 1), min($users->currentPage() + 2, $users->lastPage())) as $page => $url)
                            <a href="{{ $url }}"
                                class="px-3 py-1 {{ $page == $users->currentPage() ? 'bg-accent text-white' : 'bg-white hover:bg-offwhite text-gray-700 border border-gray-200' }} rounded-md">
                                {{ $page }}
                            </a>
                        @endforeach

                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}"
                                class="px-3 py-1 bg-white hover:bg-offwhite text-gray-700 rounded-md border border-gray-200">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-md cursor-not-allowed">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this before the closing </body> tag -->
    <script>
        function confirmDelete(form) {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                return true;
            }
            return false;
        }
    </script>
</body>

</html>
