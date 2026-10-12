<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ($attributes->get('title') ? $attributes->get('title') . ' | ' : '') . 'Seduh' }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @include('layouts.racing-head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-zinc-950 text-zinc-100">
    <div class="grid min-h-screen lg:grid-cols-2">
        <aside class="relative hidden flex-col justify-between overflow-hidden bg-zinc-950 p-12 text-zinc-100 lg:flex">
            <div class="rc-stripes pointer-events-none absolute -right-20 top-0 h-full w-40 opacity-30" aria-hidden="true"></div>
            <div class="rc-checker absolute inset-x-0 bottom-0 h-2" aria-hidden="true"></div>

            <a href="{{ route('home') }}" class="relative flex items-center gap-2.5">
                <span class="grid h-9 w-9 place-items-center rounded-sm bg-red-600 text-white">
                    <x-icon name="flag" class="h-5 w-5" />
                </span>
                <span class="rc-display text-3xl font-extrabold tracking-wider">Seduh</span>
            </a>

            <div class="relative">
                <h2 class="max-w-md text-5xl font-extrabold leading-[0.95]">Kopi Sumatera dan alat seduh untuk dapur Anda.</h2>
                <p class="mt-4 max-w-md text-zinc-300">Masuk untuk melihat pesanan, atau kelola artikel dan pengguna sesuai peran akun Anda.</p>
            </div>

            <div class="relative">
            @if (app()->environment('local'))
                <div class="rounded-sm border border-red-600 bg-red-600/15 p-5 text-sm">
                    <p class="font-semibold text-zinc-200">Akun demo (hasil seeder)</p>
                    <dl class="mt-3 space-y-1.5 text-zinc-300">
                        <div class="flex justify-between gap-4"><dt>Admin</dt><dd class="font-mono text-xs">admin@seduh.test</dd></div>
                        <div class="flex justify-between gap-4"><dt>Editor</dt><dd class="font-mono text-xs">editor@seduh.test</dd></div>
                        <div class="flex justify-between gap-4"><dt>Editor lain</dt><dd class="font-mono text-xs">editor2@seduh.test</dd></div>
                        <div class="flex justify-between gap-4"><dt>Pengguna</dt><dd class="font-mono text-xs">user@seduh.test</dd></div>
                        <div class="flex justify-between gap-4 border-t border-red-600 pt-1.5"><dt>Kata sandi</dt><dd class="font-mono text-xs">password</dd></div>
                    </dl>
                </div>
            @else
                <p class="text-sm text-zinc-300">&copy; {{ date('Y') }} Seduh</p>
            @endif
            </div>
        </aside>

        <div class="flex flex-col justify-center px-6 py-12 sm:px-12">
            <div class="mx-auto w-full max-w-sm">
                <a href="{{ route('home') }}" class="mb-8 flex items-center gap-2.5 lg:hidden">
                    <span class="grid h-8 w-8 place-items-center rounded-sm bg-red-600 text-white">
                        <x-icon name="flag" class="h-5 w-5" />
                    </span>
                    <span class="rc-display text-2xl font-extrabold tracking-wider">Seduh</span>
                </a>

                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
