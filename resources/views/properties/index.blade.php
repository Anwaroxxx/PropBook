<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-200">Browse Properties</h2>
            @auth
                <a href="{{ route('properties.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm font-medium">
                    + New Listing
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($properties as $property)
                        <div class="bg-gray-900 rounded border border-gray-800 overflow-hidden hover:border-gray-700 transition">
                            <div class="h-40 overflow-hidden bg-gray-800">
                                @if(!empty($property->image))
                                    <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                                        <span class="text-gray-500 text-4xl">🏠</span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-5">
                                <h3 class="text-lg font-bold text-white mb-2">{{ $property->title }}</h3>
                                <p class="text-gray-400 text-sm mb-3 line-clamp-2">{{ $property->description ?? 'No description' }}</p>
                                <p class="text-gray-500 text-xs mb-4">{{ $property->address }}</p>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-800">
                                    <div>
                                        <p class="text-gray-400 text-xs mb-1">Per Visit</p>
                                        <p class="text-white font-bold">MAD {{ number_format($property->price_per_visit, 2) }}</p>
                                    </div>
                                    <a href="{{ route('properties.show', $property) }}" class="px-4 py-2 bg-blue-600 text-white rounded text-xs font-medium hover:bg-blue-700 transition">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-gray-900 rounded border border-gray-800 p-8">
                    <p class="text-gray-400 mb-4">No properties available yet</p>
                    @auth
                        <a href="{{ route('properties.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm font-medium">
                            Create First Property
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
