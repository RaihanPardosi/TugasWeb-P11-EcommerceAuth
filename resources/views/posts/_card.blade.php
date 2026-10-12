<a href="{{ route('posts.show', $post->slug) }}" class="group flex flex-col rounded-md border p-6 transition hover:shadow-sm border-zinc-800 bg-zinc-900 hover:border-zinc-700">
    <p class="text-xs text-zinc-400">
        {{ $post->published_at?->isoFormat('D MMMM Y') }} &middot; {{ $post->author->name }}
    </p>
    <h3 class="mt-3 text-lg font-semibold leading-snug group-hover:text-red-400">{{ $post->title }}</h3>
    <p class="mt-2 line-clamp-3 text-sm text-zinc-400">{{ $post->excerpt }}</p>
    <span class="mt-4 inline-flex items-center gap-1 pt-2 text-sm font-medium text-red-500">
        Baca selengkapnya <x-icon name="arrow-right" class="h-4 w-4" />
    </span>
</a>
