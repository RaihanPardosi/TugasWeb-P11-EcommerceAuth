<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ManagePostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('author:id,name')->latest()->paginate(10);

        return view('manage.posts.index', compact('posts'));
    }

    public function create(): View
    {
        Gate::authorize('create', Post::class);

        return view('manage.posts.create', [
            'post' => new Post(['status' => PostStatus::Draft]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', Post::class);

        $data = $this->validated($request);

        $request->user()->posts()->create([
            ...$data,
            'slug' => $this->uniqueSlug($data['title']),
            'published_at' => $data['status'] === PostStatus::Published->value ? now() : null,
        ]);

        return redirect()->route('manage.artikel.index')->with('success', 'Artikel berhasil dibuat.');
    }

    public function edit(Post $post): View
    {
        Gate::authorize('update', $post);

        return view('manage.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        Gate::authorize('update', $post);

        $data = $this->validated($request);

        $post->update([
            ...$data,
            'published_at' => $data['status'] === PostStatus::Published->value
                ? ($post->published_at ?? now())
                : null,
        ]);

        return redirect()->route('manage.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()->route('manage.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'excerpt' => ['nullable', 'string', 'max:300'],
            'body' => ['required', 'string', 'min:20'],
            'status' => ['required', Rule::enum(PostStatus::class)],
        ]);
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'artikel';
        $slug = $base;
        $counter = 2;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
