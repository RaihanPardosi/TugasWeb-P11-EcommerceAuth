<x-app-layout title="Beranda">
    <section class="relative overflow-hidden bg-zinc-950 text-zinc-100 rc-cut">
        <div class="rc-stripes pointer-events-none absolute -right-24 top-0 hidden h-full w-1/2 opacity-30 md:block" aria-hidden="true"></div>
        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-4 pb-20 pt-14 sm:px-6 md:grid-cols-2 lg:px-8 lg:pb-28 lg:pt-20">
            <div>
                <p class="flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-red-500"><span class="h-0.5 w-8 bg-red-600"></span>Toko kopi dan alat seduh</p>
                <h1 class="mt-4 text-5xl font-extrabold leading-[0.95] sm:text-7xl">Kopi pilihan Sumatera, lengkap dengan alat seduhnya.</h1>
                <p class="mt-5 max-w-xl text-lg text-zinc-300">Biji kopi sangrai dari Gayo, Sidikalang, dan Mandailing, ditambah dripper, grinder, serta perlengkapan seduh untuk dapur di rumah.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <x-button-link href="{{ route('products.index') }}" class="px-5 py-3">
                        Lihat semua produk
                        <x-icon name="arrow-right" class="h-4 w-4" />
                    </x-button-link>
                    <x-button-link variant="dark" href="{{ route('posts.index') }}" class="px-5 py-3">Baca artikel</x-button-link>
                </div>

                <dl class="mt-10 grid max-w-md grid-cols-3 gap-6 border-t border-zinc-800 pt-6">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-400">Produk</dt>
                        <dd class="rc-display mt-1 text-4xl font-bold text-white">{{ $stats['products'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-400">Kategori</dt>
                        <dd class="rc-display mt-1 text-4xl font-bold text-white">{{ $stats['categories'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-400">Artikel</dt>
                        <dd class="rc-display mt-1 text-4xl font-bold text-white">{{ $stats['posts'] }}</dd>
                    </div>
                </dl>
            </div>

            <div class="flex justify-center">
                <svg viewBox="0 0 320 280" fill="none" class="w-full max-w-sm" aria-hidden="true">
                    <circle cx="160" cy="140" r="128" class="fill-zinc-900 stroke-zinc-700" stroke-width="6"/>
                    <circle cx="160" cy="140" r="116" class="stroke-zinc-800" stroke-width="2"/>
                    <line x1="97.8" y1="202.2" x2="85.0" y2="215.0" class="stroke-zinc-400" stroke-width="3" stroke-linecap="round"/>
                    <line x1="81.4" y1="195.1" x2="73.2" y2="200.8" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="73.0" y1="180.6" x2="63.9" y2="184.8" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="75.0" y1="162.8" x2="57.6" y2="167.4" class="stroke-zinc-400" stroke-width="3" stroke-linecap="round"/>
                    <line x1="64.4" y1="148.4" x2="54.4" y2="149.2" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="64.4" y1="131.6" x2="54.4" y2="130.8" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="75.0" y1="117.2" x2="57.6" y2="112.6" class="stroke-zinc-400" stroke-width="3" stroke-linecap="round"/>
                    <line x1="73.0" y1="99.4" x2="63.9" y2="95.2" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="81.4" y1="84.9" x2="73.2" y2="79.2" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="97.8" y1="77.8" x2="85.0" y2="65.0" class="stroke-zinc-400" stroke-width="3" stroke-linecap="round"/>
                    <line x1="104.9" y1="61.4" x2="99.2" y2="53.2" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="119.4" y1="53.0" x2="115.2" y2="43.9" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="137.2" y1="55.0" x2="132.6" y2="37.6" class="stroke-zinc-400" stroke-width="3" stroke-linecap="round"/>
                    <line x1="151.6" y1="44.4" x2="150.8" y2="34.4" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="168.4" y1="44.4" x2="169.2" y2="34.4" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="182.8" y1="55.0" x2="187.4" y2="37.6" class="stroke-zinc-400" stroke-width="3" stroke-linecap="round"/>
                    <line x1="200.6" y1="53.0" x2="204.8" y2="43.9" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="215.1" y1="61.4" x2="220.8" y2="53.2" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="222.2" y1="77.8" x2="235.0" y2="65.0" class="stroke-zinc-400" stroke-width="3" stroke-linecap="round"/>
                    <line x1="238.6" y1="84.9" x2="246.8" y2="79.2" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="247.0" y1="99.4" x2="256.1" y2="95.2" class="stroke-zinc-400" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="245.0" y1="117.2" x2="262.4" y2="112.6" class="stroke-zinc-400" stroke-width="3" stroke-linecap="round"/>
                    <line x1="255.6" y1="131.6" x2="265.6" y2="130.8" class="stroke-red-500" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="255.6" y1="148.4" x2="265.6" y2="149.2" class="stroke-red-500" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="245.0" y1="162.8" x2="262.4" y2="167.4" class="stroke-red-500" stroke-width="3" stroke-linecap="round"/>
                    <line x1="247.0" y1="180.6" x2="256.1" y2="184.8" class="stroke-red-500" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="238.6" y1="195.1" x2="246.8" y2="200.8" class="stroke-red-500" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="222.2" y1="202.2" x2="235.0" y2="215.0" class="stroke-red-500" stroke-width="3" stroke-linecap="round"/>
                    <path d="M235.7 133.4A76 76 0 0 1 213.7 193.7" class="stroke-red-600" stroke-width="6" stroke-linecap="round" opacity="0.85"/>
                    <polygon points="250.9,125.6 159.1,134.1 140.2,143.1 160.9,145.9" class="fill-red-600"/>
                    <circle cx="160" cy="140" r="14" class="fill-zinc-950 stroke-zinc-600" stroke-width="3"/>
                    <circle cx="160" cy="140" r="4" class="fill-red-500"/>
                    <path d="M120 214h80" class="stroke-zinc-700" stroke-width="3" stroke-linecap="round"/>
                    <path d="M132 226h56" class="stroke-red-600" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight">Kategori</h2>
        <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['kategori' => $category->slug]) }}" class="group flex flex-col items-start gap-3 rounded-md border p-4 transition border-zinc-800 bg-zinc-900 hover:border-red-600">
                    <span class="grid h-10 w-10 place-items-center rounded bg-red-600/15 text-red-500">
                        <x-icon :name="$category->icon()" class="h-5 w-5" />
                    </span>
                    <div>
                        <p class="text-sm font-semibold leading-snug">{{ $category->name }}</p>
                        <p class="mt-0.5 text-xs text-zinc-400">{{ $category->products_count }} produk</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <h2 class="text-2xl font-bold tracking-tight">Produk pilihan</h2>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-sm font-medium hover:underline text-red-500">
                Semua produk <x-icon name="arrow-right" class="h-4 w-4" />
            </a>
        </div>

        @if ($featured->isEmpty())
            <p class="mt-6 rounded-md border border-dashed p-8 text-center text-sm border-zinc-800 text-zinc-400">Belum ada produk pilihan. Jalankan seeder untuk mengisi data.</p>
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
                <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1 text-sm font-medium hover:underline text-red-500">
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
