@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge(['class' => 'mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50']) }}
    >
        <option value="">Seleccione...</option>
        @foreach($options as $option)
            <option value="{{ $option }}" {{ old($name, $selected) == $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

