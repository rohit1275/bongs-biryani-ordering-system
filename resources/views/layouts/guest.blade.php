<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; }
            input[type="text"], input[type="email"], input[type="password"] {
                background-color: #1f2937 !important;
                border-color: #374151 !important;
                color: #e5e7eb !important;
            }
            .text-gray-600, .text-gray-700 { color: #9ca3af !important; }
            button[type="submit"] {
                background: linear-gradient(to right, #eab308, #ca8a04) !important;
                color: #111827 !important;
                font-weight: bold !important;
                border: none !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-200 antialiased bg-gray-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <span class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-yellow-600">
                        Bongs Biryani
                    </span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-6 py-8 bg-gray-800 border border-gray-700 shadow-xl overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
