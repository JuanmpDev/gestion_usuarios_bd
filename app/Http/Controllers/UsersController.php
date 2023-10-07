<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $request->validate([
            'inputName' => 'required|max:255',
            'inputEmail' => 'required|email|unique:users,email',
            'role' => 'required|exists:rols,id',
        ]);

        // Crear el usuario con el rol asignado
        User::create([
            'name' => $request->input('inputName'),
            'rol_id' => $request->input('role'),
            'email' => $request->input('inputEmail'),
            'password' => Hash::make($request->input('inputPassword')),
        ]);

        // Redirige al usuario a una página de éxito
        return redirect()->route('dashboard')->with('success', 'Usuario creado con éxito');

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = User::find($id);
        return view('dashboard.Users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $user = User::find($id);
        $roles = Rol::all();
        return view('dashboard.Users.edit' , compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, integer $id)
    {
        // Obtén el usuario por ID
        $user = User::find($id);

        $request->validate([
            'inputName' => 'required|max:255',
            'inputEmail' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:rols,id',
        ]);

        $user->name = $request->input('inputName');
        $user->email = $request->input('inputEmail');
        $user->rol_id = $request->input('role');

    // Guarda los cambios en la base de datos
    $user->save();

    // Redirige al usuario a una página de éxito
    return redirect()->route('dashboard')->with('success', 'Usuario actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->delete();

        // Redirige al usuario a la página del panel de control después de eliminar el registro
        return redirect()->route('dashboard')->with('success', 'Usuario eliminado correctamente');
    }


}
