<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private const SORTS = ['terbaru', 'termurah', 'termahal', 'nama'];

    public function index(Request $request): View
    {
        $term = $request->query('q');
        $term = is_string($term) ? trim($term) : '';

        $sort = $request->query('urut');
        $sort = is_string($sort) && in_array($sort, self::SORTS, true) ? $sort : 'terbaru';

        $categorySlug = $request->query('kategori');
        $category = is_string($categorySlug) ? Category::where('slug', $categorySlug)->first() : null;

        $query = Product::query()
            ->active()
            ->with(['category', 'brand'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->when($category, fn ($q) => $q->where('category_id', $category->id))
            ->when($term !== '', fn ($q) => $q->search($term));

        match ($sort) {
            'termurah' => $query->orderBy('price'),
            'termahal' => $query->orderByDesc('price'),
            'nama' => $query->orderBy('name'),
            default => $query->orderByDesc('id'),
        };

        return view('products.index', [
            'products' => $query->paginate(12)->withQueryString(),
            'categories' => Category::withCount(['products' => fn ($q) => $q->active()])->orderBy('name')->get(),
            'category' => $category,
            'term' => $term,
            'sort' => $sort,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load([
            'category',
            'brand',
            'reviews' => fn ($q) => $q->with('user:id,name')->latest()->limit(10),
        ]);
        $product->loadAvg('reviews', 'rating')->loadCount('reviews');

        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->with(['category', 'brand'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
