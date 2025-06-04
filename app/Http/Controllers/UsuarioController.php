<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //Función que almacena los usuarios nuevos en la BD encriptando la password
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
    //Función que comprueba el logueo de el usuario y devuelve el token de sesión
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        $user->load('restaurantes');
        $userData = $user->toArray();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $userData
        ]);
    }

    //Función que actualiza los datos de un usuario
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
            'email'       => 'required|email|max:255|unique:usuarios,email,' . $id
        ]);

        $usuario->update($validated);

        if ($usuario->restaurante) {
            $usuario->load('restaurantes');
        }

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user' => $usuario
        ]);
    }
}
