<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled - PropBook</title>
    
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gradient-to-b from-red-50 to-orange-100 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <div class="text-2xl font-bold text-blue-600">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">PropBook</a>
                        <p class="text-xs text-gray-500">Real Estate Booking</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                    
                    <a href="{{ route('calendar') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">
                        <i class="fas fa-calendar mr-2"></i>Calendar
                    </a>
                    
                    <div class="flex items-center gap-4">
                        <div class="text-sm">
                            <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-red-600 transition">
                                <i class="fas fa-sign-out-alt text-xl"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Cancel Content -->
    <div class="flex items-center justify-center min-h-[calc(100vh-64px)]">
        <div class="text-center max-w-md px-4">
            <!-- Cancel Icon -->
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-orange-100 mb-4">
                    <i class="fas fa-exclamation-circle text-6xl text-orange-600"></i>
                </div>
            </div>

            <h1 class="text-4xl font-bold text-gray-900 mb-3">Payment Cancelled</h1>
            <p class="text-xl text-gray-600 mb-2">Your payment was not processed</p>
            <p class="text-gray-500 mb-8">
                Your visit booking is still pending. You can try payment again or choose a different payment method.
            </p>

            <!-- Details Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8 border-l-4 border-orange-600">
                <div class="text-left space-y-3">
                    <div class="flex items-center gap-2 text-orange-700">
                        <i class="fas fa-info-circle text-orange-600"></i>
                        <span>Your booking is still saved</span>
                    </div>
                    <div class="flex items-center gap-2 text-orange-700">
                        <i class="fas fa-clock text-orange-600"></i>
                        <span>Try payment again anytime</span>
                    </div>
                    <div class="flex items-center gap-2 text-orange-700">
                        <i class="fas fa-undo text-orange-600"></i>
                        <span>No changes to your visit</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-3">
                <a href="{{ route('calendar') }}" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold inline-flex items-center justify-center gap-2">
                    <i class="fas fa-calendar"></i>Return to Calendar
                </a>
                <a href="{{ route('dashboard') }}" class="w-full px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition font-semibold inline-flex items-center justify-center gap-2">
                    <i class="fas fa-home"></i>Go to Dashboard
                </a>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-yellow-50 rounded-lg border border-yellow-200 p-5">
                <h3 class="font-semibold text-yellow-900 mb-2">
                    <i class="fas fa-lightbulb mr-2"></i>Payment Tips
                </h3>
                <p class="text-sm text-yellow-800 mb-3">
                    Make sure your card details are correct and you have sufficient funds. Try using a different card if the issue persists.
                </p>
                <a href="#" class="text-yellow-700 hover:text-yellow-900 font-semibold text-sm inline-flex items-center gap-1">
                    <i class="fas fa-headset mr-1"></i>Contact Support
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2026 PropBook. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
