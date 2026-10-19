<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'satuan',
        'stok',
        'harga_satuan',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
