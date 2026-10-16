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
        'products' => [
            [
                'id' => 1,
                'name' => 'Kopi Arabika',
                'price' => 45000
            ],
            [
                'id' => 2,
                'name' => 'Teh Hijau',
                'price' => 25000
            ],
        ]
    ]);
});
