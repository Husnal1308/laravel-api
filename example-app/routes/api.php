<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

Route::resource('products', ProductsController::class);
//Latihan Mandiri & Tugas pertemuan 4
Route::resource('categories', CategoryController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return ('Halo, Laravel!');
});

Route::put('/products/{id}', [\App\Http\Controllers\ProductsController::class, 'update']);
Route::delete('/products/{id}', [\App\Http\Controllers\ProductsController::class, 'destroy']);
Route::delete('/products/{id}/force', [\App\Http\Controllers\ProductsController::class, 'forceDelete']);
Route::post('/products/{id}/restore', [\App\Http\Controllers\ProductsController::class, 'restore']);

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/me', fn (Request $r) => $r->user());
});

// Route::get('/products/{id}', function ($id) {
//     return 'Detail product #' . $id;
// });

// Route::get('/products/{id}/edit', function ($id) {
//     return 'From edit produk #' . $id;
// })->name('products.edit');

// Route::get('/products', function () {
//     return response()->json([
//             ['id' => 1,'nama' => 'Kopi Arabika','harga' => 45000],
//             ['id' => 2,'nama' => 'Teh Hijau','harga' => 25000],
//     ]);
// });

// Latihan Mandiri & Tugas pertemuan 3
// Route/about
Route::get('/about', function () {
    return 'Nama : HUSNAL KHOWATYM, NIM : 2455201002';
});

// Route/categories
Route::get('/categories', function () {
    return response()->json([
        ['id' => 1, 'nama' => 'Minuman'],
        ['id' => 2, 'nama' => 'Makanan'],
        ['id' => 3, 'nama' => 'Snack'],
    ]);
});

// Tantangan /product/{id}
Route::get('/products/{id}', function ($id) {
    $products = [
        ['id' => 1, 'nama' => 'Kopi Arabika', 'harga' => 45000],
        ['id' => 2, 'nama' => 'Teh Hijau', 'harga' => 25000],
        ['id' => 3, 'nama' => 'Snack', 'harga' => 15000]
    ];

    $product = collect($products)->firstWhere('id', (int) $id);

    // Tantangan: kode respons 404
    if (!$product) {
        return response()->json(['pesan' => 'Produk tidak ditemukan'], 404);
    }

    return response()->json($product) ;
});
