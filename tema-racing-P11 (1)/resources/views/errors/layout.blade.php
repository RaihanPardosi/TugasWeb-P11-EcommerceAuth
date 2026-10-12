<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('code') | Seduh</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @include('layouts.racing-head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center px-6 font-sans antialiased bg-zinc-950 text-zinc-100">
    <main class="w-full max-w-md text-center">
        <span class="mx-auto grid h-14 w-14 place-items-center rounded-lg bg-red-600/15 text-red-500">
            @yield('icon')
        </span>
        <p class="mt-6 text-sm font-semibold tracking-widest text-red-500">@yield('code')</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight">@yield('title')</h1>
        <p class="mt-3 text-zinc-400">@yield('message')</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center rounded px-4 py-2.5 text-sm font-semibold text-white transition bg-red-600 hover:bg-red-500">Ke beranda</a>
            <a href="javascript:history.back()" class="inline-flex items-center justify-center rounded border px-4 py-2.5 text-sm font-semibold transition border-zinc-700 bg-zinc-900 text-zinc-200 hover:bg-zinc-800">Kembali</a>
        </div>
    </main>
</body>
</html>
