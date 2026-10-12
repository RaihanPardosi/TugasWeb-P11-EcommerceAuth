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
<body class="flex min-h-screen flex-col bg-gray-50 font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100">
    @include('layouts.navigation')

    @isset($header)
        <header class="border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800/40">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="flex-1">
        @if (session('success') || session('error'))
            <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div role="status" class="flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
                        <x-icon name="check-circle" class="mt-0.5 h-5 w-5 shrink-0" />
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div role="alert" class="flex items-start gap-3 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-300">
                        <x-icon name="warning" class="mt-0.5 h-5 w-5 shrink-0" />
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="mt-16 border-t border-gray-200 dark:border-gray-800">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-6 text-sm text-gray-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8 dark:text-gray-400">
            <p>&copy; {{ date('Y') }} Seduh. Toko kopi dan alat seduh.</p>
            <p>Laravel {{ app()->version() }} &middot; PHP {{ PHP_VERSION }}</p>
        </div>
    </footer>
</body>
</html>
