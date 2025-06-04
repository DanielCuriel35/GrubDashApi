<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestauranteController extends Controller
{
    public function index()
    {
        try {
            return Restaurante::all();
        } catch (\Throwable $th) {
            return response()->json('Error:' . $th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario_id'   => 'required|exists:usuarios,id',
            'nombreLocal'  => 'required|string|max:255',
            'img'          => 'nullable|url',
            'precioMedio'  => 'required|string|max:255',
            'descripcion'  => 'required|string|max:255',
            'localidad'    => 'required|string|max:255',
            'ubicacion'    => 'required|string|max:255',
        ]);

        $restaurante = Restaurante::create($validated);

        return response()->json([
            'message' => 'Restaurante creado con éxito',
            'data' => $restaurante
        ], 201);
    }


    public function show($localidad)
    {
        try {
            $restaurantes = Restaurante::whereRaw('LOWER(localidad) = ?', [strtolower($localidad)])->get();
            return response()->json($restaurantes);
        } catch (\Throwable $th) {
            return response()->json('Error:' . $th->getMessage(), 500);
        }
    }

    public function restUsuario($idUsuario)
    {
        try {
            $restaurantes = Restaurante::where('usuario_id', $idUsuario)->get();
            return response()->json($restaurantes);
        } catch (\Throwable $th) {
            return response()->json('Error:' . $th->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        $restaurante = Restaurante::findOrFail($id);

        $validated = $request->validate([
            'nombreLocal'   => 'required|string|max:255',
            'img'           => 'nullable|url',
            'precioMedio'   => 'required|string|max:255',
            'descripcion'   => 'required|string|max:500',
            'localidad'     => 'required|string|max:255',
        ]);
        $restaurante->update($validated);
        return response()->json([
            'message' => 'Restaurante actualizado correctamente',
            'restaurante' => $restaurante
        ]);
    }

    public function destroy(Restaurante $restaurante)
    {
        //
    }
}
