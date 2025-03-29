<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function crearProducto(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|max:50|string',
                'precio' => 'required|numeric',
                'categoria' => 'required|max:50|string',
                'stock' => 'required|numeric',
                'detalle' => 'required|max:50|string',
            ]);

            $producto = new Producto();
            $producto->nombre = $request->input('nombre');
            $producto->precio = $request->input('precio');
            $producto->categoria = $request->input('categoria');
            $producto->stock = $request->input('stock');
            $producto->detalle = $request->input('detalle');
            $producto->save();

            return response()->json([
                'status' => true,
                'message' => 'Producto creado exitosamente',
                'producto' => $producto
            ],201);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al crear el producto',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function mostrarProductos()
    {
        try {
            $productos = Producto::all();
            return response()->json([
                'status' => true,
                'message' => 'Productos obtenidos exitosamente',
                'productos' => $productos
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al obtener los productos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function venderProducto(Request $request, $producto_id){
        try {
            $producto = Producto::where('id', $producto_id)
            ->where('stock','>',0)
            ->first();
            if (!$producto) {
                return response()->json([
                    'status' => false,
                    'message' => 'Producto no encontrado',
                ], 404);
            }
            $request->validate([
                'nombre' => 'required|max:50|string',
                'apellido' => 'required|max:50|string',
                'dni' => 'required|string|size:8',
                'cantidad' => 'required|integer',
            ]);

            $nombre = $request->input('nombre');
            $apellido = $request->input('apellido');
            $dni = $request->input('dni');
            $cantidad = $request->input('cantidad');
            if ($cantidad > $producto->stock) {
                return response()->json([
                    'status' => false,
                    'message' => 'No hay suficiente stock',
                ], 400);
            }

            $producto->stock = $producto->stock - $cantidad;
            $producto->save();

            return response()->json([
                'status' => true,
                'message' => 'Producto vendido exitosamente',
                'producto' => $producto,
                'data' => [
                    'cliente_nombre' => $nombre,
                    'cliente_apellido' => $apellido,
                    'cliente_dni' => $dni,
                    'cantidad_vendida' => $cantidad,
                    'precio_total' => 'S/. ' . $producto->precio * $cantidad
                ]
            ],200);
    }
        catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al vender el producto',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function borrarProducto($producto_id){
        try {
            $producto = Producto::find($producto_id);
            if (!$producto) {
                return response()->json([
                    'status' => false,
                    'message' => 'Producto no encontrado',
                ], 404);
            }
            $producto->delete();
            return response()->json([
                'status' => true,
                'message' => 'Producto borrado exitosamente',
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al borrar el producto',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
