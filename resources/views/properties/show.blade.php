<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-200">{{ $property->title }}</h2>
            <a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-yellow-600 transition text-sm inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>Back to Properties
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 rounded border border-gray-800 overflow-hidden">
            <div class="h-80 bg-gray-800 overflow-hidden">
                @if(!empty($property->image))
                    <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                @else
                    <img src="https://source.unsplash.com/1200x600/?luxury,real-estate,interior" alt="placeholder" class="w-full h-full object-cover">
                @endif
            </div>

            <div class="p-8">
                <div class="mb-8">
                    <p class="text-gray-500 text-sm mb-2">{{ $property->address }}</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs mb-1">Price Per Visit</p>
                            <p class="text-2xl font-bold text-yellow-600">MAD {{ number_format($property->price_per_visit, 2) }}</p>
                        </div>

                        @auth
                            <button id="scheduleBtn" class="px-6 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition text-sm font-medium">Schedule Visit</button>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition text-sm font-medium">Login to Schedule</a>
                        @endauth
                    </div>
                </div>

                <div class="mb-6 pt-6 border-t border-gray-800">
                    <h3 class="font-bold text-gray-100 mb-2">About This Property</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">{{ $property->description ?? 'No description provided.' }}</p>
                </div>

                @if(!$property->visits->isEmpty())
                    <div class="pt-6 border-t border-gray-800">
                        <h3 class="font-bold text-gray-100 mb-3">Scheduled Visits</h3>
                        <div class="space-y-2">
                            @foreach($property->visits as $visit)
                                <div class="p-3 bg-gray-800 border border-gray-700 rounded text-sm">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-gray-200">{{ optional($visit->user)->name ?? 'Guest' }}</p>
                                            <p class="text-gray-500 text-xs">{{ $visit->start_time ? $visit->start_time->format('d M Y, H:i') : 'N/A' }}</p>
                                        </div>
                                        <span class="text-xs px-2 py-1 rounded bg-gray-700 text-gray-300">{{ ucfirst($visit->status) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            </div>

            <!-- Schedule Modal -->
            <div id="scheduleModal" class="fixed inset-0 bg-black/70 flex items-center justify-center hidden z-50">
        <div class="bg-gray-900 rounded w-full max-w-lg p-8 border border-gray-800">
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-lg font-serif font-bold text-gray-100">Schedule a Visit</h4>
                <button id="scheduleClose" class="text-gray-500 hover:text-gray-300 text-xl">✕</button>
            </div>

            <form id="scheduleForm" class="space-y-5">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">

                <div>
                    <label class="block text-yellow-600 text-sm font-medium mb-2">Start Date & Time</label>
                    <input name="start_time" type="datetime-local" required class="w-full px-4 py-2.5 rounded">
                </div>

                <div>
                    <label class="block text-yellow-600 text-sm font-medium mb-2">End Date & Time</label>
                    <input name="end_time" type="datetime-local" class="w-full px-4 py-2.5 rounded">
                </div>

                <div>
                    <label class="block text-yellow-600 text-sm font-medium mb-2">Additional Notes</label>
                    <textarea name="notes" rows="3" class="w-full px-4 py-2.5 rounded"></textarea>
                </div>

                <div class="flex gap-3 justify-end pt-4">
                    <button type="button" id="scheduleCancel" class="px-5 py-2 border border-gray-700 text-gray-400 rounded hover:bg-gray-800 transition font-medium text-sm">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition font-medium text-sm">
                        Send Request
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
</x-app-layout>
