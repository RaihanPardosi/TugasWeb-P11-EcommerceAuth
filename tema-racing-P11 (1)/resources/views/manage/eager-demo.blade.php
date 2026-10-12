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
        <p class="mt-1 text-sm text-zinc-400">Mengambil {{ $limit }} produk beserta kategori dan merek, dengan dua cara berbeda.</p>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-2">
            @foreach ($cards as $card)
                <section class="rounded-md border p-6 border-zinc-800 bg-zinc-900">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="font-semibold">{{ $card['title'] }}</h2>
                        <x-badge :tone="$card['tone']">{{ $card['result']['count'] }} query</x-badge>
                    </div>
                    <p class="mt-1 text-sm text-zinc-400">{{ $card['note'] }}</p>
                    <pre class="mt-4 overflow-x-auto rounded bg-zinc-950 p-3 text-xs text-zinc-300"><code>{{ $card['code'] }}</code></pre>
                    <p class="mt-4 text-3xl font-bold">{{ $card['result']['ms'] }} <span class="text-base font-medium text-zinc-400">ms</span></p>
                    <p class="mt-4 text-xs font-semibold uppercase tracking-wide text-zinc-400">Contoh query</p>
                    <ul class="mt-2 space-y-1.5">
                        @foreach ($card['result']['samples'] as $sql)
                            <li class="overflow-x-auto whitespace-nowrap rounded-sm px-2.5 py-1.5 font-mono text-xs bg-zinc-950/60 text-zinc-300">{{ $sql }}</li>
                        @endforeach
                    </ul>
                </section>
            @endforeach
        </div>

        <p class="text-sm text-zinc-400">
            Selisih {{ $lazy['count'] - $eager['count'] }} query untuk {{ $limit }} produk. Selisih ini bertambah seiring jumlah data.
        </p>
    </div>
</x-app-layout>
