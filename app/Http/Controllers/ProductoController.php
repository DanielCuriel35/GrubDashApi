<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_restaurante)
    {
        $productos = Producto::where('restaurante_id', $id_restaurante)->get();

        $productos->transform(function ($producto) {
            $producto->img = asset('storage/' . $producto->img);
            return $producto;
        });

        if ($productos->isNotEmpty()) {
            return response()->json($productos);
        } else {
            return response()->json(['error' => 'No se encontraron productos para ese restaurante'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreProducto'      => 'required|string|max:255',
            'img'                 => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $rutaImagen = $request->file('img')->store('img/productos', 'public');
            $producto->img = $rutaImagen;
            $producto->save();
        }

        // Insertar relación con ingredientes
        foreach ($ingredientes as $ingrediente_id) {
            DB::table('ingrediente_productos')->insert([
                'producto_id'    => $producto->id,
                'ingrediente_id' => $ingrediente_id,
            ]);
        }

        // Devolver respuesta con URL pública para la imagen
        return response()->json([
            'message' => 'Producto creado con éxito',
            'data' => [
                'id'                => $producto->id,
                'nombreProducto'    => $producto->nombreProducto,
                'img'               => asset('storage/' . $producto->img),
                'precio'            => $producto->precio,
                'tiempoPreparacion' => $producto->tiempoPreparacion,
                'descripcion'       => $producto->descripcion,
                'restaurante_id'    => $producto->restaurante_id,
            ],
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id_producto)
    {

        $producto = Producto::with('ingredientes')->findOrFail($id_producto);
        $producto->img = asset('storage/' . $producto->img);
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'nombreProducto'    => 'required|string|max:255',
            'img'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'precio'            => 'required|numeric|min:0',
            'descripcion'       => 'required|string|max:1000',
            'tiempoPreparacion' => 'required|string|max:255',
        ]);

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $rutaImagen = $request->file('img')->store('img/productos', 'public');
            $validated['img'] = $rutaImagen;
        } else {
            $validated['img'] = $producto->img;
        }

        $producto->update($validated);

        return response()->json([
            'message' => 'Producto actualizado con éxito',
            'data'    => [
                'id'                => $producto->id,
                'nombreProducto'    => $producto->nombreProducto,
                'img'               => asset('storage/' . $producto->img),
                'precio'            => $producto->precio,
                'tiempoPreparacion' => $producto->tiempoPreparacion,
                'descripcion'       => $producto->descripcion,
                'restaurante_id'    => $producto->restaurante_id,
            ]
        ]);
    }





    /**
     * Remove the specified resource from storage.
     */
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
