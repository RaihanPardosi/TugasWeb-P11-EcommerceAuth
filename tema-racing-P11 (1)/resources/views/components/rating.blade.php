@props(['value' => 0])

<span {{ $attributes->class(['inline-flex items-center gap-0.5']) }} role="img" aria-label="Rating {{ number_format($value, 1) }} dari 5">
    @for ($i = 1; $i <= 5; $i++)
        <x-icon name="star" solid :class="$i <= round($value) ? 'h-4 w-4 text-yellow-400' : 'h-4 w-4 text-zinc-700'" />
    @endfor
</span>
