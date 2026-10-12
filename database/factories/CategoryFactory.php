<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Biji Kopi',
            'Alat Seduh',
            'Grinder',
            'Gelas & Cangkir',
            'Aksesori',
            'Teh & Minuman',
            'Merchandise',
            'Paket Hemat',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake('id_ID')->sentence(10),
        ];
    }
}
