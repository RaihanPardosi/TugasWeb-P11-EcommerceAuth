<a href="{{ route('orders.show', $order->order_number) }}" class="flex flex-col gap-2 p-4 transition sm:flex-row sm:items-center sm:justify-between hover:bg-zinc-800/40">
    <div>
        <p class="font-mono text-sm font-semibold">{{ $order->order_number }}</p>
        <p class="mt-0.5 text-xs text-zinc-400">{{ $order->created_at->isoFormat('D MMM Y') }} &middot; {{ $order->items_count }} jenis produk</p>
    </div>
    <div class="flex items-center justify-between gap-4 sm:justify-end">
        <x-badge :tone="$order->status->tone()">{{ $order->status->label() }}</x-badge>
        <p class="text-sm font-semibold">@rupiah($order->total)</p>
    </div>
</a>
