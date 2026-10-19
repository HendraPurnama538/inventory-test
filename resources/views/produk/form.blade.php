
@php
    $p = $produk;
@endphp

@foreach([
    'kode_produk' => 'Kode Produk',
    'nama_produk' => 'Nama Produk',
    'satuan' => 'Satuan (pcs, box, dll)',
    'stok' => 'Stok Awal / Stok Saat Ini',
    'harga_satuan' => 'Harga Satuan',
] as $field => $label)
    <div class="mb-3">
        <label class="form-label">{{ $label }}</label>
        <input
            type="{{ in_array($field, ['stok', 'harga_satuan']) ? 'number' : 'text' }}"
            name="{{ $field }}"
            class="form-control @error($field) is-invalid @enderror"
            value="{{ old($field, $p ? $p->$field : '') }}"
            @if(in_array($field, ['stok', 'harga_satuan']))
                min="0" step="{{ $field === 'stok' ? '1' : '0.01' }}"
            @endif
            required
        >
        @error($field)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endforeach
