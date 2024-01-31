@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm mb-2 text-gray-100']) }}>
    {{ $value ?? $slot }}
</label>
