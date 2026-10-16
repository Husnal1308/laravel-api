<?php

namespace App\Http\Controllers; // tempat penyimpanan controller

use Illuminate\Http\Request; //untuk mengambil data

class ProductController extends Controller
{
    public function index() 
    {
        return response()->json([
                [
                    'id' => 1,
                    'nama' => 'Kopi Arabika',
                    'harga' => 45000
                ],
                [
                    'id' => 2,
                    'nama' => 'Teh Hijau',
                    'harga' => 25000
                ],
            ]);
    }

    public function show($id) 
    {
        return 'Detail product #' . $id;
    }
}
