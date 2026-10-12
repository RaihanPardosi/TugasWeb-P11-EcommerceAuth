@props(['product'])

@php
    $theme = match ($product->category?->slug) {
        'biji-kopi' => 'text-red-500',
        'alat-seduh' => 'text-orange-400',
        'grinder' => 'text-zinc-300',
        'gelas-cangkir' => 'text-sky-400',
        'aksesori' => 'text-amber-300',
        'teh-minuman' => 'text-emerald-400',
        default => 'text-zinc-400',
    };
@endphp

<div {{ $attributes->class(['rc-tile flex items-center justify-center bg-zinc-800', $theme]) }}>
    <x-icon :name="$product->category?->icon() ?? 'cube'" class="h-12 w-12 opacity-90" />
</div>
