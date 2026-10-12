<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
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
        ];

        foreach ($brands as $name) {
            Brand::create([
                'name' => $name,
                'slug' => str($name)->slug()->toString(),
            ]);
        }
    }
}
