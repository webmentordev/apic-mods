@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-dark-light bg-dark-light text-white/80 focus:border-main focus:ring-main/10 rounded-md shadow-sm']) !!}>
    {{ $slot }}
</select>