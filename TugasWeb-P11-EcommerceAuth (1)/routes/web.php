<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EagerDemoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagePostController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/artikel', [PublicPostController::class, 'index'])->name('posts.index');
Route::get('/artikel/{post:slug}', [PublicPostController::class, 'show'])->name('posts.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{order:order_number}', [OrderController::class, 'show'])->name('orders.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,editor'])
    ->prefix('kelola')
    ->name('manage.')
    ->group(function () {
        Route::resource('artikel', ManagePostController::class)
            ->parameters(['artikel' => 'post'])
            ->except('show');
    });

Route::middleware(['auth', 'role:admin'])
    ->prefix('kelola')
    ->name('manage.')
    ->group(function () {
        Route::get('pengguna', [ManageUserController::class, 'index'])->name('users.index');
        Route::patch('pengguna/{user}', [ManageUserController::class, 'update'])->name('users.update');
        Route::get('demo-eager', EagerDemoController::class)->name('eager');
    });

require __DIR__.'/auth.php';
