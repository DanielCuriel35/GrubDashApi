<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nac' => 'required|date',
            'username' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => [
                'required',
                'string',
                'min:10',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
            'restaurante' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nac' => $request->fecha_nac,
            'username' => $request->username,
            'localidad' => $request->localidad,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'restaurante' => $request->restaurante,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Usuario registrado correctamente',
            'user' => $user
        ], 201);
    }
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        if ($user->restaurante) {
            $user->load('restaurantes');
        }

        $userData = $user->toArray();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $userData
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario) {}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $usuario = User::findOrFail($id);

    $validated = $request->validate([
        'nombre'      => 'required|string|max:255',
        'apellido'    => 'required|string|max:255',
        'fecha_nac'   => 'required|date',
        'username'    => 'required|string|max:255|unique:usuarios,username,' . $id,
        'localidad'   => 'required|string|max:255',
        'direccion'   => 'required|string|max:255',
        'email'       => 'required|email|max:255|unique:usuarios,email,' . $id,
        'password'    => 'nullable|string|min:10',
    ]);

    // Si se incluye una nueva contraseña, hashearla
    if (!empty($validated['password'])) {
        $validated['password'] = bcrypt($validated['password']);
    } else {
        unset($validated['password']); // Evita sobreescribir con NULL
    }

    $usuario->update($validated);

    if ($usuario->restaurante) {
        $usuario->load('restaurantes'); // Carga relación si es restaurante
    }

    return response()->json([
        'message' => 'Usuario actualizado correctamente',
        'user' => $usuario
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //
    }
}
