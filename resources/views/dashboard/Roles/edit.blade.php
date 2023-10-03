@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mt-6">
        <div class="card-body">
            <div class="row">
                <div class="col-12">

                    <h2><b>EDITAR ROL</b></h2><br>

                    <form action="{!!route('rols.update', $rol->id) !!}" method="POST">
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
                            <div class="col-sm-10">
                                <input type="text" class="form-control border rounded" id="inputId" value="{{$rol->id}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control border rounded" name="inputName" id="inputName" value="{{$rol->name}}">
                            </div>
                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="inputRol" class="col-sm-2 col-form-label">Pertenece a</label>
                            <div class="col-sm-10">
                                <ol class="list-group list-group">
                                    @foreach($rol->users as $user)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                      <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{$user->name}}</div>
                                        {{$user->email}}
                                      </div>
                                      <span class="badge bg-primary rounded-pill">ID: {{$user->id}}</span>
                                    </li>
                                    @endforeach
                                </ol>
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
