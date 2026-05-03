<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bongs Biryani - Authentic Taste</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 border-gray-200 flex flex-col min-h-screen" style="font-family: 'Outfit', sans-serif;">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-red-600">
                Bongs Biryani
            </h1>
            <div>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 mx-4">Admin Dashboard</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 mx-4">My Account</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 mx-4">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1 flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl text-center space-y-8">
            <h2 class="text-5xl font-extrabold text-gray-900 tracking-tight">The Best Biryani in Town</h2>
            <p class="text-xl text-gray-500">Order from our wide selection of authentic Biryanis, Starters, and Rolls.</p>
            <div class="mt-8 flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-orange-500 to-red-600 shadow hover:shadow-lg transition-all">
                    Order Now (Login Required)
                </a>
            </div>
            
            <div class="mt-16 bg-white rounded-xl shadow-lg border border-gray-100 p-8 text-left">
                <h3 class="text-2xl font-bold text-gray-900 mb-4 border-b pb-2">Looking for the Admin Panel?</h3>
                <p class="text-gray-600 mb-4">You can access the backend system we just built to manage the entire restaurant.</p>
                <div class="bg-gray-50 p-4 rounded-md border border-gray-200 mb-4">
                    <p class="text-sm text-gray-700 font-mono"><strong>Email:</strong> admin@bongs.com</p>
                    <p class="text-sm text-gray-700 font-mono"><strong>Password:</strong> password</p>
                </div>
                <a href="{{ route('login') }}" class="text-orange-600 font-semibold hover:text-orange-800 transition flex items-center">
                    Proceed to Login
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Bongs Biryani. All rights reserved.
        </div>
    </footer>
</body>
</html>
