@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mt-6">
        <div class="card-body">
            <div class="row">
                <div class="col-12">

                    <h2><b>USUARIO SELECCIONADO</b></h2><br>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Fecha de creación</th>
                            <th scope="col">Fecha de modificación</th>

                        </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->rol->name}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                </tr>


                        </tbody>


                    </table>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary rounded">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

