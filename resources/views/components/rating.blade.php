@props(['value' => 0])

<span {{ $attributes->class(['inline-flex items-center gap-0.5']) }} role="img" aria-label="Rating {{ number_format($value, 1) }} dari 5">
    @for ($i = 1; $i <= 5; $i++)
        <x-icon name="star" solid :class="$i <= round($value) ? 'h-4 w-4 text-amber-500' : 'h-4 w-4 text-gray-300 dark:text-gray-600'" />
    @endfor
</span>
