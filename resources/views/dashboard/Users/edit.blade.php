@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-6">
        <div class="card-body">
            <div class="row">
                <div class="col-12">

                    <h2><b>EDITAR USUARIO</b></h2><br>

                    <form action="{!!route('users.update', $user->id) !!}" method="POST">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="inputId" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control border rounded" id="inputId" value="{{$user->id}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control border rounded" name="inputName" id="inputName" value="{{$user->name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-md-4">
                                <input type="text"  class="form-control border rounded" name="inputEmail"id="inputEmail" value="{{$user->email}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputRol" class="col-sm-2 col-form-label">Rol</label>
                            <div class="col-md-4">
                                <select name="role"  class="form-control border rounded">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->rol->id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <br>
                        <br>
                        <br>

                        <button type="submit" class="btn btn-info rounded">Guardar</button>


                        <a href="{{ route('dashboard') }}" class="btn btn-secondary rounded">Cancelar</a>

                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
