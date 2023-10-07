<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRolRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use Symfony\Component\Console\Input\Input;

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
        return view('dashboard.Roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateRolRequest $request)
    {
       Rol::create([

        'name' => $request->inputName,

       ]);

       return redirect()->route('dashboard')->with('success', 'Rol registrado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {

        return view('dashboard.Roles.edit' , compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidateRolRequest $request, Rol $rol)
    {

    $rol->name = $request->inputName;
    // Guarda los cambios en la base de datos
    $rol->save();

    // Redirige al usuario a una página de éxito
    return redirect()->route('dashboard')->with('success', 'Usuario actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        //Checker permisos
        $rol->delete();

        // Redirige al usuario a la página del panel de control después de eliminar el registro
        return redirect()->route('dashboard')->with('success', 'Rol eliminado correctamente con sus usuarios correspondientes. (CASCADE)');
    }
}
