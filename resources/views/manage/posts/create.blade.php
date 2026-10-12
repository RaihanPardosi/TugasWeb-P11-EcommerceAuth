<x-app-layout title="Tulis artikel">
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">Tulis artikel</h1>
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('manage.artikel.store') }}" class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
            @csrf
            @include('manage.posts._form')
        </form>
    </div>
</x-app-layout>
