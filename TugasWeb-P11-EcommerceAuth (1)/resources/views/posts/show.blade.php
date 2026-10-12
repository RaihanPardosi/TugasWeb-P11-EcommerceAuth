<x-app-layout :title="$post->title">
    <article class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
            <x-icon name="arrow-left" class="h-4 w-4" /> Semua artikel
        </a>

        <div class="mt-6 flex flex-wrap items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
            @unless ($post->isPublished())
                <x-badge tone="gray">Draf</x-badge>
            @endunless
            <span>{{ $post->author->name }}</span>
            @if ($post->published_at)
                <span>&middot;</span>
                <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->isoFormat('D MMMM Y') }}</time>
            @endif
        </div>

        <h1 class="mt-3 text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl">{{ $post->title }}</h1>

        @if ($post->excerpt)
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">{{ $post->excerpt }}</p>
        @endif

        <div class="mt-8 space-y-5 border-t border-gray-200 pt-8 text-base leading-relaxed text-gray-800 dark:border-gray-800 dark:text-gray-200">
            @foreach (preg_split('/\R{2,}/', trim($post->body)) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>

        @can('update', $post)
            <div class="mt-10 flex gap-3 border-t border-gray-200 pt-6 dark:border-gray-800">
                <x-button-link variant="secondary" href="{{ route('manage.artikel.edit', $post) }}">
                    <x-icon name="pencil" class="h-4 w-4" /> Edit artikel
                </x-button-link>
            </div>
        @endcan
    </article>
</x-app-layout>
