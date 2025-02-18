<button {{ $attributes->merge(['type' => 'submit', 'class' => 'py-2 px-2.5 inline-flex items-center font-medium text-sm rounded-lg bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-red-500 dark:hover:bg-red-600 dark:focus:bg-red-600']) }}>
    {{ $slot }}
</button>
