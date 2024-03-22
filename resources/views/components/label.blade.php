@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-lg text-gray-900']) }}>
    {{ $value ?? $slot }}
</label>
