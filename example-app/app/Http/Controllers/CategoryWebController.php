<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryWebController extends Controller
{
     public function index(Request $request)
    {
        $cari = $request->input('cari');

        $categories = Category::withCount('products')   // hitung jumlah produk per kategori
            ->when($cari, fn ($q, $cari) => $q->where('nama', 'like', "%{$cari}%"))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('kategori.index', compact('categories', 'cari'));
    }
}
