<x-app-layout title="Pesanan">
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">Pesanan saya</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Riwayat pesanan akun Anda.</p>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        @if ($orders->isEmpty())
            <div class="rounded-xl border border-dashed border-gray-300 p-12 text-center dark:border-gray-700">
                <p class="font-medium">Belum ada pesanan.</p>
                <x-button-link href="{{ route('products.index') }}" class="mt-5">Jelajahi produk</x-button-link>
            </div>
        @else
            <div class="divide-y divide-gray-200 overflow-hidden rounded-xl border border-gray-200 bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
                @foreach ($orders as $order)
                    @include('orders._row', ['order' => $order])
                @endforeach
            </div>
            <div class="mt-6">{{ $orders->links() }}</div>
        @endif
    </div>
</x-app-layout>
