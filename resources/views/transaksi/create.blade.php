
@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<h3 class="mb-3">Transaksi Stok</h3>

<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Produk</label>
        <select name="produk_id" class="form-select" required>
            <option value="">Pilih produk</option>
            @foreach($produks as $produk)
                <option value="{{ $produk->id }}"
                    @selected(old('produk_id') == $produk->id)>
                    {{ $produk->kode_produk }} -
                    {{ $produk->nama_produk }}
                    (Stok: {{ $produk->stok }})
                </option>
            @endforeach
        </select>
        @error('produk_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Jenis Transaksi</label>
        <select name="jenis" class="form-select" required>
            <option value="masuk" @selected(old('jenis') === 'masuk')>
                Stok Masuk
            </option>
            <option value="keluar" @selected(old('jenis') === 'keluar')>
                Stok Keluar
            </option>
        </select>
        @error('jenis')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah" min="1"
            value="{{ old('jumlah') }}"
            class="form-control @error('jumlah') is-invalid @enderror"
            required>
        @error('jumlah')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal"
            value="{{ old('tanggal', date('Y-m-d')) }}"
            class="form-control" required>
        @error('tanggal')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control"
            rows="3">{{ old('keterangan') }}</textarea>
        @error('keterangan')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-primary">Simpan Transaksi</button>
    <a href="{{ route('transaksi.index') }}"
        class="btn btn-secondary">Kembali</a>
</form>
@endsection
