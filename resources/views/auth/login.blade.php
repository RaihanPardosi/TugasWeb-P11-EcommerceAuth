<x-guest-layout title="Masuk">
    <h1 class="text-2xl font-bold tracking-tight">Masuk ke akun</h1>
    <p class="mt-1 text-sm text-zinc-400">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-medium hover:underline text-red-500">Daftar sekarang</a>
    </p>

    <x-auth-session-status class="mt-4 text-sm text-emerald-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="Kata sandi" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm hover:underline text-zinc-400">Lupa kata sandi?</a>
                @endif
            </div>
            <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember" class="rounded text-red-500 shadow-sm focus:ring-red-500 border-zinc-800 bg-zinc-950">
            <span class="text-sm text-zinc-400">Ingat saya</span>
        </label>

        <x-primary-button class="w-full">Masuk</x-primary-button>
    </form>
</x-guest-layout>
