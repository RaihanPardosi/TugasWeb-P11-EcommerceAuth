@props(['tone' => 'gray'])

@php
    $tones = [
        'gray' => 'bg-zinc-800 text-zinc-300 ring-zinc-600/40',
        'green' => 'bg-emerald-500/10 text-emerald-400 ring-emerald-500/30',
        'amber' => 'bg-amber-400/10 text-amber-300 ring-amber-400/30',
        'red' => 'bg-red-500/10 text-red-400 ring-red-500/30',
        'blue' => 'bg-sky-500/10 text-sky-400 ring-sky-500/30',
    ];
@endphp

<span {{ $attributes->class(['inline-flex items-center whitespace-nowrap rounded-sm px-2 py-0.5 text-xs font-semibold uppercase tracking-wide ring-1 ring-inset', $tones[$tone] ?? $tones['gray']]) }}>{{ $slot }}</span>
