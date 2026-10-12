@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded text-sm shadow-sm disabled:opacity-60 border-zinc-800 bg-zinc-950 text-zinc-100 placeholder-zinc-500 focus:border-red-600 focus:ring-red-500']) }}>
