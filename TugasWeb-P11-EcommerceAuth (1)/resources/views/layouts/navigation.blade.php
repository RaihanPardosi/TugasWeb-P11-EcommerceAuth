@php
    $user = auth()->user();

    $links = [
        ['label' => 'Produk', 'url' => route('products.index'), 'active' => request()->routeIs('products.*')],
        ['label' => 'Artikel', 'url' => route('posts.index'), 'active' => request()->routeIs('posts.*')],
    ];

    if ($user) {
        $links[] = ['label' => 'Dashboard', 'url' => route('dashboard'), 'active' => request()->routeIs('dashboard')];
        $links[] = ['label' => 'Pesanan', 'url' => route('orders.index'), 'active' => request()->routeIs('orders.*')];
    }

    $staffLinks = [];

    if ($user && $user->hasRole('admin', 'editor')) {
        $staffLinks[] = ['label' => 'Kelola artikel', 'url' => route('manage.artikel.index'), 'icon' => 'document'];
    }

    if ($user && $user->isAdmin()) {
        $staffLinks[] = ['label' => 'Kelola pengguna', 'url' => route('manage.users.index'), 'icon' => 'users'];
        $staffLinks[] = ['label' => 'Demo eager loading', 'url' => route('manage.eager'), 'icon' => 'bolt'];
    }
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-30 border-b border-gray-200 bg-white/90 backdrop-blur dark:border-gray-800 dark:bg-gray-900/90">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <span class="grid h-8 w-8 place-items-center rounded-lg bg-amber-800 text-white">
                    <x-icon name="cup" class="h-5 w-5" />
                </span>
                <span class="text-lg font-extrabold tracking-tight">Seduh</span>
            </a>

            <div class="hidden items-center gap-1 md:flex">
                @foreach ($links as $link)
                    <a href="{{ $link['url'] }}" @if ($link['active']) aria-current="page" @endif @class([
                        'rounded-md px-3 py-2 text-sm font-medium transition',
                        'bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white' => $link['active'],
                        'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white' => ! $link['active'],
                    ])>{{ $link['label'] }}</a>
                @endforeach
            </div>
        </div>

        <div class="hidden items-center gap-3 md:flex">
            @auth
                <div class="relative" x-data="{ menu: false }" @click.outside="menu = false" @keydown.escape.window="menu = false">
                    <button type="button" @click="menu = ! menu" :aria-expanded="menu" aria-haspopup="true" class="flex items-center gap-2 rounded-lg py-1.5 pl-1.5 pr-2 transition hover:bg-gray-100 dark:hover:bg-gray-800">
                        <span class="grid h-8 w-8 place-items-center rounded-full bg-amber-100 text-sm font-bold text-amber-800 dark:bg-amber-900/40 dark:text-amber-400">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                        <span class="max-w-[10rem] truncate text-sm font-medium">{{ $user->name }}</span>
                        <x-icon name="chevron-down" class="h-4 w-4 text-gray-500" />
                    </button>

                    <div x-show="menu" style="display: none;" x-transition.opacity class="absolute right-0 mt-2 w-64 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800">
                        <div class="border-b border-gray-100 px-4 py-3 dark:border-gray-700">
                            <p class="truncate text-sm font-semibold">{{ $user->name }}</p>
                            <p class="truncate text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                            <x-badge :tone="$user->role->tone()" class="mt-2">{{ $user->role->label() }}</x-badge>
                        </div>

                        @if (count($staffLinks))
                            <div class="border-b border-gray-100 p-1.5 dark:border-gray-700">
                                @foreach ($staffLinks as $staff)
                                    <a href="{{ $staff['url'] }}" class="flex items-center gap-2.5 rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                        <x-icon :name="$staff['icon']" class="h-4 w-4 text-gray-500 dark:text-gray-400" />
                                        {{ $staff['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <div class="p-1.5">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                <x-icon name="user" class="h-4 w-4 text-gray-500 dark:text-gray-400" />
                                Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2.5 rounded-md px-3 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    <x-icon name="logout" class="h-4 w-4 text-gray-500 dark:text-gray-400" />
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Masuk</a>
                <x-button-link href="{{ route('register') }}">Daftar</x-button-link>
            @endauth
        </div>

        <button type="button" @click="open = ! open" :aria-expanded="open" aria-label="Buka menu navigasi" class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100 md:hidden dark:text-gray-300 dark:hover:bg-gray-800">
            <span x-show="! open"><x-icon name="menu" class="h-6 w-6" /></span>
            <span x-show="open" style="display: none;"><x-icon name="close" class="h-6 w-6" /></span>
        </button>
    </div>

    <div x-show="open" style="display: none;" class="border-t border-gray-200 md:hidden dark:border-gray-800">
        <div class="space-y-1 px-4 py-3">
            @foreach ($links as $link)
                <a href="{{ $link['url'] }}" @class([
                    'block rounded-md px-3 py-2 text-base font-medium',
                    'bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white' => $link['active'],
                    'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' => ! $link['active'],
                ])>{{ $link['label'] }}</a>
            @endforeach

            @foreach ($staffLinks as $staff)
                <a href="{{ $staff['url'] }}" class="flex items-center gap-2.5 rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                    <x-icon :name="$staff['icon']" class="h-5 w-5" />
                    {{ $staff['label'] }}
                </a>
            @endforeach
        </div>

        <div class="border-t border-gray-200 px-4 py-4 dark:border-gray-800">
            @auth
                <div class="mb-3 flex items-center gap-3 px-3">
                    <span class="grid h-10 w-10 place-items-center rounded-full bg-amber-100 font-bold text-amber-800 dark:bg-amber-900/40 dark:text-amber-400">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold">{{ $user->name }}</p>
                        <p class="truncate text-xs text-gray-500 dark:text-gray-400">{{ $user->email }} &middot; {{ $user->role->label() }}</p>
                    </div>
                </div>
                <div class="space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full rounded-md px-3 py-2 text-left text-base font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">Keluar</button>
                    </form>
                </div>
            @else
                <div class="grid grid-cols-2 gap-3">
                    <x-button-link variant="secondary" href="{{ route('login') }}">Masuk</x-button-link>
                    <x-button-link href="{{ route('register') }}">Daftar</x-button-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
