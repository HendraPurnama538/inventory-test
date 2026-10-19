<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# inventory-test

Persyaratan
1. PHP yang kompatibel dengan versi Laravel yang digunakan.
2. Composer.
3. MySQL 

Teknologi
1. Laravel 12
2. PHP 8.2.12
3. MySQL
4. Blade
5. Bootstrap

Cara Menginstall dan Menjalankan Project di local
1. jalankan xampp apache dan mysql
2. jalankan perintah ini "composer create-project laravel/laravel inventory-test" di gitbash
3. tunggu sampai penginstallan selesai
4. setelah selesai ketik "cd inventory-test"
5. lalu "php artisan serve" untuk menjalankan aplikasi tersebut
6. Buka browser dan akses = "http://127.0.0.1:8000"


Instalasi dan Menjalankan Aplikasi

1. Clone Repository
Unduh project dari repository GitHub: 
"git clone 
"cd inventory-test"

2. Install Dependencies
Jalankan perintah berikut untuk menginstal dependency project:
"composer install"

3. Konfigurasi Environment
Salin file .env.example menjadi .env.

Untuk Windows PowerShell:
Copy-Item .env.example .env

Buat application key:
"php artisan key:generate"

4. Buat Database
Buat database baru melalui MySQL atau phpMyAdmin dengan nama:
      "inventory_test"
Kemudian sesuaikan konfigurasi database pada file .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_test
DB_USERNAME=root
DB_PASSWORD=
Sesuaikan username dan password dengan konfigurasi MySQL lokal.

5. Jalankan Migration
Migration digunakan untuk membuat tabel database yang dibutuhkan aplikasi.
      "php artisan migrate"

6. Jalankan Seeder
Seeder digunakan untuk memasukkan data dummy produk ke database.
      "php artisan db:seed --class=ProdukSeeder"

8. Jalankan Aplikasi
Jalankan server pengembangan Laravel:
      "php artisan serve"
Buka browser dan akses:
      "http://127.0.0.1:8000"
REST API
Aplikasi menyediakan endpoint berikut:
  Method
  Endpoint
  Keterangan
GET
  /api/produk
Menampilkan daftar produk
GET
  /api/produk?cari=pulpen
Mencari produk berdasarkan kode atau nama
POST
  /api/produk
Menambahkan produk baru
POST
  /api/transaksi
Mencatat transaksi stok masuk atau keluar
Untuk request POST, gunakan format JSON dan header Content-Type: application/json.

Contoh Request API

Tambah Produk
Endpoint: POST /api/produk
{
  "kode_produk": "BRG004",
  "nama_produk": "Penghapus",
  "satuan": "pcs",
  "stok": 25,
  "harga_satuan": 2000
}
Transaksi Stok Masuk

Endpoint: POST /api/transaksi
{
  "produk_id": 1,
  "jenis": "masuk",
  "jumlah": 10,
  "tanggal": "2026-10-19",
  "keterangan": "Penambahan stok barang"
}
Nilai produk_id harus sesuai dengan ID produk yang tersedia di database.

Struktur Aplikasi
Project menggunakan konsep MVC (Model-View-Controller):
Models: Mengelola data produk dan transaksi.
Views: Menampilkan antarmuka aplikasi menggunakan Blade.
Controllers: Menangani request, validasi, dan logika bisnis.
Migrations: Mendefinisikan struktur tabel database.
Seeders: Menyediakan data dummy untuk pengujian.

Validasi Stok
Sistem memeriksa ketersediaan stok sebelum transaksi keluar disimpan. Apabila jumlah barang yang diminta melebihi stok tersedia, sistem menolak transaksi dan memberikan pesan error. Dengan demikian, stok produk tidak boleh menjadi negatif melalui proses transaksi.
