<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Enums\Role;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::where('stock', '>', 0)->get();
        $customers = User::where('role', Role::User->value)->get();

        foreach ($customers as $customer) {
            $addresses = Address::factory()
                ->count(2)
                ->sequence(['is_default' => true], ['is_default' => false])
                ->for($customer)
                ->create();

            $orderCount = random_int(1, 3);

            for ($i = 0; $i < $orderCount; $i++) {
                $order = Order::factory()
                    ->for($customer)
                    ->create(['shipping_address_id' => $addresses->random()->id]);

                $subtotal = 0;

                foreach ($products->random(random_int(1, 4)) as $product) {
                    $item = OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => random_int(1, 3),
                        'unit_price' => $product->price,
                    ]);

                    $subtotal += $item->subtotal;

                    $alreadyReviewed = Review::where('user_id', $customer->id)
                        ->where('product_id', $product->id)
                        ->exists();

                    if ($order->status === OrderStatus::Completed && ! $alreadyReviewed && random_int(1, 100) <= 70) {
                        Review::factory()->create([
                            'user_id' => $customer->id,
                            'product_id' => $product->id,
                        ]);
                    }
                }

                $order->update([
                    'subtotal' => $subtotal,
                    'total' => $subtotal + $order->shipping_cost,
                ]);
            }
        }
    }
}
