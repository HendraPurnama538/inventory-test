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

