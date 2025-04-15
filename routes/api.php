<?php

use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('cors')->get('/mostrarProducto', [ProductoController::class, 'mostrarProductos']);
Route::middleware('cors')->post('/crearProducto', [ProductoController::class, 'crearProducto']);
Route::middleware('cors')->delete('/borrarProducto/{producto_id}', [ProductoController::class, 'borrarProducto']);
Route::middleware('cors')->put('/editarProducto/{producto_id}', [ProductoController::class, 'editarProducto']);

