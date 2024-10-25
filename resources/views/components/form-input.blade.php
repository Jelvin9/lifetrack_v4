<div class="form-group col-span-2">
    @if ($attributes->has('label'))
        <label for="{{ $attributes->get('id') }}" class="form-label text-white">{{ $attributes->get('label') }}</label>
    @endif

    <input 
        {{ $attributes->merge(['class' => 'form-control bg-gray-700 text-gray-100 w-full custom-input']) }}
    >
</div>
