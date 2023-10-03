@if (Auth::check())
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('updates') }}">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
            </ul>
            <div class="mx-auto">
                <span class="navbar-text">Rol: {{ Auth::user()->rol->name }}</span>
            </div>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-outline-success" type="submit">Cerrar sesión de {{ Auth::user()->name }}</button>
            </form>
        </div>
    </div>
</nav>
@endif

