<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Validation\Rule;
class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        $produks = Produk::query()
            ->when($cari, function ($query, $cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('kode_produk', 'like', "%{$cari}%")
                      ->orWhere('nama_produk', 'like', "%{$cari}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('produks', 'cari'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_produk' => ['required', 'string', 'max:255', 'unique:produks,kode_produk'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'satuan' => ['required', 'string', 'max:30'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
        ]);

        Produk::create($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'kode_produk' => [
                'required', 'string', 'max:255',
                Rule::unique('produks', 'kode_produk')->ignore($produk->id),
            ],
            'nama_produk' => ['required', 'string', 'max:255'],
            'satuan' => ['required', 'string', 'max:30'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
        ]);

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->transaksis()->exists()) {
            return redirect()->route('produk.index')
                ->with('error', 'Produk tidak bisa dihapus karena sudah memiliki transaksi.');
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
