<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;


class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produks = [
            [
                'kode_produk' => 'BRG001',
                'nama_produk' => 'Pulpen',
                'satuan' => 'pcs',
                'stok' => 100,
                'harga_satuan' => 3000,
            ],
            [
                'kode_produk' => 'BRG002',
                'nama_produk' => 'Buku Tulis',
                'satuan' => 'pcs',
                'stok' => 50,
                'harga_satuan' => 5000,
            ],
            [
                'kode_produk' => 'BRG003',
                'nama_produk' => 'Kertas A4',
                'satuan' => 'rim',
                'stok' => 20,
                'harga_satuan' => 55000,
            ],
        ];

        foreach ($produks as $produk) {
            Produk::firstOrCreate(
                ['kode_produk' => $produk['kode_produk']],
                $produk
            );
        }
    }
}
