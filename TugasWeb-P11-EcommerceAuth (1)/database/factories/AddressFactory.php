<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        $faker = fake('id_ID');

        return [
            'user_id' => User::factory(),
            'label' => $faker->randomElement(['Rumah', 'Kantor', 'Kos']),
            'recipient_name' => $faker->name(),
            'phone' => $faker->numerify('08##########'),
            'street' => $faker->streetAddress(),
            'city' => $faker->city(),
            'province' => $faker->state(),
            'postal_code' => $faker->numerify('2####'),
            'is_default' => false,
        ];
    }

    public function default(): static
    {
        return $this->state(fn (array $attributes) => ['is_default' => true]);
    }
}
