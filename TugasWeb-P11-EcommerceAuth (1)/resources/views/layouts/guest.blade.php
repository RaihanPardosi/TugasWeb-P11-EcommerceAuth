<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ($attributes->get('title') ? $attributes->get('title') . ' | ' : '') . 'Seduh' }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100">
    <div class="grid min-h-screen lg:grid-cols-2">
        <aside class="hidden flex-col justify-between bg-amber-950 p-12 text-amber-50 lg:flex">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <span class="grid h-9 w-9 place-items-center rounded-lg bg-amber-700 text-white">
                    <x-icon name="cup" class="h-5 w-5" />
                </span>
                <span class="text-xl font-extrabold tracking-tight">Seduh</span>
            </a>

            <div>
                <h2 class="max-w-md text-4xl font-bold leading-tight tracking-tight">Kopi Sumatera dan alat seduh untuk dapur Anda.</h2>
                <p class="mt-4 max-w-md text-amber-200/80">Masuk untuk melihat pesanan, atau kelola artikel dan pengguna sesuai peran akun Anda.</p>
            </div>

            @if (app()->environment('local'))
                <div class="rounded-xl border border-amber-800 bg-amber-900/40 p-5 text-sm">
                    <p class="font-semibold text-amber-100">Akun demo (hasil seeder)</p>
                    <dl class="mt-3 space-y-1.5 text-amber-200/90">
                        <div class="flex justify-between gap-4"><dt>Admin</dt><dd class="font-mono text-xs">admin@seduh.test</dd></div>
                        <div class="flex justify-between gap-4"><dt>Editor</dt><dd class="font-mono text-xs">editor@seduh.test</dd></div>
                        <div class="flex justify-between gap-4"><dt>Editor lain</dt><dd class="font-mono text-xs">editor2@seduh.test</dd></div>
                        <div class="flex justify-between gap-4"><dt>Pengguna</dt><dd class="font-mono text-xs">user@seduh.test</dd></div>
                        <div class="flex justify-between gap-4 border-t border-amber-800 pt-1.5"><dt>Kata sandi</dt><dd class="font-mono text-xs">password</dd></div>
                    </dl>
                </div>
            @else
                <p class="text-sm text-amber-200/60">&copy; {{ date('Y') }} Seduh</p>
            @endif
        </aside>

        <div class="flex flex-col justify-center px-6 py-12 sm:px-12">
            <div class="mx-auto w-full max-w-sm">
                <a href="{{ route('home') }}" class="mb-8 flex items-center gap-2.5 lg:hidden">
                    <span class="grid h-8 w-8 place-items-center rounded-lg bg-amber-800 text-white">
                        <x-icon name="cup" class="h-5 w-5" />
                    </span>
                    <span class="text-lg font-extrabold tracking-tight">Seduh</span>
                </a>

                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
