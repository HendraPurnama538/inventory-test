<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransaksiApiController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => ['required', 'integer', 'exists:produks,id'],
            'jenis' => ['required', 'in:masuk,keluar'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal' => ['required', 'date'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $transaksi = DB::transaction(function () use ($validator) {
                $data = $validator->validated();

                $produk = Produk::whereKey($data['produk_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                if (
                    $data['jenis'] === 'keluar' &&
                    $data['jumlah'] > $produk->stok
                ) {
                    throw ValidationException::withMessages([
                        'jumlah' => [
                            'Stok tidak mencukupi. Stok tersedia: '
                            . $produk->stok,
                        ],
                    ]);
                }

                if ($data['jenis'] === 'masuk') {
                    $produk->stok += $data['jumlah'];
                } else {
                    $produk->stok -= $data['jumlah'];
                }

                $produk->save();

                return Transaksi::create($data);
            });

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan.',
                'data' => $transaksi->load('produk'),
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi gagal. Stok tidak mencukupi.',
                'errors' => $e->errors(),
            ], 422);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan.',
                'errors' => [
                    'produk_id' => ['Produk tidak ditemukan.'],
                ],
            ], 404);
        }
    }
}
