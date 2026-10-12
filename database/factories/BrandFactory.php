<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Dolok Roastery',
            'Toba Coffee Works',
            'Gayo Mountain',
            'Hario',
            'Timemore',
            'Kalita',
            'Bialetti',
            'Melitta',
            'Origami',
            'Bukit Tea House',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
