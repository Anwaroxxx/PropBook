<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    Welcome back, {{ Auth::user()->name }}! 👋
                </h2>
                <p class="text-sm text-gray-400 mt-1">Here's what's happening with your properties</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('properties.index') }}" class="btn-primary inline-flex items-center gap-2">
                    <i class="fas fa-search text-xs"></i>Browse Properties
                </a>
                <a href="{{ route('calendar') }}" class="px-5 py-2.5 bg-gray-800 text-gray-300 rounded-lg font-medium text-sm border border-gray-700 hover:bg-gray-700 hover:text-gray-200 transition-all inline-flex items-center gap-2">
                    <i class="fas fa-calendar text-xs"></i>Book Visit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="stat-card">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-400 mb-1">Pending Visits</p>
                            <p class="text-4xl font-bold text-yellow-500">
                                {{ Auth::user()->visits()->where('status', 'pending')->count() }}
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-yellow-600/20 flex items-center justify-center">
                            <i class="fas fa-clock text-2xl text-yellow-500"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-800">
                        <p class="text-xs text-gray-500">Awaiting payment confirmation</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-400 mb-1">Confirmed Visits</p>
                            <p class="text-4xl font-bold text-green-500">
                                {{ Auth::user()->visits()->where('status', 'confirmed')->count() }}
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-green-600/20 flex items-center justify-center">
                            <i class="fas fa-check-circle text-2xl text-green-500"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-800">
                        <p class="text-xs text-gray-500">Successfully booked visits</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-400 mb-1">Total Bookings</p>
                            <p class="text-4xl font-bold text-blue-500">
                                {{ Auth::user()->visits()->count() }}
                            </p>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-blue-600/20 flex items-center justify-center">
                            <i class="fas fa-calendar-check text-2xl text-blue-500"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-800">
                        <p class="text-xs text-gray-500">All-time bookings</p>
                    </div>
                </div>
            </div>

            {{-- Recent Bookings Table --}}
            <div class="card mb-8">
                <div class="p-6 border-b border-gray-800">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">
                            <i class="fas fa-list text-yellow-600 mr-2"></i>Recent Bookings
                        </h3>
                        @if(Auth::user()->visits()->exists())
                            <a href="{{ route('calendar') }}" class="text-sm text-yellow-600 hover:text-yellow-500 font-medium">
                                View All <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        @endif
                    </div>
                </div>

                @if(Auth::user()->visits()->exists())
                    <div class="overflow-x-auto">
                        <table class="table-dark">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Date & Time</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Auth::user()->visits()->latest()->take(5)->get() as $visit)
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="font-medium text-white">{{ $visit->property->title }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5">{{ Str::limit($visit->property->address, 30) }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="text-gray-300">{{ $visit->start_time->format('M d, Y') }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5">{{ $visit->start_time->format('H:i') }} - {{ $visit->end_time->format('H:i') }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="font-semibold text-white">MAD {{ number_format($visit->property->price_per_visit, 2) }}</p>
                                        </td>
                                        <td>
                                            @if($visit->status === 'pending')
                                                <span class="badge-pending">
                                                    <i class="fas fa-hourglass-half text-xs"></i>Pending
                                                </span>
                                            @elseif($visit->status === 'confirmed')
                                                <span class="badge-confirmed">
                                                    <i class="fas fa-check text-xs"></i>Confirmed
                                                </span>
                                            @else
                                                <span class="badge-cancelled">
                                                    <i class="fas fa-times text-xs"></i>Cancelled
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('calendar') }}" class="text-yellow-600 hover:text-yellow-500 font-medium text-sm inline-flex items-center gap-1">
                                                View <i class="fas fa-external-link-alt text-xs"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-16 px-4">
                        <div class="w-20 h-20 rounded-full bg-gray-800 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-plus text-4xl text-gray-600"></i>
                        </div>
                        <p class="text-gray-300 font-medium mb-2">No bookings yet</p>
                        <p class="text-gray-500 text-sm mb-6 max-w-md mx-auto">Start exploring properties and book your first visit today!</p>
                        <div class="flex gap-3 justify-center">
                            <a href="{{ route('properties.index') }}" class="btn-primary inline-flex items-center gap-2">
                                <i class="fas fa-search text-xs"></i>Browse Properties
                            </a>
                            <a href="{{ route('calendar') }}" class="btn-secondary inline-flex items-center gap-2">
                                <i class="fas fa-calendar text-xs"></i>View Calendar
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Info Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="card">
                    <div class="p-6">
                        <h4 class="font-bold text-white mb-6 flex items-center gap-2">
                            <i class="fas fa-lightbulb text-yellow-600"></i>How It Works
                        </h4>
                        <ol class="space-y-4">
                            <li class="flex gap-4 items-start">
                                <div class="w-8 h-8 rounded-full bg-yellow-600 flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-sm font-bold">1</span>
                                </div>
                                <div>
                                    <p class="text-gray-300 font-medium">Browse Properties</p>
                                    <p class="text-sm text-gray-500 mt-0.5">Explore available properties and find what you like</p>
                                </div>
                            </li>
                            <li class="flex gap-4 items-start">
                                <div class="w-8 h-8 rounded-full bg-yellow-600 flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-sm font-bold">2</span>
                                </div>
                                <div>
                                    <p class="text-gray-300 font-medium">Select a Date & Time</p>
                                    <p class="text-sm text-gray-500 mt-0.5">Choose your preferred visit time on the calendar</p>
                                </div>
                            </li>
                            <li class="flex gap-4 items-start">
                                <div class="w-8 h-8 rounded-full bg-yellow-600 flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-sm font-bold">3</span>
                                </div>
                                <div>
                                    <p class="text-gray-300 font-medium">Complete Payment</p>
                                    <p class="text-sm text-gray-500 mt-0.5">Secure payment via Stripe to confirm your visit</p>
                                </div>
                            </li>
                            <li class="flex gap-4 items-start">
                                <div class="w-8 h-8 rounded-full bg-yellow-600 flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-sm font-bold">4</span>
                                </div>
                                <div>
                                    <p class="text-gray-300 font-medium">Visit Confirmed</p>
                                    <p class="text-sm text-gray-500 mt-0.5">Get instant confirmation and visit details</p>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="p-6">
                        <h4 class="font-bold text-white mb-6 flex items-center gap-2">
                            <i class="fas fa-headset text-yellow-600"></i>Need Help?
                        </h4>
                        <p class="text-gray-300 mb-6">Our support team is here to help you with any questions about your bookings.</p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-800/50">
                                <div class="w-10 h-10 rounded-lg bg-yellow-600/20 flex items-center justify-center">
                                    <i class="fas fa-envelope text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Email</p>
                                    <p class="text-sm text-gray-300 font-medium">support@propbook.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-800/50">
                                <div class="w-10 h-10 rounded-lg bg-yellow-600/20 flex items-center justify-center">
                                    <i class="fas fa-phone text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Phone</p>
                                    <p class="text-sm text-gray-300 font-medium">+1 (555) 123-4567</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-800/50">
                                <div class="w-10 h-10 rounded-lg bg-yellow-600/20 flex items-center justify-center">
                                    <i class="fas fa-clock text-yellow-500"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Support Hours</p>
                                    <p class="text-sm text-gray-300 font-medium">24/7 Available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
