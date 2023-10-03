@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-6">
        <div class="card-body">
            <div class="row">
                <div class="col-12">

                    <h2><b>CREAR USUARIO</b></h2><br>

                    <form action="{!!route('users.store')!!}" method="POST">
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
                        @method('POST')
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control border rounded" name="inputName" id="inputName" placeholder="Introduzca el nombre de usuario" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control border rounded" name="inputPassword" id="inputPassword" placeholder="Establezca una contraseña" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control border rounded" name="inputEmail"id="inputEmail" placeholder="Escriba un correo electrónico" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputRol" class="col-sm-2 col-form-label">Rol</label>
                            <div class="col-sm-10">
                                <select name="role"  class="form-control border rounded" required>
                                    <option value="">Seleccione un rol de usuario</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
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
