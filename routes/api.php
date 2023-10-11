<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'status' => false,
        'message' => 'Hak Akse Dibatasi'
    ], 401);
})->name('login');

Route::apiResource('produk', ProdukController::class)->middleware('auth:sanctum');
Route::apiResource('transactions', TransactionController::class)->middleware('auth:sanctum');
// Route::post('produk', [ProdukController::class, 'store'])->middleware('auth:sanctum');
// Route::put('produk/{id}', [ProdukController::class, 'update'])->middleware('auth:sanctum');
// Route::delete('produk/{id}', [ProdukController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
