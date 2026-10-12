@props(['variant' => 'primary'])

@php
    $variants = [
        'primary' => 'bg-amber-800 text-white hover:bg-amber-700 focus-visible:ring-amber-600 dark:bg-amber-700 dark:hover:bg-amber-600',
        'secondary' => 'border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus-visible:ring-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700',
        'dark' => 'bg-white/10 text-white ring-1 ring-inset ring-white/25 hover:bg-white/20 focus-visible:ring-white',
    ];
@endphp

<a {{ $attributes->class(['inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2.5 text-sm font-semibold shadow-sm transition focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-900', $variants[$variant] ?? $variants['primary']]) }}>{{ $slot }}</a>
