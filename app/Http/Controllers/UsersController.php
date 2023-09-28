<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $role = $request->session()->get('role');

            if ($role == 'Administrador') {

                $users = User::sortable('id')->paginate(4);
                $roles = Rol::all();
                return view ('dashboard.dashboard', compact('users', 'roles'));

            } elseif ($role == 'Usuario') {
                return view('dashboard.dashboardUser');
            }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('dashboard.Users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)


    {
        $user = User::find($id);
        return view('dashboard.Users.edit' , compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    // Obtén el usuario por ID
    $user = User::find($id);

    $request->validate([
        'inputName' => 'required|max:255',
        'inputEmail' => 'required|email',
        'inputRol' => 'required|in:Administrador,Usuario',
    ]);


    $user->name = $request->input('inputName');
    $user->email = $request->input('inputEmail');

    // Actualiza los campos del usuario
    if ($request->input('inputRol')=='Administrador'){
        $user->rol_id = '1';
    }
    elseif ($request->input('inputRol')=='Usuario') {
        $user->rol_id = '2';
    }

    else {
        return redirect()->back()->withErrors(['inputRol' => 'Rol no válido']);
    }


    // Guarda los cambios en la base de datos
    $user->save();

    // Redirige al usuario a una página de éxito
    return redirect()->route('dashboard')->with('success', 'Usuario actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        // Redirige al usuario a la página del panel de control después de eliminar el registro
        return redirect()->route('dashboard')->with('success', 'Usuario eliminado correctamente');
    }


}
