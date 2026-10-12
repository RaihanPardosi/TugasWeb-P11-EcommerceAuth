# TugasWeb-P11-EcommerceAuth

Toko kopi "Seduh" untuk Tugas Rutin 11: E-Commerce DB + Secure Auth.
Laravel 13, PHP 8.4, Laragon, Breeze (Blade), Tailwind, Alpine.

## Instalasi (Laragon Terminal)

```bash
composer create-project laravel/laravel TugasWeb-P11-EcommerceAuth
cd TugasWeb-P11-EcommerceAuth
composer require laravel/breeze --dev
php artisan breeze:install blade --dark
```

Pilih PHPUnit atau Pest (keduanya jalan). Lalu ekstrak isi zip ini ke root project dan **timpa semua file yang bentrok**.

Edit `.env`:

```env
APP_URL=http://tugasweb-p11-ecommerceauth.test
APP_FAKER_LOCALE=id_ID

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tugasweb_p11
DB_USERNAME=root
DB_PASSWORD=
```

Buat database `tugasweb_p11` (HeidiSQL / phpMyAdmin), lalu:

```bash
php artisan migrate:fresh --seed
npm install
npm run build
```

Buka `http://tugasweb-p11-ecommerceauth.test` (virtual host otomatis Laragon) atau `php artisan serve`.
Untuk development: `npm run dev`.

## Akun demo (password: `password`)

| Peran  | Email               |
|--------|---------------------|
| Admin  | admin@seduh.test    |
| Editor | editor@seduh.test   |
| Editor | editor2@seduh.test  |
| User   | user@seduh.test     |

## Peta tugas

| No | Item | Lokasi |
|----|------|--------|
| 1 | Migrations 7 tabel e-commerce + FK | `database/migrations/2026_10_11_00000{1-7}_*` |
| 2 | Seeders + factories (57 produk) | `database/seeders`, `database/factories` |
| 3 | Model, relasi, scope | `app/Models` (scope: `active`, `featured`, `inStock`, `priceBetween`, `search`, `published`, `successful`) |
| 4 | 5 query Tinker | `docs/TINKER.md` |
| 5 | Breeze login/register/logout | Breeze + `resources/views/auth` |
| 6 | Multi-role + middleware | `app/Enums/Role.php`, `app/Http/Middleware/EnsureUserHasRole.php`, alias `role` di `AppServiceProvider` |
| 7 | PostPolicy edit/delete | `app/Policies/PostPolicy.php`, `app/Http/Controllers/ManagePostController.php` |
| 8 | Route protection + testing 2 role | `routes/web.php`, `docs/TESTING.md`, `tests/Feature` |
| Bonus | Eager loading demo | `/kelola/demo-eager` (admin) |
| Bonus | Filament | bagian di bawah |

## Skema database

7 tabel e-commerce: `categories`, `brands`, `products`, `addresses`, `orders`, `order_items`, `reviews`.
Tabel pendukung: `users` (+ kolom `role`) dan `posts` (untuk PostPolicy).

| FK | Aksi saat induk dihapus |
|----|------------------------|
| products.category_id | RESTRICT (kategori berisi produk tidak bisa dihapus) |
| products.brand_id | SET NULL |
| addresses.user_id | CASCADE |
| orders.user_id | SET NULL (riwayat pesanan tetap ada) |
| orders.shipping_address_id | SET NULL |
| order_items.order_id | CASCADE |
| order_items.product_id | RESTRICT (produk bersejarah hanya bisa soft delete) |
| reviews.user_id, reviews.product_id | CASCADE |
| posts.user_id | CASCADE |

Harga disimpan sebagai integer Rupiah. `products` memakai soft delete.

## Hak akses

| Halaman | Guest | User | Editor | Admin |
|---------|:-----:|:----:|:------:|:-----:|
| Beranda, produk, artikel terbit | ya | ya | ya | ya |
| Dashboard, pesanan sendiri | - | ya | ya | ya |
| `/kelola/artikel` (daftar, tulis) | - | - | ya | ya |
| Edit/hapus artikel | - | - | milik sendiri | semua |
| `/kelola/pengguna`, `/kelola/demo-eager` | - | - | - | ya |

Role tidak ada di `$fillable`, jadi tidak bisa diisi lewat form registrasi. Semua akun baru berperan `user`.

## Menjalankan test

```bash
php artisan test
```

Test memakai SQLite in-memory (bawaan `phpunit.xml`), pastikan ekstensi `pdo_sqlite` aktif di PHP Laragon.

## Bonus: Filament admin panel

```bash
composer require filament/filament:"^5.0"
php artisan filament:install --panels
php artisan make:filament-resource Product --generate
php artisan make:filament-resource Category --generate
php artisan make:filament-resource Order --generate
```

Batasi akses panel ke admin: di `app/Models/User.php` tambahkan

```php
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }
}
```

Panel ada di `/admin`, tidak bentrok dengan route `/kelola`.
