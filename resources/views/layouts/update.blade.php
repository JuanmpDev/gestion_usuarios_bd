@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Últimas actualizaciones</h1>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Validación por requests</h4>
        </div>
        <div class="card-body">
            <p class="card-text">La validación de los campos de los formularios se establecen a través de Request y no desde el propio controlador</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Rutas resource</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Con motivo de optimizar el código, se incluyen rutas resource que crea las rutas y los accesos al controlador automáticamente</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Eliminación de 'inputs'</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Con motivo de mantener el código limpio, se quitan los inputs en la lectura de campos.</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Creación del primer endpoint 'register'</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Se crea el primer endpoint de la API llamado register por la cual, a través de una petición POST se le mandan los campos que necesita el register y devuelve mensajes de error o de éxito en formato JSON</p>
        </div>
    </div>

    <!-- Añade más actualizaciones aquí -->

</div>
@endsection

