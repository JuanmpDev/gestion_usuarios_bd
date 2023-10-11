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
     *      path="/api/users",
     *      security={{ "apiAuth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="List of all successful users"
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
    public function index(){

        return User::all();
    }

    /**
 * @OA\Post(
 *     path="/api/users",
 *     tags={"Users"},
 *     summary="Store a new user",
 *      security={{ "apiAuth": {} }},
 *     description="Create and store a new user in the database",
 *     @OA\Response(
 *         response=201,
 *         description="User successfully created"
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
 *         description="User to store",
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"name", "email", "password", "password_confirmation", "rol_id"},
 *             @OA\Property(
 *                 property="name",
 *                 type="string",
 *                 description="The name of the user"
 *             ),
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email",
 *                 description="The email of the user"
 *             ),
 *             @OA\Property(
 *                  property="password",
 *                  type="string",
 *                  format="password",
 *                  description="The password of the user"
 *              ),
 *             @OA\Property(
 *                  property="password_confirmation",
 *                  type="string",
 *                  format="password",
 *                  description="Password confirmation that should match the password"
 *              ),
 *             @OA\Property(
 *                 property="rol_id",
 *                 type="integer",
 *                 description="The role id of the user"
*              )
*          )
*      )
*  )
*/

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
                'message' => 'User successfully created',
                'data' => $user
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

   /** @OA\Put(
        *     path="/api/users/{id}",
        *     tags={"Users"},
        *     security={{ "apiAuth": {} }},
        *     summary="Update a specific user",
        *     description="Update a specific user in the database",
        * @OA\Response(response="201", description="User successfully modified"),
        * @OA\Response(
        *      response=404,
        *      description="Error: Not Found"
        *     ),
        * @OA\Response(response="422", description="Error: Unprocessable Content"),
        * @OA\Response(
        *      response=500,
        *      description="Error: Internal Server Error"
        *     ),
        * @OA\Response(
        *      response=401,
        *      description="Error: Unauthorized"
        *     ),

        *     @OA\Parameter(
        *         name="id",
        *         in="path",
        *         description="The id of the user to update",
        *         required=true,
        *         @OA\Schema(
        *             type="integer"
        *         )
        *     ),
        *     @OA\RequestBody(
        *         description="User to update",
        *         required=true,
        *         @OA\JsonContent(
        *             type="object",
        *             @OA\Property(
        *                 property="name",
        *                 type="string",
        *                 description="The name of the user"
        *             ),
        *             @OA\Property(
        *                 property="email",
        *                 type="string",
        *                 format="email",
        *                 description="The email of the user"
        *             ),
        *             @OA\Property(
        *                 property="rol_id",
        *                 type="integer",
        *                 description="The role id of the user"
        *             )
        *         )
        *     )
        * )
     */

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
                'message' => 'User successfully eliminated',
                'data' => $user
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
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     security={{ "apiAuth": {} }},
     *     summary="Show a specific user",
     *     description="Show a specific user",
    * @OA\Response(response="200", description="User found"),
    *     @OA\Response(
    *         response=401,
    *         description="Error: Unauthorized"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Error: Not Found"
    *     ),
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The id of the user to show",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     )
     * )
     *
     */

    public function show(User $user){
        return $user;
    }

    /**
    *@OA\Delete(
            *     path="/api/users/{id}",
            *     tags={"Users"},
            *     security={{ "apiAuth": {} }},
            *     summary="Delete a specific user",
            *      description="Delete a specific user",
            *     @OA\Response(response="200", description="User successfully eliminated "),
            *     @OA\Response(
            *         response=401,
            *         description="Error: Unauthorized"
            *    ),
            *     @OA\Response(
            *         response=404,
            *         description="Error: Not found"
            *     ),
            *     @OA\Response(
            *         response=500,
            *         description="Error: Internal Server Error"
            *     ),
            *     @OA\Parameter(
            *         name="id",
            *         in="path",
            *         description="The id of the user to delete",
            *         required=true,
            *     @OA\Schema(
            *         type="integer"
            *     )
            *    )
            *  )
            */

    public function destroy(User $user){
        return $user->delete() ? 'User deleted' : 'No user deleted';
    }
}
