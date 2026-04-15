<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-bold text-2xl text-white">{{ $property->title }}</h2>
            <a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-yellow-600 transition text-sm inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>Back to Properties
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                {{-- Property Image --}}
                <div class="h-96 bg-gray-800 overflow-hidden relative">
                    @if(!empty($property->image))
                        <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                            <i class="fas fa-home text-8xl text-gray-600"></i>
                        </div>
                    @endif
                </div>

                <div class="p-8">
                    {{-- Header Info --}}
                    <div class="mb-8">
                        <div class="flex items-start gap-2 mb-3">
                            <i class="fas fa-map-marker-alt text-yellow-600 text-sm mt-0.5"></i>
                            <p class="text-gray-400">{{ $property->address }}</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-4 border-t border-gray-800">
                            <div>
                                <p class="text-gray-500 text-sm mb-1">Price Per Visit</p>
                                <p class="text-3xl font-bold text-yellow-500">MAD {{ number_format($property->price_per_visit, 2) }}</p>
                            </div>

                            @auth
                                <button id="scheduleBtn" class="btn-primary px-8 py-3 text-base inline-flex items-center gap-2">
                                    <i class="fas fa-calendar-plus"></i>Schedule Visit
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn-primary px-8 py-3 text-base inline-flex items-center gap-2">
                                    <i class="fas fa-sign-in-alt"></i>Login to Schedule
                                </a>
                            @endauth
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-8 pt-6 border-t border-gray-800">
                        <h3 class="font-bold text-lg text-white mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle text-yellow-600"></i>About This Property
                        </h3>
                        <div class="prose prose-invert max-w-none">
                            <p class="text-gray-300 leading-relaxed">{{ $property->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>

                    {{-- Scheduled Visits --}}
                    @auth
                        @if(!$property->visits->isEmpty())
                            <div class="pt-6 border-t border-gray-800">
                                <h3 class="font-bold text-lg text-white mb-6 flex items-center gap-2">
                                    <i class="fas fa-calendar-check text-yellow-600"></i>Scheduled Visits
                                </h3>
                                <div class="space-y-3">
                                    @foreach($property->visits as $visit)
                                        <div class="p-4 bg-gray-800/50 border border-gray-700 rounded-lg hover:border-gray-600 transition">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-start gap-3">
                                                    <div class="w-10 h-10 rounded-full bg-yellow-600/20 flex items-center justify-center flex-shrink-0">
                                                        <i class="fas fa-user text-yellow-500"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-200 font-medium">{{ optional($visit->user)->name ?? 'Guest' }}</p>
                                                        <p class="text-gray-500 text-sm flex items-center gap-1 mt-1">
                                                            <i class="fas fa-clock text-xs"></i>
                                                            {{ $visit->start_time ? $visit->start_time->format('d M Y, H:i') : 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
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
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Schedule Modal --}}
    <div id="scheduleModal" class="modal-backdrop hidden">
        <div class="modal-content">
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fas fa-calendar-plus text-yellow-600"></i>Schedule a Visit
                </h4>
                <button id="scheduleClose" class="text-gray-500 hover:text-gray-300 text-xl transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="scheduleForm" class="space-y-5">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Start Date & Time <span class="text-red-500">*</span></label>
                    <input name="start_time" type="datetime-local" required class="w-full">
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">End Date & Time</label>
                    <input name="end_time" type="datetime-local" class="w-full">
                    <p class="text-xs text-gray-500 mt-1">Leave empty for 1-hour visit by default</p>
                </div>

                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Additional Notes</label>
                    <textarea name="notes" rows="3" class="w-full" placeholder="Any special requests or questions..."></textarea>
                </div>

                <div class="flex gap-3 justify-end pt-4 border-t border-gray-800">
                    <button type="button" id="scheduleCancel" class="btn-secondary">
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary">
                        <span class="btn-text">Send Request</span>
                        <span class="btn-loading hidden">
                            <span class="loading-spinner mr-2"></span>Sending...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
