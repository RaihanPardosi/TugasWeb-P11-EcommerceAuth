@php
    $user = auth()->user();
    $shortcuts = [];

    if ($user->hasRole('admin', 'editor')) {
        $shortcuts[] = ['Kelola artikel', 'Tulis, edit, dan hapus artikel sesuai hak akses.', route('manage.artikel.index'), 'document'];
    }

    if ($user->isAdmin()) {
        $shortcuts[] = ['Kelola pengguna', 'Ubah peran admin, editor, dan pengguna.', route('manage.users.index'), 'users'];
        $shortcuts[] = ['Demo eager loading', 'Bandingkan jumlah query lazy dan eager.', route('manage.eager'), 'bolt'];
    }
@endphp

<x-app-layout title="Dashboard">
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Halo, {{ $user->name }}</h1>
                <p class="mt-1 text-sm text-zinc-400">Ringkasan akun dan aktivitas Anda.</p>
            </div>
            <x-badge :tone="$user->role->tone()" class="px-3 py-1 text-sm">
                <x-icon name="shield" class="mr-1.5 h-4 w-4" /> {{ $user->role->label() }}
            </x-badge>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-10 px-4 py-8 sm:px-6 lg:px-8">
        @if ($adminStats)
            <section>
                <h2 class="text-sm font-semibold uppercase tracking-wide text-zinc-400">Toko</h2>
                <div class="mt-3 grid grid-cols-2 gap-4 lg:grid-cols-4">
                    <x-stat label="Pengguna" :value="$adminStats['users']" icon="users" />
                    <x-stat label="Produk" :value="$adminStats['products']" icon="cube" />
                    <x-stat label="Pesanan" :value="$adminStats['orders']" icon="package" />
                    <x-stat label="Pendapatan" :value="'Rp ' . number_format($adminStats['revenue'], 0, ',', '.')" icon="tag" />
                </div>
            </section>
        @endif

        @if ($postStats)
            <section>
                <h2 class="text-sm font-semibold uppercase tracking-wide text-zinc-400">Artikel</h2>
                <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <x-stat label="Total artikel" :value="$postStats['total']" icon="document" />
                    <x-stat label="Artikel saya" :value="$postStats['mine']" icon="pencil" />
                    <x-stat label="Draf" :value="$postStats['drafts']" icon="list" />
                </div>
            </section>
        @endif

        @if (count($shortcuts))
            <section>
                <h2 class="text-sm font-semibold uppercase tracking-wide text-zinc-400">Akses cepat</h2>
                <div class="mt-3 grid gap-4 md:grid-cols-3">
                    @foreach ($shortcuts as $shortcut)
                        <a href="{{ $shortcut[2] }}" class="group flex items-start gap-4 rounded-md border p-5 transition border-zinc-800 bg-zinc-900 hover:border-red-600">
                            <span class="grid h-10 w-10 shrink-0 place-items-center rounded bg-red-600/15 text-red-500">
                                <x-icon :name="$shortcut[3]" class="h-5 w-5" />
                            </span>
                            <div>
                                <p class="font-semibold">{{ $shortcut[0] }}</p>
                                <p class="mt-0.5 text-sm text-zinc-400">{{ $shortcut[1] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <section>
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-zinc-400">Pesanan terakhir</h2>
                <a href="{{ route('orders.index') }}" class="text-sm font-medium hover:underline text-red-500">Lihat semua</a>
            </div>

            @if ($orders->isEmpty())
                <p class="mt-3 rounded-md border border-dashed p-8 text-center text-sm border-zinc-800 text-zinc-400">Anda belum memiliki pesanan.</p>
            @else
                <div class="mt-3 divide-y overflow-hidden rounded-md border divide-zinc-800 border-zinc-800 bg-zinc-900">
                    @foreach ($orders as $order)
                        @include('orders._row', ['order' => $order])
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</x-app-layout>
