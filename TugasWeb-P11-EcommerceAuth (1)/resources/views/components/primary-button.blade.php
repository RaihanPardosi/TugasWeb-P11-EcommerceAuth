<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-lg bg-amber-800 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:ring-offset-2 disabled:opacity-60 dark:bg-amber-700 dark:hover:bg-amber-600 dark:focus-visible:ring-offset-gray-900']) }}>
    {{ $slot }}
</button>
