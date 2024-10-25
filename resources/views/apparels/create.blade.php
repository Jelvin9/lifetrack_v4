@extends('layouts.layout')

@section('header')
<x-header>
</x-header>
@endsection

       
    
@section('content')
<div class="content-wrapper flex justify-center items-center min-h-screen bg-gray-900">
    <div class="bg-gray-800 rounded-lg p-8 w-full md:w-2/3 lg:w-1/2 shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-white text-center">Edit Apparel</h2>

        @if (session('success'))
            <p class="bg-green-500 text-white p-2 rounded mb-4">{{ session('success') }}</p>
        @endif

        <!-- Form -->
        <form method="post" action="{{ route('apparels.store') }}" id="insertFormApparel" enctype="multipart/form-data">
            @csrf


                    <!-- Radio Buttons for Category -->
        <div class="mb-6 text-center">
            <div class="flex justify-center space-x-4">
                @foreach ($apparelCategories as $category)
                    <input type="radio" id="category_{{ $category->id }}" name="apparel_category_id" value="{{ $category->id }}" class="hidden peer/category_{{ $category->id }}">
                    <label for="category_{{ $category->id }}" class="px-4 py-2 bg-gray-700 text-white border-4 rounded-full cursor-pointer peer-checked/category_{{ $category->id }}:border-indigo-700">{{ $category->name }}</label>
                @endforeach
            </div>
        </div>


            <!-- Rest of the Inputs Side by Side -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="form-group">
                    <label for="apparel_type_id" class="form-label text-white">Type</label>
                    <select class="form-select bg-gray-700 text-white w-full" name="apparel_type_id" id="apparel_type_id" required>
                        <option selected disabled>Loading types...</option>
                        @foreach ($apparelTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="apparel_style_id" class="form-label text-white">Style</label>
                    <select class="form-select bg-gray-700 text-white w-full" name="apparel_style_id" id="apparel_style_id" required>
                        <option selected disabled>Loading styles...</option>
                        @foreach ($apparelStyles as $style)
                            <option value="{{ $style->id }}">{{ $style->name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-form-input 
                type="text" 
                label="Title" 
                name="title" 
                id="title" 
                {{-- value="{{ old('title') ?? $apparel->title ?? '' }}" --}}
                required
                />

                <x-form-input 
                type="text" 
                label="Color" 
                name="color" 
                id="color" 
                required
                />

                <x-form-input 
                type="number" 
                label="Price (RM)" 
                name="price" 
                id="price" 
                step="0.01"
                />

                <x-form-input 
                type="date" 
                label="Date" 
                name="date" 
                id="date" 
                required
                />

                <x-form-input 
                type="number" 
                label="Quantity" 
                name="quantity" 
                id="quantity"
                />

                <x-form-input 
                type="text" 
                label="Remarks" 
                name="remarks" 
                id="remarks"
                />

                <!-- File Upload with Image Preview -->
                <x-file-input 
                label="Upload Image" 
                name="attachment" 
                id="attachment" 
                accept="image/*"
                
                />

            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 mt-4">
                <button type="submit" class="btn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                <a href="{{ route('apparels.index') }}"><button type="button" class="btn bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" data-bs-dismiss="offcanvas">Cancel</button></a>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript to handle image preview
 document.getElementById('attachment').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden'); // Show the preview
        };

        reader.readAsDataURL(file); // Read the file as a data URL
    } else {
        preview.src = "#"; // Clear preview if no image is selected
        preview.classList.add('hidden'); // Hide the preview if not an image
    }
});
</script>
@endsection
