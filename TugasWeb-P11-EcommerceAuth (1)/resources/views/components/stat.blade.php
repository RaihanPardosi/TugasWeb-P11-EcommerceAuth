@props(['label', 'value', 'icon'])

<div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center justify-between">
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $label }}</p>
        <span class="grid h-9 w-9 place-items-center rounded-lg bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-500">
            <x-icon :name="$icon" class="h-5 w-5" />
        </span>
    </div>
    <p class="mt-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $value }}</p>
</div>
