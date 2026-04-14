<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-200 leading-tight">
                Welcome back, {{ Auth::user()->name }}! 👋
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('properties.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    <i class="fas fa-search mr-2"></i>Browse Properties
                </a>
                <a href="{{ route('calendar') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                    <i class="fas fa-calendar mr-2"></i>Book Visit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-2">Pending Visits</p>
                            <p class="text-3xl font-bold text-yellow-500">
                                {{ Auth::user()->visits()->where('status', 'pending')->count() }}
                            </p>
                        </div>
                        <div class="text-4xl text-yellow-600">
                            ⏳
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Awaiting payment confirmation</p>
                </div>

                <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-2">Confirmed Visits</p>
                            <p class="text-3xl font-bold text-green-500">
                                {{ Auth::user()->visits()->where('status', 'confirmed')->count() }}
                            </p>
                        </div>
                        <div class="text-4xl text-green-600">
                            ✓
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Successfully booked visits</p>
                </div>

                <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-2">Total Bookings</p>
                            <p class="text-3xl font-bold text-blue-500">
                                {{ Auth::user()->visits()->count() }}
                            </p>
                        </div>
                        <div class="text-4xl text-blue-600">
                            📋
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">All-time bookings</p>
                </div>
            </div>

            <div class="bg-gray-900 rounded-lg border border-gray-800 p-6 mb-8">
                <h3 class="text-xl font-bold text-white mb-4">
                    Recent Bookings
                </h3>

                @if(Auth::user()->visits()->exists())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-800">
                                    <th class="text-left py-3 px-4 font-semibold text-gray-300">Property</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-300">Date & Time</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-300">Price</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-300">Status</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-300">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Auth::user()->visits()->latest()->take(5)->get() as $visit)
                                    <tr class="border-b border-gray-800 hover:bg-gray-800">
                                        <td class="py-3 px-4">
                                            <p class="font-medium text-white">{{ $visit->property->title }}</p>
                                            <p class="text-xs text-gray-500">{{ $visit->property->address }}</p>
                                        </td>
                                        <td class="py-3 px-4 text-gray-300">
                                            {{ $visit->start_time->format('M d, Y') }}<br/>
                                            <span class="text-xs text-gray-500">{{ $visit->start_time->format('H:i') }} - {{ $visit->end_time->format('H:i') }}</span>
                                        </td>
                                        <td class="py-3 px-4 font-semibold text-white">
                                            MAD {{ number_format($visit->property->price_per_visit, 2) }}
                                        </td>
                                        <td class="py-3 px-4">
                                            @if($visit->status === 'pending')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-hourglass-half mr-1"></i>Pending
                                                </span>
                                            @elseif($visit->status === 'confirmed')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-check-circle mr-1"></i>Confirmed
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-times-circle mr-1"></i>Cancelled
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <a href="{{ route('calendar') }}" class="text-blue-400 hover:text-blue-300 font-medium text-xs">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-5xl text-gray-600 mb-4">📭</div>
                        <p class="text-gray-300 font-medium mb-4">No bookings yet</p>
                        <p class="text-gray-500 text-sm mb-6">Start exploring properties and book your first visit today!</p>
                        <div class="flex gap-3 justify-center">
                            <a href="{{ route('properties.index') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                                Browse Properties
                            </a>
                            <a href="{{ route('calendar') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition font-medium">
                                View Calendar
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                    <h4 class="font-bold text-white mb-4">How It Works</h4>
                    <ol class="space-y-3 text-sm text-gray-300">
                        <li class="flex gap-3">
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex-shrink-0">1</span>
                            <span>Browse available properties</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex-shrink-0">2</span>
                            <span>Select a date & time on the calendar</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex-shrink-0">3</span>
                            <span>Complete secure payment via Stripe</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-bold flex-shrink-0">4</span>
                            <span>Visit gets confirmed automatically</span>
                        </li>
                    </ol>
                </div>

                <div class="bg-gray-900 rounded-lg border border-gray-800 p-6">
                    <h4 class="font-bold text-white mb-4">Need Help?</h4>
                    <p class="text-sm text-gray-300 mb-4">
                        Our support team is here to help you with any questions or concerns about your bookings.
                    </p>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-400">
                            <strong>Email:</strong> support@propbook.com
                        </p>
                        <p class="text-sm text-gray-400">
                            <strong>Phone:</strong> +1 (555) 123-4567
                        </p>
                        <p class="text-sm text-gray-400">
                            <strong>Hours:</strong> 24/7 Support
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
