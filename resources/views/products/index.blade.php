@php
    $chipUrl = fn (?string $slug) => route('products.index', array_filter([
        'kategori' => $slug,
        'q' => $term !== '' ? $term : null,
        'urut' => $sort !== 'terbaru' ? $sort : null,
    ]));
@endphp

<x-app-layout title="Produk">
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">{{ $category?->name ?? 'Semua produk' }}</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ $products->total() }} produk ditemukan@if ($term !== '') untuk &ldquo;{{ $term }}&rdquo;@endif.
        </p>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('products.index') }}" class="grid gap-3 sm:grid-cols-[1fr_auto_auto]">
            @if ($category)
                <input type="hidden" name="kategori" value="{{ $category->slug }}">
            @endif

            <div class="relative">
                <x-icon name="search" class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" />
                <x-text-input type="search" name="q" :value="$term" placeholder="Cari nama, SKU, atau deskripsi" class="block w-full pl-10" aria-label="Cari produk" />
            </div>

            <select name="urut" aria-label="Urutkan" class="rounded-lg border-gray-300 text-sm shadow-sm focus:border-amber-700 focus:ring-amber-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                <option value="terbaru" @selected($sort === 'terbaru')>Terbaru</option>
                <option value="termurah" @selected($sort === 'termurah')>Harga terendah</option>
                <option value="termahal" @selected($sort === 'termahal')>Harga tertinggi</option>
                <option value="nama" @selected($sort === 'nama')>Nama A-Z</option>
            </select>

            <x-primary-button>Terapkan</x-primary-button>
        </form>

        <div class="-mx-4 mt-5 flex gap-2 overflow-x-auto px-4 pb-1 sm:mx-0 sm:flex-wrap sm:px-0">
            <a href="{{ $chipUrl(null) }}" @class([
                'whitespace-nowrap rounded-full border px-3.5 py-1.5 text-sm font-medium transition',
                'border-amber-800 bg-amber-800 text-white dark:border-amber-700 dark:bg-amber-700' => ! $category,
                'border-gray-300 bg-white text-gray-700 hover:border-gray-400 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300' => $category,
            ])>Semua</a>
            @foreach ($categories as $item)
                <a href="{{ $chipUrl($item->slug) }}" @class([
                    'whitespace-nowrap rounded-full border px-3.5 py-1.5 text-sm font-medium transition',
                    'border-amber-800 bg-amber-800 text-white dark:border-amber-700 dark:bg-amber-700' => $category?->id === $item->id,
                    'border-gray-300 bg-white text-gray-700 hover:border-gray-400 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300' => $category?->id !== $item->id,
                ])>{{ $item->name }} <span class="opacity-70">{{ $item->products_count }}</span></a>
            @endforeach
        </div>

        @if ($products->isEmpty())
            <div class="mt-8 rounded-xl border border-dashed border-gray-300 p-12 text-center dark:border-gray-700">
                <p class="font-medium">Tidak ada produk yang cocok.</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Coba kata kunci lain atau hapus filter kategori.</p>
                <x-button-link variant="secondary" href="{{ route('products.index') }}" class="mt-5">Reset filter</x-button-link>
            </div>
        @else
            <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            <div class="mt-8">{{ $products->links() }}</div>
        @endif
    </div>
</x-app-layout>
