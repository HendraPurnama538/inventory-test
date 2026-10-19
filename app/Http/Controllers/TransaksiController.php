<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('produk')
            ->latest()
            ->paginate(10);

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $produks = Produk::orderBy('nama_produk')->get();

        return view('transaksi.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'produk_id' => ['required', 'exists:produks,id'],
            'jenis' => ['required', 'in:masuk,keluar'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal' => ['required', 'date'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($data) {
            $produk = Produk::whereKey($data['produk_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $data['jenis'] === 'keluar' &&
                $data['jumlah'] > $produk->stok
            ) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Stok tidak mencukupi. Stok tersedia: '
                        . $produk->stok,
                ]);
            }

            if ($data['jenis'] === 'masuk') {
                $produk->stok += $data['jumlah'];
            } else {
                $produk->stok -= $data['jumlah'];
            }

            $produk->save();

            Transaksi::create($data);
        });

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }
}
