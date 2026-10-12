<x-app-layout :title="$product->name">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <nav class="flex flex-wrap items-center gap-2 text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
            <a href="{{ route('products.index') }}" class="hover:text-gray-900 dark:hover:text-white">Produk</a>
            <span>/</span>
            <a href="{{ route('products.index', ['kategori' => $product->category->slug]) }}" class="hover:text-gray-900 dark:hover:text-white">{{ $product->category->name }}</a>
        </nav>

        <div class="mt-6 grid gap-8 lg:grid-cols-2 lg:gap-12">
            <x-product-tile :product="$product" class="aspect-square rounded-2xl" />

            <div>
                <p class="text-sm font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ $product->brand?->name ?? 'Tanpa merek' }}</p>
                <h1 class="mt-2 text-3xl font-extrabold leading-tight tracking-tight">{{ $product->name }}</h1>

                <div class="mt-3 flex flex-wrap items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                    @if ($product->reviews_count > 0)
                        <x-rating :value="$product->reviews_avg_rating" />
                        <span>{{ number_format($product->reviews_avg_rating, 1) }} ({{ $product->reviews_count }} ulasan)</span>
                    @else
                        <span>Belum ada ulasan</span>
                    @endif
                </div>

                <p class="mt-6 text-3xl font-bold">@rupiah($product->price)</p>

                <div class="mt-4 flex flex-wrap items-center gap-2">
                    @if ($product->stock < 1)
                        <x-badge tone="red">Stok habis</x-badge>
                    @elseif ($product->stock <= 10)
                        <x-badge tone="amber">Sisa {{ $product->stock }} unit</x-badge>
                    @else
                        <x-badge tone="green">Stok tersedia</x-badge>
                    @endif
                    <x-badge>{{ $product->category->name }}</x-badge>
                </div>

                <p class="mt-6 leading-relaxed text-gray-700 dark:text-gray-300">{{ $product->description }}</p>

                <dl class="mt-8 grid grid-cols-2 gap-4 border-t border-gray-200 pt-6 text-sm dark:border-gray-800">
                    <div>
                        <dt class="text-gray-500 dark:text-gray-400">SKU</dt>
                        <dd class="mt-0.5 font-mono font-medium">{{ $product->sku }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 dark:text-gray-400">Stok</dt>
                        <dd class="mt-0.5 font-medium">{{ $product->stock }} unit</dd>
                    </div>
                </dl>
            </div>
        </div>

        <section class="mt-14">
            <h2 class="text-xl font-bold tracking-tight">Ulasan pembeli</h2>
            @forelse ($product->reviews as $review)
                <div class="mt-4 rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <div class="flex items-center gap-3">
                            <span class="grid h-8 w-8 place-items-center rounded-full bg-amber-100 text-sm font-bold text-amber-800 dark:bg-amber-900/40 dark:text-amber-400">{{ mb_strtoupper(mb_substr($review->user->name, 0, 1)) }}</span>
                            <p class="text-sm font-semibold">{{ $review->user->name }}</p>
                        </div>
                        <x-rating :value="$review->rating" />
                    </div>
                    @if ($review->comment)
                        <p class="mt-3 text-sm text-gray-700 dark:text-gray-300">{{ $review->comment }}</p>
                    @endif
                </div>
            @empty
                <p class="mt-4 rounded-xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">Belum ada ulasan untuk produk ini.</p>
            @endforelse
        </section>

        @if ($related->isNotEmpty())
            <section class="mt-14">
                <h2 class="text-xl font-bold tracking-tight">Produk serupa</h2>
                <div class="mt-4 grid grid-cols-2 gap-4 lg:grid-cols-4">
                    @foreach ($related as $item)
                        <x-product-card :product="$item" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-app-layout>
