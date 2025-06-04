<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    /**
     * Función que muestra todos los ingredientes almacenados en la BD
     */
    public function index()
    {
        try {
            return Ingrediente::all();
        } catch (\Throwable $th) {
            return response()->json('Error:' . $th->getMessage(), 500);
        }
    }

    /**
     * Función que almacena nuevo ingrediente en la BD
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:ingredientes,nombre',
            'descripcion' => 'required|string|max:255',
        ]);

        $ingrediente = Ingrediente::create($validated);

        return response()->json([
            'message' => 'Ingrediente creado con éxito',
            'data'    => $ingrediente
        ], 201);
    }

}
