<?php

use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('cors')->get('/productos', [ProductoController::class, 'mostrarProductos']);
Route::middleware('cors')->post('/productos', [ProductoController::class, 'crearProducto']);
Route::middleware('cors')->get('/productos', [ProductoController::class, 'mostrarProductos']);
Route::middleware('cors')->post('/productos', [ProductoController::class, 'crearProducto']);
Route::get('/productos', [ProductoController::class, 'mostrarProductos']);
