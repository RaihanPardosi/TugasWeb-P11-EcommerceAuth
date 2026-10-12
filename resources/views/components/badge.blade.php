@props(['tone' => 'gray'])

@php
    $tones = [
        'gray' => 'bg-gray-100 text-gray-700 ring-gray-500/20 dark:bg-gray-700/40 dark:text-gray-300 dark:ring-gray-400/20',
        'green' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20 dark:bg-emerald-500/10 dark:text-emerald-400 dark:ring-emerald-500/20',
        'amber' => 'bg-amber-50 text-amber-800 ring-amber-600/20 dark:bg-amber-500/10 dark:text-amber-400 dark:ring-amber-500/20',
        'red' => 'bg-red-50 text-red-700 ring-red-600/20 dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20',
        'blue' => 'bg-blue-50 text-blue-700 ring-blue-600/20 dark:bg-blue-500/10 dark:text-blue-400 dark:ring-blue-500/20',
    ];
@endphp

<span {{ $attributes->class(['inline-flex items-center whitespace-nowrap rounded-md px-2 py-0.5 text-xs font-medium ring-1 ring-inset', $tones[$tone] ?? $tones['gray']]) }}>{{ $slot }}</span>
