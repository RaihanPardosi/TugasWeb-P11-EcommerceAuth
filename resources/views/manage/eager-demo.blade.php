@php
    $cards = [
        [
            'title' => 'Lazy loading (masalah N+1)',
            'result' => $lazy,
            'tone' => 'red',
            'code' => 'Product::limit('.$limit.')->get()',
            'note' => 'Setiap akses $product->category dan $product->brand memicu query baru.',
        ],
        [
            'title' => 'Eager loading dengan with()',
            'result' => $eager,
            'tone' => 'green',
            'code' => "Product::with(['category', 'brand'])->limit(".$limit.')->get()',
            'note' => 'Relasi dimuat sekaligus dengan satu query per relasi.',
        ],
    ];
@endphp

<x-app-layout title="Demo eager loading">
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">Demo eager loading</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Mengambil {{ $limit }} produk beserta kategori dan merek, dengan dua cara berbeda.</p>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-2">
            @foreach ($cards as $card)
                <section class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="font-semibold">{{ $card['title'] }}</h2>
                        <x-badge :tone="$card['tone']">{{ $card['result']['count'] }} query</x-badge>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $card['note'] }}</p>
                    <pre class="mt-4 overflow-x-auto rounded-lg bg-gray-900 p-3 text-xs text-amber-200"><code>{{ $card['code'] }}</code></pre>
                    <p class="mt-4 text-3xl font-bold">{{ $card['result']['ms'] }} <span class="text-base font-medium text-gray-500 dark:text-gray-400">ms</span></p>
                    <p class="mt-4 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Contoh query</p>
                    <ul class="mt-2 space-y-1.5">
                        @foreach ($card['result']['samples'] as $sql)
                            <li class="overflow-x-auto whitespace-nowrap rounded-md bg-gray-50 px-2.5 py-1.5 font-mono text-xs text-gray-700 dark:bg-gray-900/60 dark:text-gray-300">{{ $sql }}</li>
                        @endforeach
                    </ul>
                </section>
            @endforeach
        </div>

        <p class="text-sm text-gray-600 dark:text-gray-400">
            Selisih {{ $lazy['count'] - $eager['count'] }} query untuk {{ $limit }} produk. Selisih ini bertambah seiring jumlah data.
        </p>
    </div>
</x-app-layout>
