<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    //Función que saca todos los productos de un restaurante
    public function index($id_restaurante)
    {
        $productos = Producto::where('restaurante_id', $id_restaurante)->get();

        if ($productos->isNotEmpty()) {
            return response()->json($productos);
        } else {
            return response()->json(['error' => 'No se encontraron productos para ese restaurante'], 404);
        }
    }

    //Función que almacena un nuevo producto en la BD
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreProducto'      => 'required|string|max:255',
            'img'          => 'nullable|url',
            'precio'              => 'nullable|max:255',
            'tiempoPreparacion'   => 'nullable|string|max:255',
            'descripcion'         => 'nullable|string|max:255',
            'restaurante_id'      => 'required|exists:usuarios,id',
            'ingredientes'        => 'required|array|min:1',
            'ingredientes.*'      => 'exists:ingredientes,id',
        ]);

        $ingredientes = $validated['ingredientes'];
        unset($validated['ingredientes']);

        $producto = Producto::create($validated);
        //Bucle que añade a la tabla pivot la relacion entre productos e ingredientes
        foreach ($ingredientes as $ingrediente_id) {
            DB::table('ingrediente_productos')->insert([
                'producto_id'    => $producto->id,
                'ingrediente_id' => $ingrediente_id,
            ]);
        }

        return response()->json([
            'message' => 'Producto creado con éxito',
            'data' => [
                'id'                => $producto->id,
                'nombreProducto'    => $producto->nombreProducto,
                'img'               => $producto->img,
                'precio'            => $producto->precio,
                'tiempoPreparacion' => $producto->tiempoPreparacion,
                'descripcion'       => $producto->descripcion,
                'restaurante_id'    => $producto->restaurante_id,
            ],
        ], 201);
    }
    //Función que muestra un producto con sus ingredientes por id
    public function show($id_producto)
    {
        $producto = Producto::with('ingredientes')->findOrFail($id_producto);
        return response()->json($producto);
    }

    //Función que actualiza los datos de un producto
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'nombreProducto'    => 'required|string|max:255',
            'img'          => 'nullable|url',
            'precio'            => 'required|numeric|min:0',
            'descripcion'       => 'required|string|max:1000',
            'tiempoPreparacion' => 'required|string|max:255',
        ]);

        $producto->update($validated);

        return response()->json([
            'message' => 'Producto actualizado con éxito',
            'data'    => [
                'id'                => $producto->id,
                'nombreProducto'    => $producto->nombreProducto,
                'img'               => $producto->img,
                'precio'            => $producto->precio,
                'tiempoPreparacion' => $producto->tiempoPreparacion,
                'descripcion'       => $producto->descripcion,
                'restaurante_id'    => $producto->restaurante_id,
            ]
        ]);
    }

    //Función que borra un producto
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado correctamente']);
    }
}
