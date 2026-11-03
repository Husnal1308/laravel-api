<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function store(Request $request)
    {
        $data = Product::create($request->all());
        return response()->json($data, 201);

         $nama = $request->input('nama');
         $harga = $request->harga;
         // Tambah field request
         $stok = $request->stok;
         $semua = $request->all();

         return response()->json([
                'nama' => 'Produk diterima',
                'data' => $semua,
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //return 'Detail product = ' . $id;
        $data = Product::find($id);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
