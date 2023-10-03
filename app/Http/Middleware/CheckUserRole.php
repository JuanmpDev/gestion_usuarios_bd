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
                if(Auth::user()->rol->id == '1') {
                    return $next($request);
                }
                else {

                    return redirect()->back()->withErrors(['No tienes permisos']);
                }
            }

            return redirect('login')->withErrors(['Usuario no registrado en nuestra base de datos']);
        }



}
