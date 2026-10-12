<x-app-layout :title="'Pesanan ' . $order->order_number">
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-zinc-400 hover:text-white">
            <x-icon name="arrow-left" class="h-4 w-4" /> Semua pesanan
        </a>

        <div class="mt-5 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="font-mono text-2xl font-bold tracking-tight">{{ $order->order_number }}</h1>
                <p class="mt-1 text-sm text-zinc-400">Dibuat {{ $order->created_at->isoFormat('D MMMM Y, HH:mm') }}</p>
            </div>
            <x-badge :tone="$order->status->tone()" class="px-3 py-1 text-sm">{{ $order->status->label() }}</x-badge>
        </div>

        <div class="mt-6 overflow-hidden rounded-md border border-zinc-800 bg-zinc-900">
            <ul class="divide-y divide-zinc-800">
                @foreach ($order->items as $item)
                    <li class="flex items-center justify-between gap-4 p-4">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold">{{ $item->product->name }}</p>
                            <p class="mt-0.5 text-xs text-zinc-400">{{ $item->quantity }} x @rupiah($item->unit_price)</p>
                        </div>
                        <p class="shrink-0 text-sm font-semibold">@rupiah($item->subtotal)</p>
                    </li>
                @endforeach
            </ul>
            <dl class="space-y-2 border-t p-4 text-sm border-zinc-800 bg-zinc-950/40">
                <div class="flex justify-between"><dt class="text-zinc-400">Subtotal</dt><dd>@rupiah($order->subtotal)</dd></div>
                <div class="flex justify-between"><dt class="text-zinc-400">Ongkos kirim</dt><dd>@rupiah($order->shipping_cost)</dd></div>
                <div class="flex justify-between text-base font-bold"><dt>Total</dt><dd>@rupiah($order->total)</dd></div>
            </dl>
        </div>

        @if ($order->shippingAddress)
            <div class="mt-6 rounded-md border p-5 text-sm border-zinc-800 bg-zinc-900">
                <h2 class="font-semibold">Alamat pengiriman</h2>
                <p class="mt-2">{{ $order->shippingAddress->recipient_name }} &middot; {{ $order->shippingAddress->phone }}</p>
                <p class="mt-1 text-zinc-400">{{ $order->shippingAddress->street }}, {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }} {{ $order->shippingAddress->postal_code }}</p>
            </div>
        @endif

        @if ($order->notes)
            <p class="mt-4 text-sm text-zinc-400">Catatan: {{ $order->notes }}</p>
        @endif
    </div>
</x-app-layout>
