
@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Produk</h3>
    <a href="{{ route('produk.create') }}" class="btn btn-primary">
        + Tambah Produk
    </a>
</div>

<form method="GET" action="{{ route('produk.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="cari" class="form-control"
               placeholder="Cari kode atau nama produk..."
               value="{{ $cari }}">
        <button class="btn btn-dark">Cari</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
            Reset
        </a>
    </div>
</form>

<div class="table-responsive">
<table class="table table-bordered table-striped bg-white align-middle">
    <thead class="table-dark">
        <tr>
            <th>Kode</th>
            <th>Nama Produk</th>
            <th>Satuan</th>
            <th>Stok</th>
            <th>Harga Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse($produks as $produk)
        <tr>
            <td>{{ $produk->kode_produk }}</td>
            <td>{{ $produk->nama_produk }}</td>
            <td>{{ $produk->satuan }}</td>
            <td>{{ $produk->stok }}</td>
            <td>Rp {{ number_format($produk->harga_satuan, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('produk.edit', $produk) }}"
                   class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('produk.destroy', $produk) }}"
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data produk.</td>
        </tr>
    @endforelse
    </tbody>
</table>
</div>

{{ $produks->links('pagination::bootstrap-5') }}
@endsection
