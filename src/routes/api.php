<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PelatihController;




    Route::get('/dokumentation', function () {
        return 'Dokumentasi tersedia';
    });

    Route::prefix('products')->middleware('apikey')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::get('products', [ProductController::class, 'index']);     // GET /api/products
    Route::get('products/{id}', [ProductController::class, 'show']);   // GET /api/products/{id}
    Route::post('products', [ProductController::class, 'store']);    // POST /api/products
    Route::put('products/{id}', [ProductController::class, 'update']); // PUT /api/products/{id}
    Route::delete('products/{id}', [ProductController::class, 'destroy']); // DELETE /api/products/{id}
});
    
Route::prefix('pesertas')->middleware('apikey')->group(function () {
    Route::apiResource('pesertas', PesertaController::class);
    Route::get('pesertas', [PesertaController::class, 'index']);     // GET /api/products
    Route::get('pesertas/{id}', [PesertaController::class, 'show']);   // GET /api/products/{id}
    Route::post('pesertas', [PesertaController::class, 'store']);    // POST /api/products
    Route::put('pesertas/{id}', [PesertaController::class, 'update']); // PUT /api/products/{id}
    Route::delete('pesertas/{id}', [PesertaController::class, 'destroy']); // DELETE /api/products/{id}


    Route::apiResource('pelatih', PelatihController::class);

    
    Route::post('/products/{id}/pay', [ProductController::class, 'pay']);

});

    
