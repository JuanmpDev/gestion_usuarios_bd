@extends('layouts.app')
@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Aquí va el resto de tu contenido -->
    <div class="container">
        <div class="card mt-6">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <div class="row align-items-center">
                            <div class="col-sm-9">
                                <h2><b>USUARIOS</b></h2>
                            </div>
                            <div class="col-sm-3 text-sm-right">
                                <a href={{route('users.create')}} class="btn btn-success">Crear usuario</a>
                            </div>
                        </div>
                        <br>

                        <table class="table" id='usersTable'>
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->rol->name}}</td>
                                    <td>

                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">Ver</a>


                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"
                                           type="submit">Editar</a>


                                        <a href="{{route('users.destroy', $user->id) }}" class="btn btn-danger"
                                           onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?')">
                                          Eliminar </a>

                                    </td>
                                </tr>
                            @endforeach


                            </tbody>


                        </table>
                        <br><br>

                        <div class="row align-items-center">
                            <div class="col-sm-9">
                                <h2><b>ROLES</b></h2>
                            </div>
                            <div class="col-sm-3 text-sm-right">
                                <a href={{route('rols.create')}} class="btn btn-success">Crear rol</a>
                            </div>
                        </div>
                        <br>

                        <table class="table" id='rolsTable'>
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Pertenece a</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $rol)
                                <tr>
                                    <th scope="row">{{$rol->id}}</th>
                                    <td>{{$rol->name}}</td>
                                    <td>
                                        @foreach($rol->users as $user)
                                            {{$user->name}} <br>
                                        @endforeach
                                    </td>

                                    <td>

                                        <a href="{{ route('rols.edit', $rol->id) }}" class="btn btn-warning"
                                            type="submit">Editar</a>

                                        <form action="{{route('rols.destroy',$rol->id) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger" type="submit"
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?')">Eliminar Rol</button>

                                        </form>
                                        </td>

                                </tr>

                            @endforeach
                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
