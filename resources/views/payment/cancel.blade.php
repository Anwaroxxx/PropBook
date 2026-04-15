<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled - PropBook</title>

    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-950 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-yellow-600 flex items-center justify-center">
                        <i class="fas fa-building text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-white">PropBook</p>
                        <p class="text-xs text-gray-500">Real Estate Booking</p>
                    </div>
                </a>

                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-yellow-600 font-medium transition text-sm inline-flex items-center gap-2">
                        <i class="fas fa-home"></i><span class="hidden sm:inline">Dashboard</span>
                    </a>

                    <a href="{{ route('calendar') }}" class="text-gray-400 hover:text-yellow-600 font-medium transition text-sm inline-flex items-center gap-2">
                        <i class="fas fa-calendar"></i><span class="hidden sm:inline">Calendar</span>
                    </a>

                    <div class="flex items-center gap-4 pl-6 border-l border-gray-800">
                        <div class="text-sm">
                            <p class="font-medium text-gray-300">{{ Auth::user()->name }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition p-2 rounded-lg hover:bg-gray-800">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Cancel Content -->
    <div class="flex items-center justify-center min-h-[calc(100vh-64px)] py-12">
        <div class="max-w-lg w-full px-4">
            <!-- Cancel Icon -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-600/20 mb-4">
                    <i class="fas fa-times-circle text-6xl text-red-500"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-3">Payment Cancelled</h1>
                <p class="text-gray-400">Your payment was not processed</p>
            </div>

            <!-- Details Card -->
            <div class="card p-6 mb-8">
                <div class="space-y-4">
                    <div class="flex items-start gap-3 p-3 rounded-lg bg-yellow-600/10 border border-yellow-600/20">
                        <i class="fas fa-info-circle text-yellow-500 mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-gray-200">Your booking is still saved</p>
                            <p class="text-sm text-gray-400 mt-0.5">You can retry the payment anytime</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 rounded-lg bg-yellow-600/10 border border-yellow-600/20">
                        <i class="fas fa-clock text-yellow-500 mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-gray-200">No rush to complete payment</p>
                            <p class="text-sm text-gray-400 mt-0.5">Your visit slot is reserved</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 rounded-lg bg-yellow-600/10 border border-yellow-600/20">
                        <i class="fas fa-shield-alt text-yellow-500 mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-gray-200">No changes to your visit</p>
                            <p class="text-sm text-gray-400 mt-0.5">Your booking details remain the same</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="{{ route('calendar') }}" class="w-full btn-primary text-center justify-center py-3">
                    <i class="fas fa-calendar"></i>Return to Calendar
                </a>
                <a href="{{ route('dashboard') }}" class="w-full btn-secondary text-center justify-center py-3">
                    <i class="fas fa-home"></i>Go to Dashboard
                </a>
            </div>

            <!-- Info Box -->
            <div class="mt-8 card p-5">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-yellow-600/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-lightbulb text-yellow-500"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-white mb-2">Payment Tips</h3>
                        <p class="text-sm text-gray-400 mb-3">
                            Make sure your card details are correct and you have sufficient funds. Try using a different card if the issue persists.
                        </p>
                        <a href="mailto:support@propbook.com" class="text-yellow-600 hover:text-yellow-500 font-medium text-sm inline-flex items-center gap-2">
                            <i class="fas fa-headset"></i>Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 text-gray-500 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
            <p>&copy; 2026 PropBook. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
