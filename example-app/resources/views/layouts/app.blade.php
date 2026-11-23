<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Manajemen Produk')</title>
    {{-- Bootstrap lewat CDN (butuh internet) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand navbar-dark bg-dark mb-4">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}"
                   href="{{ route('produk.index') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}"
                   href="{{ route('kategori.index') }}">Categories</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    {{-- Tempat pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Isi halaman masuk di sini --}}
    @yield('content')
</div>

</body>
</html>