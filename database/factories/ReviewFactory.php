<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        $rating = fake()->randomElement([3, 4, 4, 5, 5, 5, 5, 4, 2]);

        $comments = [
            2 => [
                'Rasanya kurang sesuai selera saya, agak terlalu asam.',
                'Kemasan bagus tapi hasil seduhannya biasa saja.',
            ],
            3 => [
                'Lumayan untuk harganya, tidak ada yang istimewa.',
                'Cukup oke, mungkin perlu penyesuaian cara seduh.',
            ],
            4 => [
                'Kualitas bagus dan pengiriman cepat.',
                'Sesuai deskripsi, akan beli lagi bulan depan.',
                'Aroma enak, hasil seduhan konsisten.',
            ],
            5 => [
                'Sangat puas, hasil seduhan jauh lebih enak dari yang biasa saya beli.',
                'Barang rapi dan awet, sangat direkomendasikan.',
                'Aromanya langsung terasa begitu kemasan dibuka.',
            ],
        ];

        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'rating' => $rating,
            'comment' => fake()->randomElement($comments[$rating]),
        ];
    }
}
