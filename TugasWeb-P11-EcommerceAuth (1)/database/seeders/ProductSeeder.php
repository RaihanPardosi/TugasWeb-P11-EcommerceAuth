<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');
        $brands = Brand::pluck('id', 'slug');

        foreach ($this->catalog() as $index => [$category, $brand, $name, $price, $stock, $featured, $description]) {
            Product::create([
                'category_id' => $categories[$category],
                'brand_id' => $brand ? $brands[$brand] : null,
                'name' => $name,
                'slug' => str($name)->slug()->toString(),
                'sku' => 'SDH-'.str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT),
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
                'is_active' => true,
                'is_featured' => $featured,
            ]);
        }
    }

    private function catalog(): array
    {
        return [
            ['biji-kopi', 'gayo-mountain', 'Arabika Gayo Wine Process 200g', 98000, 42, true, 'Fermentasi panjang menghasilkan rasa buah matang dan aroma wine yang jelas. Sangrai medium, cocok untuk V60 dan french press.'],
            ['biji-kopi', 'gayo-mountain', 'Arabika Gayo Natural 250g', 89000, 60, false, 'Proses natural dengan rasa manis buah kering dan body tebal. Nyaman diseduh manual maupun dengan moka pot.'],
            ['biji-kopi', 'dolok-roastery', 'Arabika Sidikalang Honey 200g', 92000, 35, true, 'Proses honey dari dataran tinggi Sidikalang dengan rasa karamel dan sedikit rempah. Sangrai medium.'],
            ['biji-kopi', 'dolok-roastery', 'Arabika Sidikalang Washed 250g', 85000, 55, false, 'Rasa bersih dengan asam lembut dan aftertaste cokelat. Cocok untuk seduhan harian.'],
            ['biji-kopi', 'toba-coffee-works', 'Arabika Lintong Nihuta 200g', 95000, 28, true, 'Karakter herbal dan cokelat gelap khas Lintong, dengan body yang penuh. Sangrai medium-dark.'],
            ['biji-kopi', 'toba-coffee-works', 'Arabika Mandailing Golden 250g', 88000, 48, false, 'Body tebal, asam rendah, dan rasa kacang panggang. Pilihan tepat untuk kopi susu.'],
            ['biji-kopi', 'toba-coffee-works', 'Arabika Sipirok Natural 200g', 90000, 22, false, 'Proses natural dengan rasa buah beri dan aroma bunga. Sangrai medium-light.'],
            ['biji-kopi', 'dolok-roastery', 'Robusta Lampung Fine 250g', 55000, 80, false, 'Robusta pilihan dengan rasa pahit yang tegas dan crema tebal untuk espresso.'],
            ['biji-kopi', 'dolok-roastery', 'Robusta Temanggung Honey 250g', 62000, 44, false, 'Robusta proses honey dengan rasa manis gula merah dan pahit yang lembut.'],
            ['biji-kopi', 'dolok-roastery', 'Blend Pagi Medan 500g', 128000, 70, true, 'Campuran arabika dan robusta untuk kopi pagi yang kuat dan tidak terlalu asam. Sangrai medium-dark.'],
            ['biji-kopi', 'dolok-roastery', 'Blend Espresso Dolok 500g', 135000, 52, false, 'Blend untuk mesin espresso dengan rasa cokelat, kacang, dan crema stabil.'],
            ['biji-kopi', 'toba-coffee-works', 'Arabika Kerinci Washed 200g', 87000, 31, false, 'Rasa jeruk manis dan teh hitam dari dataran tinggi Kerinci. Sangrai medium-light.'],
            ['biji-kopi', 'gayo-mountain', 'Arabika Flores Bajawa 200g', 96000, 26, false, 'Rasa cokelat susu dan kacang almond, body sedang dengan keasaman lembut.'],
            ['biji-kopi', 'gayo-mountain', 'Arabika Toraja Sapan 200g', 99000, 19, false, 'Aroma rempah dan kayu manis dengan body yang tebal dan aftertaste panjang.'],
            ['biji-kopi', 'gayo-mountain', 'Arabika Gayo Decaf 200g', 110000, 0, false, 'Arabika Gayo tanpa kafein dengan rasa cokelat dan karamel yang tetap terasa.'],
            ['biji-kopi', 'toba-coffee-works', 'Paket Sampler 4 x 50g', 120000, 0, false, 'Empat varian biji kopi masing-masing 50 gram untuk mencoba karakter rasa dari berbagai daerah.'],

            ['alat-seduh', 'hario', 'Hario V60 Dripper Plastik 02', 125000, 40, true, 'Dripper kerucut dengan alur spiral untuk aliran air yang merata. Muat untuk 1 sampai 4 cangkir.'],
            ['alat-seduh', 'hario', 'Hario V60 Dripper Keramik 02', 245000, 25, false, 'Versi keramik yang menahan panas lebih baik selama penyeduhan. Tersedia untuk 1 sampai 4 cangkir.'],
            ['alat-seduh', 'hario', 'Hario V60 Server 600ml', 235000, 18, false, 'Server kaca tahan panas dengan skala volume, pasangan pas untuk dripper V60 ukuran 02.'],
            ['alat-seduh', 'kalita', 'Kalita Wave 185 Dripper Stainless', 395000, 15, false, 'Dasar datar dengan tiga lubang menghasilkan ekstraksi yang lebih stabil dan mudah diulang.'],
            ['alat-seduh', 'kalita', 'Kalita Wave Filter 185 isi 100', 85000, 90, false, 'Filter kertas bergelombang khusus untuk Kalita Wave ukuran 185.'],
            ['alat-seduh', 'hario', 'Hario V60 Filter Kertas 02 isi 100', 75000, 120, false, 'Filter kertas putih untuk dripper V60 ukuran 02, isi 100 lembar.'],
            ['alat-seduh', 'melitta', 'Melitta Dripper 1x4', 140000, 33, false, 'Dripper dengan satu lubang tetes dan filter trapesium. Sederhana dan mudah digunakan.'],
            ['alat-seduh', 'bialetti', 'Bialetti Moka Express 3 Cup', 420000, 20, true, 'Moka pot aluminium klasik berkapasitas tiga cangkir kecil. Cocok untuk kompor gas dan listrik non-induksi.'],
            ['alat-seduh', 'bialetti', 'Bialetti Moka Express 6 Cup', 560000, 14, false, 'Moka pot aluminium berkapasitas enam cangkir kecil untuk dua sampai tiga orang.'],
            ['alat-seduh', 'origami', 'Origami Dripper M', 495000, 12, false, 'Dripper keramik dengan lipatan seperti kelopak yang bisa dipakai dengan filter kerucut maupun bergelombang.'],
            ['alat-seduh', 'hario', 'Hario French Press Simply 600ml', 330000, 27, false, 'French press kaca borosilikat dengan saringan stainless dan gagang tahan panas.'],
            ['alat-seduh', 'hario', 'Hario Mizudashi Cold Brew 1000ml', 195000, 36, false, 'Teko kaca dengan saringan bawaan untuk membuat cold brew sampai satu liter.'],

            ['grinder', 'timemore', 'Timemore Chestnut C3 Manual Grinder', 890000, 21, true, 'Grinder manual dengan burr stainless dan bodi aluminium. Pengaturan gilingan bisa disetel dari espresso hingga french press.'],
            ['grinder', 'timemore', 'Timemore Chestnut C2 Manual Grinder', 690000, 24, false, 'Grinder manual ringkas dengan kapasitas biji sekitar 25 gram, mudah dibawa bepergian.'],
            ['grinder', 'timemore', 'Timemore Chestnut X Manual Grinder', 1650000, 8, false, 'Grinder manual kelas atas dengan bearing ganda dan burr presisi untuk hasil gilingan yang seragam.'],
            ['grinder', 'hario', 'Hario Skerton Pro Hand Grinder', 520000, 17, false, 'Grinder manual burr keramik dengan poros stabil dan toples kaca penampung bubuk kopi.'],
            ['grinder', 'hario', 'Hario Mini-Slim Plus Hand Grinder', 420000, 29, false, 'Grinder manual berbentuk ramping dengan burr keramik, nyaman untuk satu sampai dua cangkir.'],

            ['gelas-cangkir', 'dolok-roastery', 'Cangkir Keramik Dolok 250ml', 65000, 60, false, 'Cangkir keramik glasir mengilap dengan dinding tebal yang menahan panas.'],
            ['gelas-cangkir', 'dolok-roastery', 'Mug Enamel Dolok 350ml', 78000, 45, false, 'Mug enamel ringan dan tahan benturan, pas untuk dibawa berkemah.'],
            ['gelas-cangkir', 'hario', 'Gelas Cappuccino Double Wall 250ml', 150000, 30, false, 'Gelas kaca dinding ganda yang menjaga minuman tetap panas tanpa membuat tangan kepanasan.'],
            ['gelas-cangkir', 'hario', 'Gelas Espresso Double Wall 80ml', 135000, 34, false, 'Gelas espresso dinding ganda berukuran 80 ml, bagus untuk memperlihatkan lapisan crema.'],
            ['gelas-cangkir', 'toba-coffee-works', 'Tumbler Stainless 450ml', 175000, 40, false, 'Tumbler stainless dinding ganda dengan tutup anti tumpah untuk kopi dan teh.'],
            ['gelas-cangkir', 'hario', 'Gelas Latte 300ml', 95000, 50, false, 'Gelas kaca bening berukuran 300 ml untuk latte dan es kopi susu.'],
            ['gelas-cangkir', 'origami', 'Cangkir Latte Art 200ml dengan Tatakan', 185000, 16, false, 'Cangkir berdinding miring dengan tatakan, bentuknya memudahkan membuat pola latte art.'],
            ['gelas-cangkir', 'toba-coffee-works', 'Set 2 Cangkir Keramik Tanpa Gagang', 190000, 23, false, 'Dua cangkir keramik tanpa gagang berukuran 150 ml, cocok untuk kopi hitam dan teh.'],
            ['gelas-cangkir', 'toba-coffee-works', 'Mug Toba Coffee Works 300ml', 70000, 65, false, 'Mug keramik putih dengan logo Toba Coffee Works berukuran 300 ml.'],

            ['aksesori', 'timemore', 'Timemore Fish Pour Over Kettle 600ml', 520000, 19, true, 'Kettle leher angsa stainless dengan aliran air halus untuk kontrol penuangan yang presisi.'],
            ['aksesori', 'timemore', 'Timbangan Kopi Digital 2kg', 690000, 13, false, 'Timbangan digital dengan ketelitian 0,1 gram dan pengatur waktu terintegrasi untuk seduh manual.'],
            ['aksesori', 'kalita', 'Termometer Seduh Stainless', 85000, 38, false, 'Termometer analog bersensor stainless untuk memantau suhu air sebelum diseduh.'],
            ['aksesori', 'hario', 'Canister Penyimpan Biji 300g', 150000, 32, false, 'Toples kaca dengan tutup kedap udara, memuat sekitar 300 gram biji kopi.'],
            ['aksesori', null, 'Tamper Stainless 51mm', 160000, 22, false, 'Tamper stainless dengan dasar rata dan gagang kayu, ukuran 51 mm.'],
            ['aksesori', null, 'Sikat Pembersih Grinder', 25000, 100, false, 'Sikat berbulu halus untuk membersihkan sisa bubuk kopi di burr dan saluran grinder.'],
            ['aksesori', null, 'Knock Box Silikon', 120000, 18, false, 'Wadah pembuangan ampas espresso dengan batang peredam dan alas silikon anti geser.'],
            ['aksesori', null, 'Milk Pitcher Stainless 350ml', 110000, 26, false, 'Pitcher susu stainless dengan ujung tuang runcing untuk membuat latte art.'],
            ['aksesori', null, 'Apron Barista Kanvas', 145000, 29, false, 'Apron kanvas tebal dengan dua kantong depan dan tali yang bisa disesuaikan.'],

            ['teh-minuman', 'bukit-tea-house', 'Teh Hitam Pucuk 100g', 48000, 75, false, 'Teh hitam daun utuh dengan rasa pekat dan wangi madu. Nikmat dengan atau tanpa gula.'],
            ['teh-minuman', 'bukit-tea-house', 'Teh Hijau Sencha Lokal 100g', 52000, 58, false, 'Teh hijau dengan rasa segar dan sedikit manis, diproses dari kebun dataran tinggi.'],
            ['teh-minuman', 'bukit-tea-house', 'Teh Melati 100g', 45000, 85, false, 'Teh hijau yang dicampur bunga melati kering, beraroma harum dan lembut.'],
            ['teh-minuman', 'bukit-tea-house', 'Teh Oolong Gunung 100g', 85000, 20, false, 'Oolong semi-oksidasi dengan aroma bunga dan rasa manis yang bertahan lama.'],
            ['teh-minuman', 'toba-coffee-works', 'Cokelat Bubuk Sumatera 200g', 65000, 41, false, 'Bubuk kakao tanpa gula tambahan dari biji kakao Sumatera, untuk minuman cokelat dan kue.'],
            ['teh-minuman', null, 'Sirup Gula Aren 250ml', 38000, 95, false, 'Gula aren cair dengan rasa karamel yang pas untuk kopi susu dan minuman dingin.'],
        ];
    }
}
