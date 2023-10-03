@extends('layouts.app')


@section('content')
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <!-- Aquí va el resto de tu contenido -->
<body>
    <h2>Lo sentimos no eres Administrador. Como usuario tienes restringido el acceso a ciertos servicios</h2>
</body>
@endsection
