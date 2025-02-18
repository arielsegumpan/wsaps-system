@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 text-sm text-gray-800 bg-gray-100 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700'
            : 'flex items-center p-2 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

