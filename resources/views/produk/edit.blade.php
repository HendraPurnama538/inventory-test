
@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<h3 class="mb-3">Edit Produk</h3>

<form action="{{ route('produk.update', $produk) }}" method="POST">
    @csrf
    @method('PUT')
    @include('produk.form', ['produk' => $produk])

    <button class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
