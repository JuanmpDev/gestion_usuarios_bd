<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;

class RolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $roles = Rol::all();

        return view ('dashboard.dashboard', compact('users', 'roles'));
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
        return redirect()->route('dashboard')->with('success', 'Se ha pulsado el botón ver');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rol = Rol::find($id);
        return view('dashboard.Roles.edit' , compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Obtén el usuario por ID
    $rol = Rol::find($id);

    $rol->name = $request->input('inputName');


    // Guarda los cambios en la base de datos
    $rol->save();

    // Redirige al usuario a una página de éxito
    return redirect()->route('dashboard')->with('success', 'Usuario actualizado con éxito');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol = Rol::find($id);
        $rol->delete();

        // Redirige al usuario a la página del panel de control después de eliminar el registro
        return redirect()->route('dashboard')->with('success', 'Rol eliminado correctamente con sus usuarios correspondientes. (CASCADE)');
    }
}
