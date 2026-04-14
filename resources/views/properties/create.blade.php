<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Property - PropBook</title>
    
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-[#0a0a0a] text-gray-300">
    <nav class="border-b border-gray-900 sticky top-0 z-40 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <div class="text-2xl font-bold text-yellow-600">
                        <i class="fas fa-building"></i>
                    </div>
                    <div>
                        <a href="{{ route('home') }}" class="text-lg font-bold text-gray-100">PropBook</a>
                        <p class="text-xs text-gray-500">Real Estate Booking</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-yellow-600 transition">
                        <i class="fas fa-list mr-2"></i>Properties
                    </a>
                    
                    <a href="{{ route('calendar') }}" class="text-gray-400 hover:text-yellow-600 transition">
                        <i class="fas fa-calendar mr-2"></i>Calendar
                    </a>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-400">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('properties.index') }}" class="text-yellow-600 hover:text-yellow-500 text-sm mb-4 inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>Back to Properties
                </a>
                <h1 class="text-4xl font-serif font-bold text-gray-100 mt-4">Create Property</h1>
                <p class="text-gray-500 mt-2">Add a new listing to your portfolio</p>
            </div>

            <div class="card rounded p-8">
                <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-yellow-600 mb-2">Property Title</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            placeholder="Luxury Apartment Downtown"
                            class="w-full px-4 py-2.5 rounded transition @error('title') border-red-600 @enderror"
                            value="{{ old('title') }}"
                        >
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-yellow-600 mb-2">Address</label>
                        <input 
                            type="text" 
                            id="address" 
                            name="address" 
                            placeholder="123 Main Street, Downtown"
                            class="w-full px-4 py-2.5 rounded transition @error('address') border-red-600 @enderror"
                            value="{{ old('address') }}"
                        >
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-yellow-600 mb-2">Description</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            placeholder="Describe the property features and amenities..."
                            rows="4"
                            class="w-full px-4 py-2.5 rounded transition resize-none @error('description') border-red-600 @enderror"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price_per_visit" class="block text-sm font-medium text-yellow-600 mb-2">Price Per Visit (MAD)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">MAD</span>
                            <input 
                                type="number" 
                                id="price_per_visit" 
                                name="price_per_visit" 
                                placeholder="0.00"
                                step="0.01"
                                min="0.01"
                                class="w-full pl-12 pr-4 py-2.5 rounded transition @error('price_per_visit') border-red-600 @enderror"
                                value="{{ old('price_per_visit') }}"
                            >
                        </div>
                        @error('price_per_visit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-yellow-600 mb-2">Property Image</label>
                        <input type="file" id="image" name="image" accept="image/*" class="w-full text-sm text-gray-400 rounded" />
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Optional. Upload a cover photo for your listing.</p>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('properties.index') }}" class="flex-1 px-6 py-2.5 bg-gray-800 text-gray-300 rounded hover:bg-gray-700 transition font-medium text-center">
                            Cancel
                        </a>
                        <button type="submit" class="flex-1 px-6 py-2.5 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition font-medium">
                            Create Listing
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-8 card p-6 rounded text-sm text-gray-400">
                <p class="font-medium text-gray-300 mb-3"><i class="fas fa-lightbulb mr-2 text-yellow-600"></i>Listing Tips</p>
                <ul class="space-y-2 text-xs">
                    <li>• Write a clear, compelling title</li>
                    <li>• Provide complete and detailed address</li>
                    <li>• Highlight features and amenities in description</li>
                    <li>• Set competitive pricing based on market</li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="border-t border-gray-900 text-gray-500 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs">
            <p>&copy; 2026 PropBook. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
