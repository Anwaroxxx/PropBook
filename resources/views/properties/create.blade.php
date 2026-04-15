<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-white">Create Property</h2>
                <p class="text-sm text-gray-400 mt-1">Add a new listing to your portfolio</p>
            </div>
            <a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-yellow-600 transition text-sm inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>Back to Properties
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data" class="card p-8">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-heading text-yellow-600 mr-2"></i>Property Title <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Luxury Apartment Downtown"
                            class="w-full @error('title') border-red-600 @enderror"
                            value="{{ old('title') }}"
                            required
                        >
                        @error('title')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-map-marker-alt text-yellow-600 mr-2"></i>Address <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            placeholder="123 Main Street, Downtown"
                            class="w-full @error('address') border-red-600 @enderror"
                            value="{{ old('address') }}"
                            required
                        >
                        @error('address')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-align-left text-yellow-600 mr-2"></i>Description
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            placeholder="Describe the property features and amenities..."
                            rows="5"
                            class="w-full resize-none @error('description') border-red-600 @enderror"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>{{ $message }}
                            </p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2">Provide detailed information about the property to attract more visitors</p>
                    </div>

                    <div>
                        <label for="price_per_visit" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-tag text-yellow-600 mr-2"></i>Price Per Visit (MAD) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm font-medium">MAD</span>
                            </div>
                            <input
                                type="number"
                                id="price_per_visit"
                                name="price_per_visit"
                                placeholder="0.00"
                                step="0.01"
                                min="0.01"
                                class="w-full pl-16 @error('price_per_visit') border-red-600 @enderror"
                                value="{{ old('price_per_visit') }}"
                                required
                            >
                        </div>
                        @error('price_per_visit')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-image text-yellow-600 mr-2"></i>Property Image
                        </label>
                        <div class="mt-2">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-700 border-dashed rounded-lg cursor-pointer bg-gray-800/50 hover:bg-gray-800 transition">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-500 mb-2"></i>
                                    <p class="text-sm text-gray-400">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, WEBP (MAX. 5MB)</p>
                                </div>
                                <input type="file" id="image" name="image" accept="image/*" class="hidden" />
                            </label>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>{{ $message }}
                            </p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2">Upload a cover photo for your listing</p>
                        <div id="imagePreview" class="mt-3 hidden">
                            <img id="preview" class="max-h-48 rounded-lg border border-gray-700" alt="Preview">
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 pt-6 mt-6 border-t border-gray-800">
                    <a href="{{ route('properties.index') }}" class="flex-1 btn-secondary text-center">
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 btn-primary">
                        <i class="fas fa-plus mr-2"></i>Create Listing
                    </button>
                </div>
            </form>

            {{-- Tips Card --}}
            <div class="card mt-6 p-6">
                <h3 class="font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-yellow-600"></i>Listing Tips
                </h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Write a clear, compelling title that highlights key features</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Provide complete and accurate address information</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Highlight unique features and amenities in the description</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Set competitive pricing based on market research</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Upload high-quality photos to attract more visitors</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Image preview
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const preview = document.getElementById('preview');

        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
