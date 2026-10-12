<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $data = [
            'orders' => $user->orders()->withCount('items')->latest()->take(5)->get(),
            'postStats' => null,
            'adminStats' => null,
        ];

        if ($user->hasRole('admin', 'editor')) {
            $data['postStats'] = [
                'total' => Post::count(),
                'mine' => $user->posts()->count(),
                'drafts' => Post::where('status', PostStatus::Draft->value)->count(),
            ];
        }

        if ($user->isAdmin()) {
            $data['adminStats'] = [
                'users' => User::count(),
                'products' => Product::count(),
                'orders' => Order::count(),
                'revenue' => (int) Order::successful()->sum('total'),
            ];
        }

        return view('dashboard', $data);
    }
}
