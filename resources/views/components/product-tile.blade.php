@props(['product'])

@php
    $theme = match ($product->category?->slug) {
        'biji-kopi' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-500',
        'alat-seduh' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-500',
        'grinder' => 'bg-stone-200 text-stone-700 dark:bg-stone-700/40 dark:text-stone-300',
        'gelas-cangkir' => 'bg-sky-100 text-sky-800 dark:bg-sky-900/30 dark:text-sky-400',
        'aksesori' => 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400',
        'teh-minuman' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400',
        default => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300',
    };
@endphp

<div {{ $attributes->class(['flex items-center justify-center', $theme]) }}>
    <x-icon :name="$product->category?->icon() ?? 'cube'" class="h-12 w-12 opacity-80" />
</div>
