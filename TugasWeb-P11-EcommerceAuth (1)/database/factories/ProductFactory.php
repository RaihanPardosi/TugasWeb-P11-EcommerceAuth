<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = sprintf(
            'Arabika %s %s %dg',
            fake()->randomElement(['Gayo', 'Sidikalang', 'Mandailing', 'Lintong', 'Kerinci', 'Toraja', 'Flores Bajawa']),
            fake()->randomElement(['Natural', 'Washed', 'Honey', 'Wine Process']),
            fake()->randomElement([200, 250, 500])
        );

        return [
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'name' => $name,
            'slug' => Str::slug($name).'-'.Str::lower(Str::random(5)),
            'sku' => 'SDH-'.fake()->unique()->numerify('######'),
            'description' => 'Biji kopi sangrai medium dengan karakter rasa seimbang, cocok untuk metode seduh manual maupun espresso.',
            'price' => fake()->numberBetween(35, 250) * 1000,
            'stock' => fake()->numberBetween(0, 120),
            'is_active' => true,
            'is_featured' => false,
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => ['is_featured' => true]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => ['is_active' => false]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => ['stock' => 0]);
    }
}
