<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ValidateRolStoreRequest;
use App\Http\Requests\Api\ValidateRolUpdateRequest;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Rol::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateRolStoreRequest $request)
    {

            try {
                // Crear el usuario con los datos validados
                $rol = Rol::create([
                    'name' => $request->name,
                ]);

                // Si todo va bien, devolver un mensaje de éxito con el objeto creado
                return response()->json([
                    'success' => true,
                    'message' => 'Rol creado con éxito',
                    'data' => $rol
                ], 201);

            } catch (\Exception $e) {
            // Si algo sale mal, devolver un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el rol',
                'error' => $e->getMessage()
            ], 500);
                }

    }


    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        return $rol;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateRolUpdateRequest $request, Rol $rol)
    {

        try {

            $rol->name = $request->name;

            // Guarda los cambios en la base de datos
            $rol->save();

            // Si todo va bien, devolver un mensaje de éxito con el objeto creado
            return response()->json([
                'success' => true,
                'message' => 'Rol modificado con éxito',
                'data' => $rol
            ], 201);

        }

        catch (\Exception $e) {
            // Si algo sale mal, devolver un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Error al modificar el rol',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        return $rol->delete() ? 'Usuario eliminado' : 'No eliminado';

    }
}
