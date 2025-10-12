@props([
    'name',
    'label' => null,
    'value' => '',
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="4"
        {{ $attributes->merge(['class' => 'mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50']) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

