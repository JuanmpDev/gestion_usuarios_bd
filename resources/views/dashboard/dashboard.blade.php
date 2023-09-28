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

                    <h2><b>USUARIOS</b></h2><br>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">@sortablelink('id' ,'ID')</th>
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
                                         <form action="{{ route('users.show', $user->id) }}" method="GET">
                                            @csrf

                                            <button class="btn btn-outline-primary" type="submit">Ver</button>
                                        </form>

                                        <form action="{{ route('users.edit', $user->id) }}" method="GET">
                                            @csrf

                                            <button class="btn btn-outline-warning" type="submit">Editar</button>
                                        </form>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?')" type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>


                    </table>
                    <div> {!! $users->links() !!} </div><br>

                    <h2><b>ROLES</b></h2><br>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">@sortablelink('id','ID')</th>
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

                                    <form action="{{ route('rols.edit', $rol->id) }}" method="GET">
                                        @csrf
                                        <button class="btn btn-outline-warning" type="submit">Editar</button>
                                    </form>

                                    <form action="{{ route('rols.destroy', $rol->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?')" type="submit">Eliminar</button>
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
