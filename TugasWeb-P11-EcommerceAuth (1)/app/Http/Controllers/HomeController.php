<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'categories' => Category::withCount(['products' => fn ($query) => $query->active()])
                ->orderBy('name')
                ->get(),
            'featured' => Product::active()
                ->featured()
                ->with(['category', 'brand'])
                ->latest('id')
                ->take(8)
                ->get(),
            'latestPosts' => Post::published()
                ->with('author:id,name')
                ->latest('published_at')
                ->take(3)
                ->get(),
            'stats' => [
                'products' => Product::active()->count(),
                'categories' => Category::count(),
                'posts' => Post::published()->count(),
            ],
        ]);
    }
}
