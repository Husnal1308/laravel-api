@extends('layouts.app')

@section('title', $product->exists ? 'Edit Produk' : 'Tambah Produk')

@section('content')
    @php $edit = $product->exists; @endphp

    <h2 class="mb-3">{{ $edit ? 'Edit Produk' : 'Tambah Produk' }}</h2>

    <form action="{{ $edit ? route('produk.update', $product) : route('produk.store') }}" method="POST">
        @csrf
        @if ($edit)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                   value="{{ old('nama', $product->nama) }}">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                   value="{{ old('sku', $product->sku) }}">
            @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}"
                        {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>
                        {{ $c->nama }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                   value="{{ old('harga', $product->harga) }}">
            @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                   value="{{ old('stok', $product->stok) }}">
            @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ $edit ? 'Perbarui' : 'Simpan' }}</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection