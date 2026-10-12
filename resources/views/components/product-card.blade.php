@props(['product'])

<a href="{{ route('products.show', $product->slug) }}" class="group flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white transition hover:border-gray-300 hover:shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:hover:border-gray-600">
    <x-product-tile :product="$product" class="aspect-[4/3]" />
    <div class="flex flex-1 flex-col p-4">
        <p class="truncate text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ $product->brand?->name ?? 'Tanpa merek' }}</p>
        <h3 class="mt-1 line-clamp-2 text-sm font-semibold leading-snug text-gray-900 group-hover:text-amber-800 dark:text-gray-100 dark:group-hover:text-amber-400">{{ $product->name }}</h3>
        @if (isset($product->reviews_avg_rating) && $product->reviews_count > 0)
            <div class="mt-2 flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400">
                <x-icon name="star" solid class="h-4 w-4 text-amber-500" />
                <span class="font-medium text-gray-700 dark:text-gray-300">{{ number_format($product->reviews_avg_rating, 1) }}</span>
                <span>({{ $product->reviews_count }})</span>
            </div>
        @endif
        <div class="mt-auto flex flex-wrap items-end justify-between gap-2 pt-4">
            <p class="text-base font-semibold text-gray-900 dark:text-white">@rupiah($product->price)</p>
            @if ($product->stock < 1)
                <x-badge tone="red">Habis</x-badge>
            @elseif ($product->stock <= 10)
                <x-badge tone="amber">Sisa {{ $product->stock }}</x-badge>
            @endif
        </div>
    </div>
</a>
