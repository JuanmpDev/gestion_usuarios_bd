<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
   /**
     * Create a new AuthController instance.
     *
     * @return void
     */
/**
 * @OA\Post(
 *     path="/api/auth/register",
 *     tags={"Authentication"},
 *     summary="Register a new user",
 *     description="Register a new user and return a token",
 *     @OA\Response(response="201", description="Usuario registrado con éxito"),
 *     @OA\Response(response="500", description="Error al registrar el usuario"),

 *     @OA\RequestBody(
 *         description="User to register",
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
*             )
*         )
*     )
*  )
*/
    public function register(Request $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', 'min:6']]);

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


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
* @OA\Post(
*    path="/api/auth/login",
*    tags={"Authentication"},
*    summary="Log in a user",
*    description="Log in a user and return a token",
*    @OA\Response(response=200, description="Usuario logueado con éxito"),
*    @OA\Response(response="401", description="Error: Unauthorized"),

*    @OA\RequestBody(
*        description="Credentials to log in",
*        required=true,
*        @OA\JsonContent(
*            type="object",
*            @OA\Property(
*                property="email",
*                type="string",
*                format="email",
*                description="The email of the user"
*            ),
*            @OA\Property(
*                property="password",
*                type="string",
*                format="password",
*                description="The password of the user"
*            )
*        )
*    )
*)
*/
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
      //  return JWTAuth::fromUser(Auth::user());
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     /**
 * @OA\Get(
 *     path="/api/auth/me",
 *     tags={"Authentication"},
 *     summary="Get the authenticated user",
 *     description="Return the authenticated user",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(response="200", description="Authenticated user"),
 *)
 */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */

     /**
 * @OA\Post(
 *     path="/api/auth/logout",
 *     tags={"Authentication"},
 *     summary="Log out the user",
 *     description="Invalidate the token and log out the user",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(response="200", description="Successfully logged out"),
 *)
 */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     /**
 * @OA\Post(
 *     path="/api/auth/refresh",
 *     tags={"Authentication"},
 *     summary="Refresh a token",
 *     description="Refresh the token for the authenticated user",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(response="200", description="Token refreshed"),
 *)
 */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }

}
