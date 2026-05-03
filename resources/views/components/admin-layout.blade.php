<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bongs Biryani') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-theme-dark text-gray-200 flex min-h-screen" style="font-family: 'Outfit', sans-serif;">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#13141a] border-r border-gray-800 hidden md:block">
            <div class="h-16 flex items-center px-6 border-b border-gray-800">
                <h1 class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-red-600">Bongs Biryani</h1>
            </div>
            <nav class="p-4 space-y-1">
                <x-admin-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">Dashboard</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.*')">Categories</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.products.index') }}" :active="request()->routeIs('admin.products.*')">Menu Items</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.orders.index') }}" :active="request()->routeIs('admin.orders.*')">Orders</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.coupons.index') }}" :active="request()->routeIs('admin.coupons.*')">Coupons</x-admin-nav-link>
                <x-admin-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">Users</x-admin-nav-link>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Topbar -->
            <header class="h-16 bg-[#13141a] border-b border-gray-800 flex items-center justify-between px-6">
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <div class="flex-1"></div>
                <!-- User Menu -->
                <div class="flex items-center space-x-4 shrink-0">
                    <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800">Log Out</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-6 overflow-y-auto w-full">
                <!-- Flash messages -->
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-5 py-4 rounded-xl shadow-sm flex items-center gap-3" role="alert">
                        <svg class="w-5 h-5 text-green-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <p class="font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 px-5 py-4 rounded-xl shadow-sm flex items-center gap-3" role="alert">
                        <svg class="w-5 h-5 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        <p class="font-semibold text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
