@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-bluegray-700']) }}>
    {{ $value ?? $slot }}
</label>
