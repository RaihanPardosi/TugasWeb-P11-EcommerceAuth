<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin Seduh',
            'email' => 'admin@seduh.test',
        ]);

        User::factory()->editor()->create([
            'name' => 'Editor Satu',
            'email' => 'editor@seduh.test',
        ]);

        User::factory()->editor()->create([
            'name' => 'Editor Dua',
            'email' => 'editor2@seduh.test',
        ]);

        User::factory()->create([
            'name' => 'Pelanggan Demo',
            'email' => 'user@seduh.test',
        ]);

        User::factory()->count(12)->create();
    }
}
