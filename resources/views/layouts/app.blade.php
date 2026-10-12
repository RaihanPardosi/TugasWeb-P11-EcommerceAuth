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
<body class="flex min-h-screen flex-col font-sans antialiased bg-zinc-950 text-zinc-100">
    @include('layouts.navigation')

    @isset($header)
        <header class="border-b border-zinc-800 bg-zinc-900/40">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="flex-1">
        @if (session('success') || session('error'))
            <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div role="status" class="flex items-start gap-3 rounded border p-4 text-sm border-emerald-500/30 bg-emerald-500/10 text-emerald-300">
                        <x-icon name="check-circle" class="mt-0.5 h-5 w-5 shrink-0" />
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div role="alert" class="flex items-start gap-3 rounded border p-4 text-sm border-red-500/30 bg-red-500/10 text-red-300">
                        <x-icon name="warning" class="mt-0.5 h-5 w-5 shrink-0" />
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="mt-16 border-t border-zinc-800">
        <div class="rc-checker h-2" aria-hidden="true"></div>
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-6 text-sm sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8 text-zinc-400">
            <p>&copy; {{ date('Y') }} Seduh. Toko kopi dan alat seduh.</p>
            <p>Laravel {{ app()->version() }} &middot; PHP {{ PHP_VERSION }}</p>
        </div>
    </footer>
</body>
</html>
