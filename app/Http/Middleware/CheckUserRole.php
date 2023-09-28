<?php

namespace App\Http\Middleware;

use App\Models\Rol;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
        {
            if (Auth::check()) { //Chequea si el usuario esta autenticado
                $user = Auth::user();
                $rol = Rol::find($user->rol_id);
                $display_rol = $rol->name; // Utiliza Eloquent para obtener el rol del usuario
                $request->session()->put('role', $display_rol); //Almacena en una variable de sesión "role" el rol del usuario autenticado

                return $next($request);
            }

            return redirect('login');
        }



}
