<x-app-layout title="Beranda">
    <section class="bg-amber-950 text-amber-50">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-14 sm:px-6 md:grid-cols-2 lg:px-8 lg:py-20">
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-amber-400">Toko kopi dan alat seduh</p>
                <h1 class="mt-4 text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl">Kopi pilihan Sumatera, lengkap dengan alat seduhnya.</h1>
                <p class="mt-5 max-w-xl text-lg text-amber-100/80">Biji kopi sangrai dari Gayo, Sidikalang, dan Mandailing, ditambah dripper, grinder, serta perlengkapan seduh untuk dapur di rumah.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-amber-500 px-5 py-3 text-sm font-semibold text-amber-950 transition hover:bg-amber-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                        Lihat semua produk
                        <x-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                    <x-button-link variant="dark" href="{{ route('posts.index') }}" class="px-5 py-3">Baca artikel</x-button-link>
                </div>

                <dl class="mt-10 grid max-w-md grid-cols-3 gap-6 border-t border-amber-800 pt-6">
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-amber-300/70">Produk</dt>
                        <dd class="mt-1 text-2xl font-bold">{{ $stats['products'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-amber-300/70">Kategori</dt>
                        <dd class="mt-1 text-2xl font-bold">{{ $stats['categories'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-amber-300/70">Artikel</dt>
                        <dd class="mt-1 text-2xl font-bold">{{ $stats['posts'] }}</dd>
                    </div>
                </dl>
            </div>

            <div class="flex justify-center">
                <svg viewBox="0 0 320 280" fill="none" class="w-full max-w-sm" aria-hidden="true">
                    <ellipse cx="150" cy="240" rx="118" ry="16" class="fill-amber-900"/>
                    <path d="M60 110H240V158C240 198 208 230 168 230H132C92 230 60 198 60 158Z" class="fill-amber-700"/>
                    <path d="M240 128H254A26 26 0 0 1 254 180H238" class="stroke-amber-700" stroke-width="14" stroke-linecap="round"/>
                    <ellipse cx="150" cy="110" rx="90" ry="12" class="fill-amber-950"/>
                    <ellipse cx="150" cy="110" rx="78" ry="8" class="fill-amber-900"/>
                    <path d="M118 84c-12-14 10-24 0-40M152 88c-12-14 10-24 0-40M186 84c-12-14 10-24 0-40" class="stroke-amber-300" stroke-width="5" stroke-linecap="round" opacity="0.7"/>
                </svg>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight">Kategori</h2>
        <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['kategori' => $category->slug]) }}" class="group flex flex-col items-start gap-3 rounded-xl border border-gray-200 bg-white p-4 transition hover:border-amber-700 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-amber-600">
                    <span class="grid h-10 w-10 place-items-center rounded-lg bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-500">
                        <x-icon :name="$category->icon()" class="h-5 w-5" />
                    </span>
                    <div>
                        <p class="text-sm font-semibold leading-snug">{{ $category->name }}</p>
                        <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ $category->products_count }} produk</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <h2 class="text-2xl font-bold tracking-tight">Produk pilihan</h2>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-amber-800 hover:underline dark:text-amber-500">
                Semua produk <x-icon name="arrow-right" class="h-4 w-4" />
            </a>
        </div>

        @if ($featured->isEmpty())
            <p class="mt-6 rounded-xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">Belum ada produk pilihan. Jalankan seeder untuk mengisi data.</p>
        @else
            <div class="mt-6 grid grid-cols-2 gap-4 lg:grid-cols-4">
                @foreach ($featured as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @endif
    </section>

    @if ($latestPosts->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-4">
                <h2 class="text-2xl font-bold tracking-tight">Artikel terbaru</h2>
                <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-amber-800 hover:underline dark:text-amber-500">
                    Semua artikel <x-icon name="arrow-right" class="h-4 w-4" />
                </a>
            </div>
            <div class="mt-6 grid gap-4 md:grid-cols-3">
                @foreach ($latestPosts as $post)
                    @include('posts._card', ['post' => $post])
                @endforeach
            </div>
        </section>
    @endif
</x-app-layout>
