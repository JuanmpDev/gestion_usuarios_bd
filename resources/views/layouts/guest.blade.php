@extends('layouts.app')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin:auto">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <label for="name">Nombre:</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{old('name')}}" required autofocus autocomplete="username" />

                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email">Email:</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{old('email')}}" required autofocus autocomplete="username" />

                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password">Contraseña</label>
                        <input id="password" class="form-control"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />
                    </div>

                    <!-- Repeating password -->
                    <div class="mt-4">
                        <label for="repeatPassword">Repita la contraseña</label>
                        <input id="repeatPassword" class="form-control"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />
                    </div>

                        <x-primary-button class="ml-3">
                            {{ __('Registrar usuario') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
