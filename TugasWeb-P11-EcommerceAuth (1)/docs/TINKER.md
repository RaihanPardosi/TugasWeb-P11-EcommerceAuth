# Dokumentasi 5 Query Tinker

Jalankan `php artisan tinker`, ketik query, lalu screenshot hasilnya. Data berasal dari `php artisan migrate:fresh --seed`.

## 1. Eager loading relasi (scope `active`)

```php
Product::active()->with(['category:id,name', 'brand:id,name'])->latest('id')->take(5)->get(['id', 'name', 'category_id', 'brand_id', 'price']);
```

Menunjukkan scope `active()` dan eager loading (3 query, bukan 11).

## 2. Kombinasi scope

```php
Product::active()->inStock()->priceBetween(50000, 150000)->orderBy('price')->take(8)->get(['name', 'price', 'stock'])->toArray();
```

## 3. Agregat relasi (hasMany)

```php
Category::withCount('products')->orderByDesc('products_count')->get()->pluck('products_count', 'name');
```

## 4. Relasi bertingkat (Order, items, product)

```php
$order = Order::with(['user:id,name', 'items.product:id,name'])->latest()->first();
$order->only(['order_number', 'status', 'total']);
$order->items->map(fn ($i) => [$i->product->name, $i->quantity, $i->subtotal]);
```

## 5. Produk terlaris (withSum)

```php
Product::withSum('orderItems', 'quantity')->orderByDesc('order_items_sum_quantity')->take(5)->get()->map(fn ($p) => [$p->name, (int) $p->order_items_sum_quantity]);
```

## Tambahan (opsional)

```php
User::where('role', 'admin')->get(['id', 'name', 'email', 'role']);
Product::withAvg('reviews', 'rating')->withCount('reviews')->having('reviews_count', '>', 0)->orderByDesc('reviews_avg_rating')->take(5)->get()->map(fn ($p) => [$p->name, round($p->reviews_avg_rating, 2), $p->reviews_count]);
Order::successful()->sum('total');
```
