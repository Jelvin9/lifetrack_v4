<div class="form-group col-span-2 mb-3">
    <label for="{{ $attributes->get('id') }}" class="form-label text-white">{{ $attributes->get('label') }}</label>

    <!-- File Input -->
    <input type="file" {{ $attributes->merge(['class' => 'form-control bg-gray-700 text-white w-full']) }}>

    <small class="text-gray-400">Choose an image file</small>

    <!-- Image Preview -->
    <div class="mt-4">
        <img id="imagePreview" src="#" alt="Image Preview" class="hidden w-64 h-64 object-cover rounded-lg"/>
    </div>
</div>
