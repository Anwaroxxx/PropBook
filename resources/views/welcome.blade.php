<x-guest-layout>
    <!-- Hero Section -->
    <div class="bg-[url('https://source.unsplash.com/1600x900/?luxury,real-estate,interior')] bg-cover bg-center min-h-[600px] flex items-center">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight text-white">Your Dream Property Awaits</h1>
                <p class="text-lg text-gray-300 mb-8">Discover, schedule, and secure your perfect property viewing. Seamless booking, secure payments, expert support.</p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('properties.index') }}" class="px-6 py-3 bg-yellow-600 text-white rounded font-medium hover:bg-yellow-700 transition inline-flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i>Browse Properties
                    </a>
                    @if(Auth::check())
                        <a href="{{ route('calendar') }}" class="px-6 py-3 border border-yellow-600 text-yellow-600 rounded font-medium hover:bg-yellow-600 hover:text-white transition inline-flex items-center justify-center gap-2">
                            <i class="fas fa-calendar"></i>Calendar
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-6 py-3 border border-yellow-600 text-yellow-600 rounded font-medium hover:bg-yellow-600 hover:text-white transition inline-flex items-center justify-center gap-2">
                            Start Now
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-900 border border-gray-800 p-8 rounded">
                    <div class="text-4xl text-yellow-600 mb-4"><i class="fas fa-calendar-check"></i></div>
                    <h3 class="text-lg font-bold text-gray-100 mb-3">Easy Booking</h3>
                    <p class="text-gray-400 text-sm">Schedule visits at your convenience with seamless booking</p>
                </div>
                <div class="bg-gray-900 border border-gray-800 p-8 rounded">
                    <div class="text-4xl text-yellow-600 mb-4"><i class="fas fa-lock"></i></div>
                    <h3 class="text-lg font-bold text-gray-100 mb-3">Secure Payments</h3>
                    <p class="text-gray-400 text-sm">Safe transactions processed through trusted payment gateway</p>
                </div>
                <div class="bg-gray-900 border border-gray-800 p-8 rounded">
                    <div class="text-4xl text-yellow-600 mb-4"><i class="fas fa-headset"></i></div>
                    <h3 class="text-lg font-bold text-gray-100 mb-3">24/7 Support</h3>
                    <p class="text-gray-400 text-sm">Expert assistance available around the clock</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black border-t border-gray-900 text-gray-500 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
            <p>&copy; 2026 PropBook. All rights reserved.</p>
        </div>
    </footer>
</x-guest-layout>
