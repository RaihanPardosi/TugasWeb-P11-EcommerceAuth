@props(['variant' => 'primary'])

@php
    $variants = [
        'primary' => 'bg-red-600 text-white hover:bg-red-500 focus-visible:ring-red-500',
        'secondary' => 'border border-zinc-700 bg-zinc-900 text-zinc-100 hover:bg-zinc-800 focus-visible:ring-zinc-500',
        'dark' => 'bg-white/10 text-white ring-1 ring-inset ring-white/25 hover:bg-white/20 focus-visible:ring-white',
    ];
@endphp

<a {{ $attributes->class(['inline-flex items-center justify-center gap-2 rounded-sm px-4 py-2.5 text-sm font-bold uppercase tracking-wide shadow-sm transition focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-950', $variants[$variant] ?? $variants['primary']]) }}>{{ $slot }}</a>
