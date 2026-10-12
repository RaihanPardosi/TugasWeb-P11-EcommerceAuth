<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PublicPostController extends Controller
{
    public function index(): View
    {
        $posts = Post::published()
            ->with('author:id,name')
            ->latest('published_at')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        Gate::authorize('view', $post);

        $post->load('author:id,name');

        return view('posts.show', compact('post'));
    }
}
