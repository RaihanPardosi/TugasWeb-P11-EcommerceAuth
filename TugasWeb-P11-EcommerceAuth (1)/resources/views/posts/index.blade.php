<x-app-layout title="Artikel">
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">Artikel</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Panduan seduh, pengetahuan kopi, dan tips memilih peralatan.</p>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if ($posts->isEmpty())
            <p class="rounded-xl border border-dashed border-gray-300 p-10 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">Belum ada artikel yang terbit.</p>
        @else
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    @include('posts._card', ['post' => $post])
                @endforeach
            </div>
            <div class="mt-8">{{ $posts->links() }}</div>
        @endif
    </div>
</x-app-layout>
