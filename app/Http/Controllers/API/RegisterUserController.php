<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateRegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;

class RegisterUserController extends Controller
{
    public function store(ValidateRegisterUserRequest $request) {

        $rolUsuario = Rol::where("name","Usuario")->first();

        try {
        // Crear el usuario con los datos validados
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rol_id'=> $rolUsuario->id,
            'password' => Hash::make($request->password),

        ]);

        // Si todo va bien, devolver un mensaje de éxito con el objeto creado
        return response()->json([
            'success' => true,
            'message' => 'Usuario registrado con éxito',
            'data' => $user
        ], 201);

    } catch (\Exception $e) {
        // Si algo sale mal, devolver un mensaje de error
        return response()->json([
            'success' => false,
            'message' => 'Error al registrar el usuario',
            'error' => $e->getMessage()
        ], 500);
    }
    }
}
