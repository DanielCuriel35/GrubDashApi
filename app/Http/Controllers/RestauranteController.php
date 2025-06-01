<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return Restaurante::all();
        } catch (\Throwable $th) {
            return response()->json('Error:' . $th->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario_id'   => 'required|exists:usuarios,id',
            'nombreLocal'  => 'required|string|max:255',
            'img'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'precioMedio'  => 'required|string|max:255',
            'descripcion'  => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255'
        ]);

        $restaurante = Restaurante::create($validated);
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $rutaImagen = $request->file('img')->store('img/productos', 'public');
            $restaurante->img = $rutaImagen;
            $restaurante->save();
        }
        return response()->json([
            'message' => 'Restaurante creado con éxito',
            'data' => $restaurante
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($localidad)
    {

        try {
            $restaurantes = Restaurante::where('localidad', $localidad)->get();

            $restaurantes->transform(function ($restaurante) {
                if ($restaurante->img) {
                    $restaurante->img = asset('storage/' . $restaurante->img);
                }
                return $restaurante;
            });

            return response()->json($restaurantes);
        } catch (\Throwable $th) {
            return response()->json('Error:' . $th->getMessage(), 500);
        }
    }

    public function restUsuario($idUsuario)
    {
        try {
            $restaurantes = Restaurante::where('usuario_id', $idUsuario)->get();

            $restaurantes->transform(function ($restaurante) {
                if ($restaurante->img) {
                    $restaurante->img = asset('storage/' . $restaurante->img);
                }
                return $restaurante;
            });

            return response()->json($restaurantes);
        } catch (\Throwable $th) {
            return response()->json('Error:' . $th->getMessage(), 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $restaurante = Restaurante::findOrFail($id);

        $validated = $request->validate([
            'nombreLocal'   => 'required|string|max:255',
            'img'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'precioMedio'   => 'required|string|max:255',
            'descripcion'   => 'required|string|max:500',
            'localidad'     => 'required|string|max:255',
        ]);

         if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $rutaImagen = $request->file('img')->store('img/productos', 'public');
            $validated['img'] = $rutaImagen;
        } else {
            $validated['img'] = $restaurante->img;
        }

        $restaurante->update($validated);

        return response()->json([
            'message' => 'Restaurante actualizado correctamente',
            'restaurante' => $restaurante
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurante $restaurante)
    {
        //
    }
}
