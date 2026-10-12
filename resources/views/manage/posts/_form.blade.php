<div class="space-y-6">
    <div>
        <x-input-label for="title" value="Judul" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title)" required maxlength="150" />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="excerpt" value="Ringkasan" />
        <textarea id="excerpt" name="excerpt" rows="2" maxlength="300" class="mt-1 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-amber-700 focus:ring-amber-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">{{ old('excerpt', $post->excerpt) }}</textarea>
        <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="body" value="Isi artikel" />
        <textarea id="body" name="body" rows="14" required class="mt-1 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-amber-700 focus:ring-amber-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">{{ old('body', $post->body) }}</textarea>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pisahkan paragraf dengan satu baris kosong.</p>
        <x-input-error :messages="$errors->get('body')" class="mt-2" />
    </div>

    <div class="sm:max-w-xs">
        <x-input-label for="status" value="Status" />
        <select id="status" name="status" class="mt-1 block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-amber-700 focus:ring-amber-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
            @foreach (App\Enums\PostStatus::cases() as $status)
                <option value="{{ $status->value }}" @selected(old('status', $post->status?->value ?? 'draft') === $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>

    <div class="flex flex-wrap items-center gap-3 border-t border-gray-200 pt-6 dark:border-gray-800">
        <x-primary-button>Simpan</x-primary-button>
        <x-button-link variant="secondary" href="{{ route('manage.artikel.index') }}">Batal</x-button-link>
    </div>
</div>
