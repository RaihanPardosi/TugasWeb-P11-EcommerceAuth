<x-app-layout title="Kelola pengguna">
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">Kelola pengguna</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Hanya admin yang dapat mengubah peran. Peran akun sendiri tidak dapat diubah.</p>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="divide-y divide-gray-200 overflow-hidden rounded-xl border border-gray-200 bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
            @foreach ($users as $item)
                <div class="flex flex-col gap-3 p-4 lg:flex-row lg:items-center lg:justify-between">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <p class="truncate font-semibold">{{ $item->name }}</p>
                            <x-badge :tone="$item->role->tone()">{{ $item->role->label() }}</x-badge>
                        </div>
                        <p class="mt-0.5 truncate text-sm text-gray-500 dark:text-gray-400">{{ $item->email }} &middot; {{ $item->posts_count }} artikel</p>
                    </div>

                    @if ($item->is(auth()->user()))
                        <p class="text-sm text-gray-500 dark:text-gray-400">Akun Anda</p>
                    @else
                        <form method="POST" action="{{ route('manage.users.update', $item) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <label for="role-{{ $item->id }}" class="sr-only">Peran untuk {{ $item->name }}</label>
                            <select id="role-{{ $item->id }}" name="role" class="rounded-lg border-gray-300 py-2 text-sm shadow-sm focus:border-amber-700 focus:ring-amber-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                @foreach (App\Enums\Role::cases() as $role)
                                    <option value="{{ $role->value }}" @selected($item->role === $role)>{{ $role->label() }}</option>
                                @endforeach
                            </select>
                            <x-primary-button class="py-2">Simpan</x-primary-button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $users->links() }}</div>
    </div>
</x-app-layout>
