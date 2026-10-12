<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['Biji Kopi', 'biji-kopi', 'Biji kopi sangrai dari berbagai daerah di Sumatera dan Nusantara.'],
            ['Alat Seduh', 'alat-seduh', 'Dripper, moka pot, french press, dan filter kertas untuk seduh manual.'],
            ['Grinder', 'grinder', 'Penggiling kopi manual untuk hasil gilingan yang konsisten.'],
            ['Gelas & Cangkir', 'gelas-cangkir', 'Cangkir, mug, dan gelas untuk menyajikan kopi dan teh.'],
            ['Aksesori', 'aksesori', 'Kettle, timbangan, dan perlengkapan pendukung dapur kopi.'],
            ['Teh & Minuman', 'teh-minuman', 'Teh daun, cokelat bubuk, dan sirup pelengkap minuman.'],
        ];

        foreach ($categories as [$name, $slug, $description]) {
            Category::create([
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
            ]);
        }
    }
}
