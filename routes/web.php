<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'products']);
Route::get('/detailproducts', [ProductController::class, 'detailproducts']);
Route::get('/notaproducts/{id}/{nama}', 
[ProductController::class, 'notaproducts']);


Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);
Route::put('/items', [ItemController::class, 'update']);
Route::delete('/items', [ItemController::class, 'destroy']);

Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/transactions/create', [TransactionController::class, 'create']);
Route::get('/transactions/show/{id}', [TransactionController::class, 'show']);
Route::post('/transactions', [TransactionController::class, 'store']);