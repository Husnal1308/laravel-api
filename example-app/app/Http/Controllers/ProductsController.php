<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
            $perPage = min($request->input('per_page', 10), 50);

        $query = Product::query();
            $query->with('category');

        // cari berdasarkan nama atau sku
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // filter berdasarkan kategori (opsional)
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }

        return ProductResource::collection(
            $query->latest()->paginate($perPage)->withQueryString()
        );

       $perPage = min( 
            $request->input('per_page', 10), 50);
        return ProductResource::collection(
            Product::latest()->paginate($perPage)); 

       $data = Product::all(); // "Product" bisa disorot dengan CTRL+spasi

       return response()->json($data);

//     return response()->json([
//            ['id' => 1,'nama' => 'Kopi Arabika','harga' => 45000],
//            ['id' => 2,'nama' => 'Teh Hijau','harga' => 25000],
//     ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        { $p = Product::create($request->validated());

          $p->load('category');

          return (new ProductResource($p))
            ->response()->setStatusCode(201); }

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'sku' => 'string|min:0',
            'harga' => 'required|integer|min:0',
            'kategori' => 'string|min:0',  
            'category_id'=> 'nullable|exists:categories,id'
        ]);               
        $product = Product::create($data);
        return (new ProductResource($product))
            ->response()->setStatusCode(201);

        $data = Product::create($request->all());
        return response()->json($data, 201);

        //  $nama = $request->input('nama');
        //  $harga = $request->harga;
        //  // Tambah field request
        //  $stok = $request->stok;
        //  $semua = $request->all();

        // return response()->json([
        //        'nama' => 'Produk diterima',
        //         'data' => $semua,
        //     ], 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //return 'Detail product = ' . $id;
        $data = Product::find($id);
        if (!$data) {
          return response()->json(['pesan' => 'Produk tidak ditemukan'], 404);}
          return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

       if (!$product) {
            return response()->json(['pesan' => 'Produk tidak ditemukan'], 404);}
        $product->update($request->only(['nama', 'sku', 'harga', 'kategori']));
        
        $product->update($request->validated());
        return response()->json($product);
    }

    /**
     * Hard delete: data dihapus permanen dari tabel.
     */
    public function forceDelete(string $id)
    {
        $product = Product::withTrashed()->find($id);

        if (!$product) {
            return response()->json(['pesan' => 'Produk tidak ditemukan'], 404);
        }
        $product->forceDelete();
        return response()->json(['pesan' => 'Produk dihapus permanen (hard delete)']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $product = Product::find($id);

        if (!$product) {
            return response()->json(['pesan' => 'Produk tidak ditemukan'], 404);}
            $product->delete();
            return response()->json(['pesan' => 'Produk dihapus (soft delete)']);
    }

    /**
     * Mengembalikan produk yang sudah di-soft delete.
     */
    public function restore(string $id)
    {
        $product = Product::onlyTrashed()->find($id);

        if (!$product) {
            return response()->json(['pesan' => 'Produk tidak ditemukan di data terhapus'], 404);}
            $product->restore();
            return response()->json($product);
    }
}
