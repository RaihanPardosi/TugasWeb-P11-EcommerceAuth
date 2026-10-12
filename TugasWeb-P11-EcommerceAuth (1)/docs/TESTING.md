# Testing Route Protection (Incognito, 2 Role)

Gunakan 2 jendela berbeda supaya sesi tidak bercampur: jendela normal untuk Admin, jendela Incognito untuk User (atau Editor).
Password semua akun: `password`.

## Skenario

| # | Langkah | Hasil yang diharapkan |
|---|---------|-----------------------|
| 1 | Tanpa login, buka `/dashboard` | Redirect ke `/login` |
| 2 | Tanpa login, buka `/kelola/artikel` | Redirect ke `/login` |
| 3 | Login `user@seduh.test` (Incognito), buka `/dashboard` | Tampil, badge Pengguna |
| 4 | Sebagai user, buka `/kelola/artikel` | 403 Akses ditolak |
| 5 | Sebagai user, buka `/kelola/pengguna` | 403 Akses ditolak |
| 6 | Login `admin@seduh.test` (jendela normal), buka `/kelola/pengguna` | Tampil, bisa ubah peran |
| 7 | Sebagai admin, buka `/kelola/artikel` | Semua artikel punya tombol Edit dan Hapus |
| 8 | Login `editor@seduh.test`, buka `/kelola/artikel` | Hanya artikel miliknya yang punya Edit dan Hapus, lainnya "Hanya baca" |
| 9 | Sebagai editor, tempel URL edit artikel milik `editor2` | 403 |
| 10 | Sebagai editor, buka `/kelola/pengguna` | 403 |
| 11 | Logout lalu tekan tombol Back | Tidak bisa melihat halaman terproteksi |

Screenshot bagian 403 dan perbandingan daftar artikel antara admin dan editor.

## Test otomatis

```bash
php artisan test --filter=RoleAccessTest
php artisan test --filter=PostPolicyTest
```
