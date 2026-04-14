<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - PropBook</title>
    
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gradient-to-b from-green-50 to-green-100 min-h-screen">
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

    <!-- Success Content -->
    <div class="flex items-center justify-center min-h-[calc(100vh-64px)]">
        <div class="text-center max-w-md px-4">
            <!-- Success Icon -->
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-100 mb-4 animate-pulse">
                    <i class="fas fa-check-circle text-6xl text-green-600"></i>
                </div>
            </div>

            <h1 class="text-4xl font-bold text-gray-900 mb-3">Payment Successful!</h1>
            <p class="text-xl text-gray-600 mb-2">Your visit has been confirmed</p>
            <p class="text-gray-500 mb-8">
                Thank you for your payment. Your property visit is now confirmed and you'll receive a confirmation email shortly.
            </p>

            <!-- Details Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8 border-l-4 border-green-600">
                <div class="text-left space-y-3">
                    <div class="flex items-center gap-2 text-green-700">
                        <i class="fas fa-check text-green-600"></i>
                        <span class="font-semibold">Your visit is confirmed</span>
                    </div>
                    <div class="flex items-center gap-2 text-green-700">
                        <i class="fas fa-receipt text-green-600"></i>
                        <span>Confirmation email sent</span>
                    </div>
                    <div class="flex items-center gap-2 text-green-700">
                        <i class="fas fa-calendar text-green-600"></i>
                        <span>Check your calendar for details</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-3">
                <a href="{{ route('calendar') }}" class="w-full px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold inline-flex items-center justify-center gap-2">
                    <i class="fas fa-calendar"></i>View My Visits
                </a>
                <a href="{{ route('dashboard') }}" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold inline-flex items-center justify-center gap-2">
                    <i class="fas fa-chart-bar"></i>Go to Dashboard
                </a>
                <a href="{{ route('properties.index') }}" class="w-full px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition font-semibold">
                    Browse More Properties
                </a>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-blue-50 rounded-lg border border-blue-200 p-5">
                <h3 class="font-semibold text-blue-900 mb-2">
                    <i class="fas fa-info-circle mr-2"></i>What's Next?
                </h3>
                <p class="text-sm text-blue-800">
                    Your visit confirmation has been sent to your email. Please arrive 10 minutes early. If you have any questions, contact our support team.
                </p>
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
