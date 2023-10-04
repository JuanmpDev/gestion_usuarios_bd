@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Actualizaciones de la Aplicación</h1>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Consistencia de la página</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Se reestructura la forma en la que determinamos si un usuario tiene un rol u otro. Se verifica por ID en vez de por nombre, así evitamos que si un Administrador cambia el nombre de un rol, no afecte al resto del sistema</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Utilización de Datatables</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Se empieza a utilizar Datatables para el filtrado de mayor a menor o viceversa en cada uno de los campos de la base de datos pero sin acudir a ella, solo desde el cliente</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Desplegables incorporados</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Se incorporan desplegables en aquellos campos de formulario que precisan de una serie de valores específicos.</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Values en lugar de placeholders</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Se reemplazan los placeholders por Values que seteen inicialmente cada campo del formulario.</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Validación de email</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Se añade la validación de email por la cual el usuario no puede poner un email ya utilizado por otro usuario.</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Label de Cerrar Sesión y Entrar</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Si el usuario está autenticado, se mostrara el botón "Cerrar sesión" pero si no lo esta. En el Login pondrá "Entrar".</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Muestra de errores</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Se incluyen mensajes de error para los usuarios no autenticados. Tanto en el acceso a la aplicación a través de un login incorrecto, como al intentar acceder a una URL sin permisos.</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h4>Visualización de campos no editables</h4>
        </div>
        <div class="card-body">
            <p class="card-text">Se añade un color de fondo gris en los campos de los formularios que no son editables.</p>
        </div>
    </div>

    <!-- Añade más actualizaciones aquí -->

</div>
@endsection

