<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('code') | Seduh</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-gray-50 px-6 font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100">
    <main class="w-full max-w-md text-center">
        <span class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-500">
            @yield('icon')
        </span>
        <p class="mt-6 text-sm font-semibold tracking-widest text-amber-800 dark:text-amber-500">@yield('code')</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight">@yield('title')</h1>
        <p class="mt-3 text-gray-600 dark:text-gray-400">@yield('message')</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center rounded-lg bg-amber-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-700 dark:bg-amber-700 dark:hover:bg-amber-600">Ke beranda</a>
            <a href="javascript:history.back()" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">Kembali</a>
        </div>
    </main>
</body>
</html>
