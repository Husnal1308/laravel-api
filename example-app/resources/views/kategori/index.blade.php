@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
    <h2 class="mb-3">Daftar Kategori</h2>

    <form method="GET" action="{{ route('kategori.index') }}" class="row g-2 mb-3">
        <div class="col">
            <input type="text" name="cari" value="{{ $cari }}" class="form-control" placeholder="Cari kategori...">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jumlah Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->nama }}</td>
                    <td>{{ $c->products_count }}</td>
                </tr>
            @endforeach

            @if ($categories->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">Kategori tidak ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{ $categories->links('pagination::bootstrap-5') }}
@endsection