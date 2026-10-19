
@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Transaksi</h3>
    <a href="{{ route('transaksi.create') }}"
        class="btn btn-primary">+ Tambah Transaksi</a>
</div>

<div class="table-responsive">
<table class="table table-bordered table-striped bg-white">
    <thead class="table-dark">
        <tr>
            <th>Tanggal</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->tanggal->format('d-m-Y') }}</td>
                <td>{{ $transaksi->produk->kode_produk }}</td>
                <td>{{ $transaksi->produk->nama_produk }}</td>
                <td>
                    @if($transaksi->jenis === 'masuk')
                        <span class="badge bg-success">Masuk</span>
                    @else
                        <span class="badge bg-danger">Keluar</span>
                    @endif
                </td>
                <td>{{ $transaksi->jumlah }}</td>
                <td>{{ $transaksi->keterangan ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">
                    Belum ada transaksi.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>

{{ $transaksis->links('pagination::bootstrap-5') }}
@endsection
