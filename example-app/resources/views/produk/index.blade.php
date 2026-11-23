@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Produk</h2>
        <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>
    </div>

    {{-- Form pencarian --}}
    <form method="GET" action="{{ route('produk.index') }}" class="row g-2 mb-3">
        <div class="col">
            <input type="text" name="cari" value="{{ $cari }}" class="form-control" placeholder="Cari produk...">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->sku }}</td>
                    <td>{{ $p->category?->nama ?? '-' }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $p) }}" class="btn btn-warning btn-sm">Edit</a>

                        {{-- Hapus memakai form DELETE + konfirmasi --}}
                        <form action="{{ route('produk.destroy', $p) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            {{-- Kondisi data kosong --}}
            @if ($products->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Data produk tidak ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $products->links('pagination::bootstrap-5') }}
@endsection