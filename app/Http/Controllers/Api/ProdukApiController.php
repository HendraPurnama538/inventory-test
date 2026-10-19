<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProdukApiController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::query()
            ->when($request->filled('cari'), function ($query) use ($request) {
                $cari = $request->query('cari');

                $query->where(function ($q) use ($cari) {
                    $q->where('kode_produk', 'like', "%{$cari}%")
                      ->orWhere('nama_produk', 'like', "%{$cari}%");
                });
            })
            ->orderBy('nama_produk')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data produk berhasil diambil.',
            'data' => $produk,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_produk' => [
                'required', 'string', 'max:255',
                Rule::unique('produks', 'kode_produk'),
            ],
            'nama_produk' => ['required', 'string', 'max:255'],
            'satuan' => ['required', 'string', 'max:30'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $produk = Produk::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan.',
            'data' => $produk,
        ], 201);
    }
}