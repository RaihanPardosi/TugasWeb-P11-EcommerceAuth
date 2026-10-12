<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $status = fake()->randomElement(OrderStatus::cases());
        $createdAt = fake()->dateTimeBetween('-90 days', 'now');

        return [
            'user_id' => User::factory(),
            'shipping_address_id' => null,
            'order_number' => 'SDH-'.fake()->unique()->numerify('########'),
            'status' => $status,
            'subtotal' => 0,
            'shipping_cost' => fake()->randomElement([15000, 20000, 25000, 30000]),
            'total' => 0,
            'notes' => fake()->randomElement([null, null, 'Tolong dibungkus rapi.', 'Kirim di jam kerja saja.']),
            'paid_at' => in_array($status, [OrderStatus::Paid, OrderStatus::Shipped, OrderStatus::Completed], true)
                ? $createdAt
                : null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    public function status(OrderStatus $status): static
    {
        return $this->state(fn (array $attributes) => ['status' => $status]);
    }
}
