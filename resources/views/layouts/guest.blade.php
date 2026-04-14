<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    </head>
    <body class="font-sans antialiased bg-gray-950 text-gray-300">
        <nav class="border-b border-gray-900 sticky top-0 z-40 bg-gray-950">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-3">
                        <div class="text-2xl font-bold text-yellow-600">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <a href="{{ route('home') }}" class="text-lg font-bold text-gray-100">PropBook</a>
                            <p class="text-xs text-gray-500">Real Estate Booking</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-yellow-600 transition">
                            <i class="fas fa-list mr-2"></i>Properties
                        </a>
                        
                        @auth
                            <a href="{{ route('calendar') }}" class="text-gray-400 hover:text-yellow-600 transition">
                                <i class="fas fa-calendar mr-2"></i>Calendar
                            </a>
                            <div class="flex items-center gap-4">
                                <span class="text-sm text-gray-400">{{ Auth::user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-400 hover:text-yellow-600 transition">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition text-sm font-medium">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        {{ $slot }}
    </body>
</html>
