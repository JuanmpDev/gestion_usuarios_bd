@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-6">
        <div class="card-body">
            <div class="row">
                <div class="col-12">

                    <h2><b>CREAR ROL</b></h2><br>

                    <form action="{!!route('rols.store')!!}" method="POST">
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
                            <label for="inputName" class="col-sm-2 col-form-label">Nombre del rol</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control border rounded" name="inputName" id="inputName" placeholder="Introduzca el nombre del rol" required>
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
