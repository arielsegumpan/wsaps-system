@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-2 text-sm dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
