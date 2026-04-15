<x-guest-layout>
    {{-- Hero Section --}}
    <div class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-[600px] flex items-center overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(251,191,36,0.3) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-600/20 border border-yellow-600/30 mb-6">
                        <i class="fas fa-star text-yellow-500 text-sm"></i>
                        <span class="text-yellow-500 text-sm font-medium">Trusted by thousands of users</span>
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight text-white">
                        Your Dream Property <span class="text-yellow-500">Awaits</span>
                    </h1>
                    
                    <p class="text-lg text-gray-300 mb-8 leading-relaxed">
                        Discover, schedule, and secure your perfect property viewing. Experience seamless booking, secure payments, and expert support all in one platform.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('properties.index') }}" class="btn-primary px-8 py-4 text-base inline-flex items-center justify-center gap-3">
                            <i class="fas fa-search"></i>Browse Properties
                        </a>
                        @if(Auth::check())
                            <a href="{{ route('calendar') }}" class="px-8 py-4 border-2 border-yellow-600 text-yellow-500 rounded-lg font-medium hover:bg-yellow-600 hover:text-white transition-all inline-flex items-center justify-center gap-3">
                                <i class="fas fa-calendar"></i>My Calendar
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-8 py-4 border-2 border-yellow-600 text-yellow-500 rounded-lg font-medium hover:bg-yellow-600 hover:text-white transition-all inline-flex items-center justify-center gap-3">
                                <i class="fas fa-rocket"></i>Get Started
                            </a>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-8 mt-10">
                        <div>
                            <p class="text-3xl font-bold text-white">500+</p>
                            <p class="text-sm text-gray-400">Properties Listed</p>
                        </div>
                        <div class="w-px h-12 bg-gray-700"></div>
                        <div>
                            <p class="text-3xl font-bold text-white">2000+</p>
                            <p class="text-sm text-gray-400">Visits Booked</p>
                        </div>
                        <div class="w-px h-12 bg-gray-700"></div>
                        <div>
                            <p class="text-3xl font-bold text-white">99%</p>
                            <p class="text-sm text-gray-400">Satisfaction Rate</p>
                        </div>
                    </div>
                </div>
                
                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="w-full h-[500px] rounded-2xl bg-gradient-to-br from-yellow-600/20 to-yellow-700/20 border border-yellow-600/30 flex items-center justify-center">
                            <i class="fas fa-building text-9xl text-yellow-600/40"></i>
                        </div>
                        <div class="absolute -bottom-6 -left-6 card p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-green-600/20 flex items-center justify-center">
                                    <i class="fas fa-check text-green-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">Visit Confirmed</p>
                                    <p class="text-xs text-gray-400">Property #1234</p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -top-6 -right-6 card p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-yellow-600/20 flex items-center justify-center">
                                    <i class="fas fa-calendar-check text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">New Booking</p>
                                    <p class="text-xs text-gray-400">Just now</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="py-20 bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Why Choose PropBook?</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">We make property viewing simple, secure, and convenient for everyone</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card p-8 card-hover">
                    <div class="w-16 h-16 rounded-xl bg-yellow-600/20 flex items-center justify-center mb-6">
                        <i class="fas fa-calendar-check text-3xl text-yellow-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Easy Booking</h3>
                    <p class="text-gray-400 leading-relaxed">Schedule visits at your convenience with our intuitive booking system. Pick your preferred time and get instant confirmation.</p>
                </div>
                
                <div class="card p-8 card-hover">
                    <div class="w-16 h-16 rounded-xl bg-green-600/20 flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-3xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Secure Payments</h3>
                    <p class="text-gray-400 leading-relaxed">Safe transactions processed through Stripe, the industry-leading payment gateway. Your money is always protected.</p>
                </div>
                
                <div class="card p-8 card-hover">
                    <div class="w-16 h-16 rounded-xl bg-blue-600/20 flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-3xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">24/7 Support</h3>
                    <p class="text-gray-400 leading-relaxed">Expert assistance available around the clock. Our dedicated team is always ready to help you with any questions.</p>
                </div>
                
                <div class="card p-8 card-hover">
                    <div class="w-16 h-16 rounded-xl bg-purple-600/20 flex items-center justify-center mb-6">
                        <i class="fas fa-map-marker-alt text-3xl text-purple-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Prime Locations</h3>
                    <p class="text-gray-400 leading-relaxed">Access properties in the most sought-after locations. From downtown apartments to suburban homes.</p>
                </div>
                
                <div class="card p-8 card-hover">
                    <div class="w-16 h-16 rounded-xl bg-red-600/20 flex items-center justify-center mb-6">
                        <i class="fas fa-bolt text-3xl text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Instant Confirmation</h3>
                    <p class="text-gray-400 leading-relaxed">Get immediate booking confirmation once payment is complete. No waiting, no hassle.</p>
                </div>
                
                <div class="card p-8 card-hover">
                    <div class="w-16 h-16 rounded-xl bg-indigo-600/20 flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-3xl text-indigo-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Track Everything</h3>
                    <p class="text-gray-400 leading-relaxed">Monitor all your visits and bookings in one place. Calendar integration keeps you organized.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="py-20 bg-gradient-to-r from-yellow-600 to-yellow-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Find Your Perfect Property?</h2>
            <p class="text-xl text-white/90 mb-8">Join thousands of satisfied users who have simplified their property search</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if(Auth::check())
                    <a href="{{ route('properties.index') }}" class="px-8 py-4 bg-white text-yellow-600 rounded-lg font-semibold hover:bg-gray-100 transition-all inline-flex items-center justify-center gap-3">
                        <i class="fas fa-search"></i>Browse Properties
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-yellow-600 rounded-lg font-semibold hover:bg-gray-100 transition-all inline-flex items-center justify-center gap-3">
                        <i class="fas fa-rocket"></i>Get Started Free
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-gray-900 border-t border-gray-800 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-yellow-600 flex items-center justify-center">
                            <i class="fas fa-building text-white"></i>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-white">PropBook</p>
                            <p class="text-xs text-gray-500">Real Estate Booking</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed">The easiest way to schedule property viewings and manage your real estate search.</p>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('properties.index') }}" class="hover:text-yellow-500 transition">Properties</a></li>
                        @if(Auth::check())
                            <li><a href="{{ route('calendar') }}" class="hover:text-yellow-500 transition">Calendar</a></li>
                            <li><a href="{{ route('dashboard') }}" class="hover:text-yellow-500 transition">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-yellow-500 transition">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-yellow-500 transition">Register</a></li>
                        @endauth
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm">
                        <li><i class="fas fa-envelope mr-2 text-yellow-600"></i>support@propbook.com</li>
                        <li><i class="fas fa-phone mr-2 text-yellow-600"></i>+1 (555) 123-4567</li>
                        <li><i class="fas fa-clock mr-2 text-yellow-600"></i>24/7 Support Available</li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-800 text-center text-sm">
                <p>&copy; 2026 PropBook. All rights reserved. | Made with <i class="fas fa-heart text-red-500"></i> for property seekers</p>
            </div>
        </div>
    </footer>
</x-guest-layout>
