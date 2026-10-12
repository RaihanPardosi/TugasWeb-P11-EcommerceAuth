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

<nav x-data="{ open: false }" class="sticky top-0 z-30 border-b backdrop-blur border-zinc-800 bg-zinc-950/90">
    <div class="rc-topbar" aria-hidden="true"></div>
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <span class="grid h-8 w-8 place-items-center rounded bg-red-600 text-white">
                    <x-icon name="flag" class="h-5 w-5" />
                </span>
                <span class="rc-display text-2xl font-extrabold tracking-wider">Seduh</span>
            </a>

            <div class="hidden items-center gap-1 md:flex">
                @foreach ($links as $link)
                    <a href="{{ $link['url'] }}" @if ($link['active']) aria-current="page" @endif @class([
                        'rounded-sm px-3 py-2 text-sm font-medium transition',
                        'bg-zinc-900 text-white shadow-[inset_0_-2px_0_#e10600]' => $link['active'],
                        'text-zinc-400 hover:bg-zinc-900 hover:text-white' => ! $link['active'],
                    ])>{{ $link['label'] }}</a>
                @endforeach
            </div>
        </div>

        <div class="hidden items-center gap-3 md:flex">
            @auth
                <div class="relative" x-data="{ menu: false }" @click.outside="menu = false" @keydown.escape.window="menu = false">
                    <button type="button" @click="menu = ! menu" :aria-expanded="menu" aria-haspopup="true" class="flex items-center gap-2 rounded py-1.5 pl-1.5 pr-2 transition hover:bg-zinc-900">
                        <span class="grid h-8 w-8 place-items-center rounded-full text-sm font-bold bg-red-600/15 text-red-400">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                        <span class="max-w-[10rem] truncate text-sm font-medium">{{ $user->name }}</span>
                        <x-icon name="chevron-down" class="h-4 w-4 text-zinc-400" />
                    </button>

                    <div x-show="menu" style="display: none;" x-transition.opacity class="absolute right-0 mt-2 w-64 overflow-hidden rounded-md border shadow-lg border-zinc-800 bg-zinc-900">
                        <div class="border-b px-4 py-3 border-zinc-800">
                            <p class="truncate text-sm font-semibold">{{ $user->name }}</p>
                            <p class="truncate text-xs text-zinc-400">{{ $user->email }}</p>
                            <x-badge :tone="$user->role->tone()" class="mt-2">{{ $user->role->label() }}</x-badge>
                        </div>

                        @if (count($staffLinks))
                            <div class="border-b p-1.5 border-zinc-800">
                                @foreach ($staffLinks as $staff)
                                    <a href="{{ $staff['url'] }}" class="flex items-center gap-2.5 rounded-sm px-3 py-2 text-sm text-zinc-200 hover:bg-zinc-800">
                                        <x-icon :name="$staff['icon']" class="h-4 w-4 text-zinc-400" />
                                        {{ $staff['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <div class="p-1.5">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 rounded-sm px-3 py-2 text-sm text-zinc-200 hover:bg-zinc-800">
                                <x-icon name="user" class="h-4 w-4 text-zinc-400" />
                                Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2.5 rounded-sm px-3 py-2 text-left text-sm text-zinc-200 hover:bg-zinc-800">
                                    <x-icon name="logout" class="h-4 w-4 text-zinc-400" />
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="rounded-sm px-3 py-2 text-sm font-medium text-zinc-400 hover:text-white">Masuk</a>
                <x-button-link href="{{ route('register') }}">Daftar</x-button-link>
            @endauth
        </div>

        <button type="button" @click="open = ! open" :aria-expanded="open" aria-label="Buka menu navigasi" class="inline-flex h-10 w-10 items-center justify-center rounded md:hidden text-zinc-300 hover:bg-zinc-900">
            <span x-show="! open"><x-icon name="menu" class="h-6 w-6" /></span>
            <span x-show="open" style="display: none;"><x-icon name="close" class="h-6 w-6" /></span>
        </button>
    </div>

    <div x-show="open" style="display: none;" class="border-t md:hidden border-zinc-800">
        <div class="space-y-1 px-4 py-3">
            @foreach ($links as $link)
                <a href="{{ $link['url'] }}" @class([
                    'block rounded-sm px-3 py-2 text-base font-medium',
                    'bg-zinc-900 text-white shadow-[inset_0_-2px_0_#e10600]' => $link['active'],
                    'text-zinc-300 hover:bg-zinc-900' => ! $link['active'],
                ])>{{ $link['label'] }}</a>
            @endforeach

            @foreach ($staffLinks as $staff)
                <a href="{{ $staff['url'] }}" class="flex items-center gap-2.5 rounded-sm px-3 py-2 text-base font-medium text-zinc-300 hover:bg-zinc-900">
                    <x-icon :name="$staff['icon']" class="h-5 w-5" />
                    {{ $staff['label'] }}
                </a>
            @endforeach
        </div>

        <div class="border-t px-4 py-4 border-zinc-800">
            @auth
                <div class="mb-3 flex items-center gap-3 px-3">
                    <span class="grid h-10 w-10 place-items-center rounded-full font-bold bg-red-600/15 text-red-400">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold">{{ $user->name }}</p>
                        <p class="truncate text-xs text-zinc-400">{{ $user->email }} &middot; {{ $user->role->label() }}</p>
                    </div>
                </div>
                <div class="space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block rounded-sm px-3 py-2 text-base font-medium text-zinc-300 hover:bg-zinc-900">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full rounded-sm px-3 py-2 text-left text-base font-medium text-zinc-300 hover:bg-zinc-900">Keluar</button>
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
