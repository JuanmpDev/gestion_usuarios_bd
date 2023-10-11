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

      /**
     * @OA\Get(
     *      summary="List all rols",
     *      description="List all rols",
     *      operationId="Listrols",
     *      tags={"Rols"},
     *      path="/api/rols",
     *      security={{ "apiAuth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="List of all successful roles"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Forbidden"
     *     ),
     * )
     */
    public function index()
    {
        return Rol::all();
    }

 /**
 * Store a newly created resource in storage.
 *
 * @OA\Post(
 *     path="/api/rols",
 *     tags={"Rols"},
 *     security={{ "apiAuth": {} }},
 *     summary="Store a new rol in the database",
 *     description="Store a new rol",
 *     @OA\Response(
 *         response=201,
 *         description="Rol successfully created"
 *     ),
 *     @OA\Response(
 *         response=401,
 *     description="Error: Unauthorized"
 *     ),
 *     @OA\Response(response="422", description="Error: Unprocessable Content"),
 *     @OA\Response(
 *         response=500,
 *         description="Error: Internal Server Error"
 *     ),
 *     @OA\RequestBody(
 *         description="rol to store",
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="name",
 *                 type="string",
 *                 description="The name of the rol"
 *             )
 *         )
 *     )
 *)
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
                    'message' => 'Rol successfully created',
                    'data' => $rol
                ], 201);

            } catch (\Exception $e) {
            // Si algo sale mal, devolver un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Error: Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
                }

    }


 /**
 * Display the specified resource.
 *
 * @OA\Get(
 *     path="/api/rols/{id}",
 *     tags={"Rols"},
 *     security={{ "apiAuth": {} }},
 *     summary="Show a specific rol",
 *     description="Show a specific rol",
 *     @OA\Response(response="200", description="Rol found"),
 *     @OA\Response(
 *         response=401,
 *         description="Error: Unauthorized"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Error: Not Found"
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="The id of the rol to show",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     )
 *)
 */
    public function show(Rol $rol)
    {
        return $rol;
    }

   /**
 * Update the specified resource in storage.
 *
 * @OA\Put(
 *     path="/api/rols/{id}",
 *     tags={"Rols"},
 *     security={{ "apiAuth": {} }},
 *     summary="Update a specific rol",
 *     description="Update a specific rol",
 *     @OA\Response(response="201", description="Rol successfully modified"),
 *     @OA\Response(
 *         response=404,
 *         description="Error: Not Found"
 *     ),
 *     @OA\Response(response="422", description="Error: Unprocessable Content"),
 *     @OA\Response(
 *         response=500,
 *         description="Error: Internal Server Error"
 *     ),
 *       @OA\Response(
 *         response=401,
 *         description="Error: Unauthorized"
 *     ),
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="The id of the rol to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         description="Rol to update",
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="name",
 *                 type="string",
 *                 description="The name of the rol"
 *             )
 *          )
 *      )
 *  )
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
                'message' => 'Rol successfully eliminated',
                'data' => $rol
            ], 201);

        }

        catch (\Exception $e) {
            // Si algo sale mal, devolver un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Error: Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }

    }

/**
* Remove the specified resource from storage.
*
* @OA\Delete(
*    path="/api/rols/{id}",
*    tags={"Rols"},
*    security={{ "apiAuth": {} }},
*    summary="Delete a specific rol",
*    description="Delete a specific rol",
*    @OA\Response(response="200", description="Rol successfully eliminated "),
*    @OA\Response(
*         response=401,
*         description="Error: Unauthorized"
*    ),
*    @OA\Response(
*         response=404,
*         description="Error: Not found"
*     ),
*    @OA\Response(
 *         response=500,
 *         description="Error: Internal Server Error"
 *     ),
*    @OA\Parameter(
*        name="id",
*        in="path",
*        description="The id of the rol to delete",
*        required=true,
*        @OA\Schema(
*            type="integer"
*        )
*    )
* )
*/
    public function destroy(Rol $rol)
    {
        return $rol->delete() ? 'Rol eliminado' : 'No eliminado';

    }
}
