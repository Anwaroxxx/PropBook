<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-white">Browse Properties</h2>
                <p class="text-sm text-gray-400 mt-1">Find your perfect property and schedule a visit</p>
            </div>
            @auth
                <a href="{{ route('properties.create') }}" class="btn-primary inline-flex items-center gap-2">
                    <i class="fas fa-plus text-xs"></i>New Listing
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($properties as $property)
                        <div class="card card-hover">
                            <div class="h-48 overflow-hidden bg-gray-800 relative group">
                                @if(!empty($property->image))
                                    <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                                        <i class="fas fa-home text-5xl text-gray-600"></i>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <div class="bg-black/70 backdrop-blur-sm px-3 py-1.5 rounded-lg">
                                        <p class="text-white font-bold text-sm">MAD {{ number_format($property->price_per_visit, 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="text-lg font-bold text-white mb-2 line-clamp-1">{{ $property->title }}</h3>
                                
                                <div class="flex items-start gap-2 mb-3">
                                    <i class="fas fa-map-marker-alt text-yellow-600 text-sm mt-0.5 flex-shrink-0"></i>
                                    <p class="text-gray-400 text-sm line-clamp-2">{{ Str::limit($property->address, 50) }}</p>
                                </div>

                                @if($property->description)
                                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ Str::limit($property->description, 100) }}</p>
                                @endif

                                <div class="flex items-center justify-between pt-4 border-t border-gray-800">
                                    <div class="flex items-center gap-2 text-sm text-gray-500">
                                        <i class="fas fa-calendar text-xs"></i>
                                        <span>{{ $property->visits->count() }} visits</span>
                                    </div>
                                    <a href="{{ route('properties.show', $property) }}" class="btn-primary inline-flex items-center gap-2">
                                        View Details <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if(method_exists($properties, 'links'))
                    <div class="mt-8 flex justify-center">
                        {{ $properties->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16 card">
                    <div class="p-8">
                        <div class="w-24 h-24 rounded-full bg-gray-800 flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-building text-5xl text-gray-600"></i>
                        </div>
                        <p class="text-gray-300 font-medium text-lg mb-2">No properties available yet</p>
                        <p class="text-gray-500 text-sm mb-6 max-w-md mx-auto">Be the first to list your property and start booking visits today!</p>
                        @auth
                            <a href="{{ route('properties.create') }}" class="btn-primary inline-flex items-center gap-2">
                                <i class="fas fa-plus text-xs"></i>Create First Property
                            </a>
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
