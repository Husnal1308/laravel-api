<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductWebRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    // Daftar produk + pencarian + pagination
    public function index(Request $request)
    {
        $cari = $request->input('cari');

        $products = Product::with('category')          // eager loading kategori
            ->when($cari, function ($query, $cari) {   // filter hanya jika kolom cari diisi
                $query->where(function ($q) use ($cari) {
                    $q->where('nama', 'like', "%{$cari}%")
                      ->orWhere('sku', 'like', "%{$cari}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)                             // 10 produk per halaman
            ->withQueryString();                       // kata pencarian ikut di link halaman

        return view('produk.index', compact('products', 'cari'));
    }

    // Form tambah (produk kosong)
    public function create()
    {
        return view('produk.form', [
            'product'    => new Product(),
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    // Simpan produk baru
    public function store(ProductWebRequest $request)
    {
        $data = $request->validated();
        // kolom teks lama "kategori" diisi dari nama kategori yang dipilih
        $data['kategori'] = Category::find($data['category_id'])->nama;

        Product::create($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    // Form edit (berisi data lama)
    public function edit(Product $produk)
    {
        return view('produk.form', [
            'product'    => $produk,
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    // Simpan perubahan
    public function update(ProductWebRequest $request, Product $produk)
    {
        $data = $request->validated();
        $data['kategori'] = Category::find($data['category_id'])->nama;

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus (soft delete, karena model memakai SoftDeletes)
    public function destroy(Product $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
