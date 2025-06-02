<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    public function index($id_restaurante)
    {
        $productos = Producto::where('restaurante_id', $id_restaurante)->get();

        $productos->transform(function ($producto) {
            $producto->img = asset('uploads/img/productos/' . basename($producto->img));
            return $producto;
        });

        if ($productos->isNotEmpty()) {
            return response()->json($productos);
        } else {
            return response()->json(['error' => 'No se encontraron productos para ese restaurante'], 404);
        }
    }

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

        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $filename = Str::uuid() . '.' . $request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(public_path('uploads/img/productos'), $filename);
            $validated['img'] = 'uploads/img/productos/' . $filename;
        }

        $producto = Producto::create($validated);

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
                'img'               => asset($producto->img),
                'precio'            => $producto->precio,
                'tiempoPreparacion' => $producto->tiempoPreparacion,
                'descripcion'       => $producto->descripcion,
                'restaurante_id'    => $producto->restaurante_id,
            ],
        ], 201);
    }

    public function show($id_producto)
    {
        $producto = Producto::with('ingredientes')->findOrFail($id_producto);
        $producto->img = asset('uploads/img/productos/' . basename($producto->img));
        return response()->json($producto);
    }

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
            $filename = Str::uuid() . '.' . $request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(public_path('uploads/img/productos'), $filename);
            $validated['img'] = 'uploads/img/productos/' . $filename;
        } else {
            $validated['img'] = $producto->img;
        }

        $producto->update($validated);

        return response()->json([
            'message' => 'Producto actualizado con éxito',
            'data'    => [
                'id'                => $producto->id,
                'nombreProducto'    => $producto->nombreProducto,
                'img'               => asset($producto->img),
                'precio'            => $producto->precio,
                'tiempoPreparacion' => $producto->tiempoPreparacion,
                'descripcion'       => $producto->descripcion,
                'restaurante_id'    => $producto->restaurante_id,
            ]
        ]);
    }

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
