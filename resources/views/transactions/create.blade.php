@extends('layouts.layout')

@section('header')
<x-header>
</x-header>
@endsection

       
    
@section('content')
<div class="content-wrapper flex justify-center items-center min-h-screen bg-gray-900">
    <div class="bg-gray-800 rounded-lg p-8 w-full md:w-2/3 lg:w-1/2 shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-white text-center">Add Transaction</h2>

        @if (session('success'))
            <p class="bg-green-500 text-white p-2 rounded mb-4">{{ session('success') }}</p>
        @endif

        <!-- Form -->
        <form method="post" action="{{ route('transactions.store') }}" id="insertFormApparel" enctype="multipart/form-data">
            @csrf

                    <!-- Radio Buttons for Category -->
                    <div class="mb-6 text-center">
                        <div class="flex justify-center space-x-4">
                            <input type="radio" id="Expense" name="type" value="Expense" class="hidden">
                            <label for="Expense" class="px-4 py-2 bg-gray-700 text-white border-4 rounded-full cursor-pointer border-transparent hover:border-indigo-700">
                                Expense
                            </label>
                            <input type="radio" id="Income" name="type" value="Income" class="hidden">
                            <label for="Income" class="px-4 py-2 bg-gray-700 text-white border-4 rounded-full cursor-pointer border-transparent hover:border-indigo-700">
                                Income
                            </label>
                        </div>
                    </div>


            <!-- Rest of the Inputs Side by Side -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="form-group">
                    <label for="transaction_category_id" class="form-label text-white">Category</label>
                    <select class="form-select bg-gray-700 text-white w-full" name="transaction_category_id" id="transaction_category_id" required>
                        <option selected disabled>Loading categories...</option>
                        @foreach ($transactionCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-form-input 
                type="text" 
                label="Title" 
                name="title" 
                id="title" 
                required
                />


                <x-form-input 
                type="number" 
                label="Amount (RM)" 
                name="amount" 
                id="amount" 
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
                <a href="{{ route('transactions.index') }}"><button type="button" class="btn bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" data-bs-dismiss="offcanvas">Cancel</button></a>
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
