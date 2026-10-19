<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get ('/products', [ProductController::class, 'index']);
Route::get ('/products/{id}', [ProductController::class, 'show']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return ('Halo, Laravel!');
});

//Route::delete('/products/{id}', function () {});
//Route::put('/products/{id}', function () {});
//Route::post('/products', function () {});

//Route::get('/products/{id}', function ($id) {
//    return 'Detail product #' . $id;
//});

Route::get('/products/{id}/edit', function ($id) {
    return 'From edit produk #' . $id;
})->name('products.edit');

Route::get('/products', function () {
    return response()->json([
            ['id' => 1,'nama' => 'Kopi Arabika','harga' => 45000],
            ['id' => 2,'nama' => 'Teh Hijau','harga' => 25000],
    ]);
});

Route::get('/about', function () {
    return 'Nama : HUSNAL KHOWATYM, NIM : 2455201002';
});

Route::get('/categories', function () {
    return response()->json([
        ['id' => 1, 'nama' => 'Minuman'],
        ['id' => 2, 'nama' => 'Makanan'],
        ['id' => 3, 'nama' => 'Snack'],
    ]);
});

Route::get('/products/{id}', function ($id) {
    $products = [
        ['id' => 1, 'nama' => 'Kopi Arabika', 'harga' => 45000],
        ['id' => 2, 'nama' => 'Teh Hijau', 'harga' => 25000],
    ];

    $product = collect($products)->firstWhere('id', (int) $id);

    if (!$product) {
        return response()->json(['Produk tidak ditemukan'], 404);
    }

    return response()->json($product);
});
