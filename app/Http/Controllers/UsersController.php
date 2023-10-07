<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateUserRequest;
use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    if (Auth::check())

            if (Auth::user()->rol->id == '1') {

                $users = User::all();
                $roles = Rol::all();
                return view ('dashboard.dashboard', compact('users', 'roles'));

            } elseif (Auth::user()->rol->id == '2' || Auth::user()->rol->id == '5') {
                return view('dashboard.dashboardUser');
            }

            else {

                return redirect('login')->withErrors(['Usuario no registrado en nuestra base de datos']);
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $roles = Rol::all();
        return view('dashboard.Users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateUserRequest $request)
    {

        // Crear el usuario con el rol asignado
        User::create([
            'name' => $request->inputName,
            'rol_id' => $request->role,
            'email' => $request->inputEmail,
            'password' => Hash::make($request->inputPassword),
        ]);

        // Redirige al usuario a una página de éxito
        return redirect()->route('dashboard')->with('success', 'Usuario creado con éxito');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.Users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Rol::all();
        return view('dashboard.Users.edit' , compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateUserRequest $request, User $user)
    {

        $user->name = $request->inputName;
        $user->email = $request->inputEmail;
        $user->rol_id = $request->role;

        // Guarda los cambios en la base de datos
        $user->save();

        // Redirige al usuario a una página de éxito
        return redirect()->route('dashboard')->with('success', 'Usuario actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        // Redirige al usuario a la página del panel de control después de eliminar el registro
        return redirect()->route('dashboard')->with('success', 'Usuario eliminado correctamente');
    }


}
