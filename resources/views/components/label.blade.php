@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-gray-700 font-medium mb-1']) }}>
    {{ $value ?? $slot }}
</label>
