<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-sm bg-red-600 px-4 py-2.5 text-sm font-bold uppercase tracking-wide text-white shadow-sm transition hover:bg-red-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-950 disabled:opacity-60']) }}>
    {{ $slot }}
</button>
