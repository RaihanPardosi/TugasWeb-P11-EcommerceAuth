@props(['label', 'value', 'icon'])

<div class="rounded-md border p-5 border-zinc-800 bg-zinc-900">
    <div class="flex items-center justify-between">
        <p class="text-sm font-medium text-zinc-400">{{ $label }}</p>
        <span class="grid h-9 w-9 place-items-center rounded bg-red-600/15 text-red-500">
            <x-icon :name="$icon" class="h-5 w-5" />
        </span>
    </div>
    <p class="mt-3 text-2xl font-bold tracking-tight text-white">{{ $value }}</p>
</div>
