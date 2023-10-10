<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ValidateUserStoreRequest;
use App\Http\Requests\Api\ValidateUserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @OA\Get(
     *      summary="List all users",
     *      description="List all users",
     *      operationId="ListUsers",
     *      tags={"Users"},
     *      path="/api/users/index",
     *      security={{"bearer_token":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List all scales"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Forbidden"
     *     ),
     * )
     */
    public function index(){

        return User::all();
    }

    public function store(ValidateUserStoreRequest $request)
    {

        try {
            // Crear el usuario con los datos validados
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'rol_id' => $request->rol_id,
                'password' => Hash::make($request->password),

            ]);

            // Si todo va bien, devolver un mensaje de éxito con el objeto creado
            return response()->json([
                'success' => true,
                'message' => 'Usuario creado con éxito',
                'data' => $user
            ], 201);

        } catch (\Exception $e) {
        // Si algo sale mal, devolver un mensaje de error
        return response()->json([
            'success' => false,
            'message' => 'Error al crear el usuario',
            'error' => $e->getMessage()
        ], 500);
            }

    }

    public function update(ValidateUserUpdateRequest $request, User $user)
    {

        try {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->rol_id = $request->rol_id;

            // Guarda los cambios en la base de datos
            $user->save();

            // Si todo va bien, devolver un mensaje de éxito con el objeto creado
            return response()->json([
                'success' => true,
                'message' => 'Usuario modificado con éxito',
                'data' => $user
            ], 201);

        }

        catch (\Exception $e) {
            // Si algo sale mal, devolver un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Error al modificar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function show(User $user){
        return $user;
    }

    public function destroy(User $user){
        return $user->delete() ? 'Usuario eliminado' : 'No eliminado';
    }
}
