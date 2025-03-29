<?php

use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/crearProducto',[ProductoController::class,'crearProducto']);
Route::get('/mostrarProducto',[ProductoController::class,'mostrarProductos']);
Route::delete('/borrarProducto/{producto_id}',[ProductoController::class,'borrarProducto']);
Route::put('/venderProducto/{producto_id}',[ProductoController::class,'venderProducto']);