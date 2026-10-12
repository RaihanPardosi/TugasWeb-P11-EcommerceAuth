<x-app-layout title="Kelola artikel">
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Kelola artikel</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Admin dapat mengubah semua artikel. Editor hanya dapat mengubah artikel miliknya.</p>
            </div>
            @can('create', App\Models\Post::class)
                <x-button-link href="{{ route('manage.artikel.create') }}">
                    <x-icon name="plus" class="h-4 w-4" /> Tulis artikel
                </x-button-link>
            @endcan
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if ($posts->isEmpty())
            <p class="rounded-xl border border-dashed border-gray-300 p-10 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">Belum ada artikel.</p>
        @else
            <div class="divide-y divide-gray-200 overflow-hidden rounded-xl border border-gray-200 bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
                @foreach ($posts as $post)
                    <div class="flex flex-col gap-3 p-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <x-badge :tone="$post->status->tone()">{{ $post->status->label() }}</x-badge>
                                <a href="{{ route('posts.show', $post->slug) }}" class="truncate font-semibold hover:text-amber-800 dark:hover:text-amber-400">{{ $post->title }}</a>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ $post->author->name }} &middot; diperbarui {{ $post->updated_at->diffForHumans() }}
                            </p>
                        </div>

                        <div class="flex shrink-0 items-center gap-2">
                            @can('update', $post)
                                <x-button-link variant="secondary" href="{{ route('manage.artikel.edit', $post) }}" class="px-3 py-1.5">
                                    <x-icon name="pencil" class="h-4 w-4" /> Edit
                                </x-button-link>
                            @endcan
                            @can('delete', $post)
                                <form method="POST" action="{{ route('manage.artikel.destroy', $post) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-3 py-1.5 text-sm font-semibold text-red-700 shadow-sm transition hover:bg-red-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 dark:border-red-500/30 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-red-500/10">
                                        <x-icon name="trash" class="h-4 w-4" /> Hapus
                                    </button>
                                </form>
                            @endcan
                            @cannot('update', $post)
                                <span class="inline-flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                                    <x-icon name="lock" class="h-4 w-4" /> Hanya baca
                                </span>
                            @endcannot
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $posts->links() }}</div>
        @endif
    </div>
</x-app-layout>
