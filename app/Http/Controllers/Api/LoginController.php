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
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
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
