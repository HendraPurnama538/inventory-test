
@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<h3 class="mb-3">Tambah Produk</h3>

<form action="{{ route('produk.store') }}" method="POST">
    @csrf
    @include('produk.form', ['produk' => null])

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
