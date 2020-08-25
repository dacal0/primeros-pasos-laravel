@extends('layout')

@section('title', "Crear nuevo usuario")

@section('content')

    <div class="card">
        <h4 class="card-header">
            Crear Usuario
        </h4>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <h6>Por favor corrige los siguientes errores:</h6>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                            
            <form method="POST" action="{{ url('usuarios/crear') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Nombre: </label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    
                    @if ($errors->has('name'))
                        <p style="color:red;">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    
                    @if ($errors->has('email'))
                    <p style="color:red;">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña: </label>
                    <input type="password" class="form-control" name="password" id="password">
                    
                    @if ($errors->has('password'))
                    <p style="color:red;">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <br>

                <button type="submit" class="btn btn-primary">Crear usuario</button>
                <p><a href="{{ route('users.index') }}" class="btn btn-link">Regresar al listado de usuarios</a></p>

            </form>

        </div>
    </div>
    
@endsection
