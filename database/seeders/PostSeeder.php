<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@seduh.test')->firstOrFail();
        $editor = User::where('email', 'editor@seduh.test')->firstOrFail();
        $editorTwo = User::where('email', 'editor2@seduh.test')->firstOrFail();

        $articles = [
            [$editor, 'Cara Menyeduh Kopi dengan V60 untuk Pemula', 'Takaran, suhu air, dan urutan tuang yang cukup untuk memulai seduh manual di rumah.', "Mulailah dengan perbandingan satu gram kopi untuk enam belas gram air. Untuk satu cangkir, gunakan 15 gram kopi dan 240 gram air dengan suhu sekitar 92 sampai 94 derajat Celsius.\n\nBasahi filter terlebih dahulu agar rasa kertas tidak terbawa. Tuang sedikit air untuk fase bloom selama 30 detik, lalu lanjutkan dengan penuangan melingkar secara perlahan hingga takaran habis. Total waktu seduh yang wajar adalah dua setengah sampai tiga menit.\n\nJika hasilnya terlalu asam, giling sedikit lebih halus atau naikkan suhu air. Jika terlalu pahit, lakukan sebaliknya. Ubah satu variabel setiap kali mencoba.", PostStatus::Published, 28],
            [$editor, 'Mengenal Kopi Gayo, Sidikalang, dan Mandailing', 'Tiga nama besar kopi Sumatera dan perbedaan karakter rasanya.', "Kopi Gayo tumbuh di dataran tinggi Aceh Tengah dan dikenal dengan body penuh serta rasa buah yang lembut. Banyak petani di sana memakai proses basah yang menghasilkan cangkir bersih.\n\nSidikalang berasal dari Dairi, Sumatera Utara. Rasanya cenderung manis dengan sentuhan rempah dan cokelat, sehingga mudah disukai peminum kopi susu.\n\nMandailing dari Tapanuli Selatan terkenal dengan keasaman rendah dan body yang tebal. Ketiganya sama-sama cocok diseduh manual, hanya karakternya yang berbeda.", PostStatus::Published, 21],
            [$admin, 'Panduan Memilih Grinder Manual', 'Hal yang perlu dipertimbangkan sebelum membeli grinder pertama Anda.', "Grinder adalah investasi terpenting untuk kopi di rumah. Gilingan yang seragam membuat ekstraksi lebih merata dan rasa lebih konsisten.\n\nPerhatikan jenis burr, kemudahan mengatur ukuran gilingan, dan kapasitas biji. Burr stainless biasanya lebih cepat, sedangkan burr keramik cukup tahan lama dan terjangkau.\n\nJika Anda sering bepergian, pilih model yang ringkas. Jika lebih sering menyeduh di rumah untuk beberapa orang, kapasitas yang lebih besar akan terasa manfaatnya.", PostStatus::Published, 14],
            [$editorTwo, 'Menyimpan Biji Kopi Agar Tetap Segar', 'Cahaya, udara, dan kelembapan adalah tiga hal yang perlu dijauhi.', "Biji kopi sangrai paling nikmat dalam dua sampai empat minggu setelah tanggal sangrai. Setelah itu aromanya perlahan menurun.\n\nSimpan dalam wadah kedap udara, jauh dari sinar matahari, dan hindari penyimpanan di kulkas karena kelembapan mudah masuk setiap wadah dibuka.\n\nGiling hanya sebanyak yang akan diseduh. Bubuk kopi kehilangan aroma jauh lebih cepat daripada biji utuh.", PostStatus::Published, 7],
            [$editor, 'Perbedaan Proses Natural, Washed, dan Honey', 'Cara pengolahan pasca panen memengaruhi rasa di cangkir.', "Proses washed membuang kulit buah sebelum biji dikeringkan, menghasilkan rasa bersih dengan keasaman yang jelas.\n\nProses natural mengeringkan biji bersama buahnya sehingga rasa manis dan buahnya lebih menonjol.\n\nProses honey berada di antara keduanya, menyisakan sebagian lendir buah pada biji saat dikeringkan.", PostStatus::Draft, null],
            [$editorTwo, 'Rekomendasi Peralatan Seduh untuk Dapur Kecil', 'Daftar alat minimal untuk mulai menyeduh dengan ruang yang terbatas.', "Anda tidak perlu banyak alat untuk mulai. Satu dripper, filter kertas, kettle, dan timbangan sudah cukup.\n\nTambahkan grinder manual jika ingin menggiling sendiri. Semua perlengkapan ini muat dalam satu laci dapur.", PostStatus::Draft, null],
        ];

        foreach ($articles as [$author, $title, $excerpt, $body, $status, $daysAgo]) {
            Post::create([
                'user_id' => $author->id,
                'title' => $title,
                'slug' => str($title)->slug()->toString(),
                'excerpt' => $excerpt,
                'body' => $body,
                'status' => $status,
                'published_at' => $daysAgo === null ? null : now()->subDays($daysAgo),
            ]);
        }
    }
}
