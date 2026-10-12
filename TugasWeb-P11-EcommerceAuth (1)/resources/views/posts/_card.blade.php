<a href="{{ route('posts.show', $post->slug) }}" class="group flex flex-col rounded-xl border border-gray-200 bg-white p-6 transition hover:border-gray-300 hover:shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:hover:border-gray-600">
    <p class="text-xs text-gray-500 dark:text-gray-400">
        {{ $post->published_at?->isoFormat('D MMMM Y') }} &middot; {{ $post->author->name }}
    </p>
    <h3 class="mt-3 text-lg font-semibold leading-snug group-hover:text-amber-800 dark:group-hover:text-amber-400">{{ $post->title }}</h3>
    <p class="mt-2 line-clamp-3 text-sm text-gray-600 dark:text-gray-400">{{ $post->excerpt }}</p>
    <span class="mt-4 inline-flex items-center gap-1 pt-2 text-sm font-medium text-amber-800 dark:text-amber-500">
        Baca selengkapnya <x-icon name="arrow-right" class="h-4 w-4" />
    </span>
</a>
