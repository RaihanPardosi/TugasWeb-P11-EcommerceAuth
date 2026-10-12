<x-app-layout title="Edit artikel">
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">Edit artikel</h1>
        <p class="mt-1 text-sm text-zinc-400">{{ $post->title }}</p>
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('manage.artikel.update', $post) }}" class="rounded-md border p-6 border-zinc-800 bg-zinc-900">
            @csrf
            @method('PUT')
            @include('manage.posts._form')
        </form>
    </div>
</x-app-layout>
