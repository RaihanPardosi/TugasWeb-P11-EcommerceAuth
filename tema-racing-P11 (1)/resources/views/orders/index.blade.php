<x-app-layout title="Pesanan">
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">Pesanan saya</h1>
        <p class="mt-1 text-sm text-zinc-400">Riwayat pesanan akun Anda.</p>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        @if ($orders->isEmpty())
            <div class="rounded-md border border-dashed p-12 text-center border-zinc-800">
                <p class="font-medium">Belum ada pesanan.</p>
                <x-button-link href="{{ route('products.index') }}" class="mt-5">Jelajahi produk</x-button-link>
            </div>
        @else
            <div class="divide-y overflow-hidden rounded-md border divide-zinc-800 border-zinc-800 bg-zinc-900">
                @foreach ($orders as $order)
                    @include('orders._row', ['order' => $order])
                @endforeach
            </div>
            <div class="mt-6">{{ $orders->links() }}</div>
        @endif
    </div>
</x-app-layout>
