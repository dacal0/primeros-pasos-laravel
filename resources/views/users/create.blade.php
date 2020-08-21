@extends('layout')

@section('title', "Crear nuevo usuario")

@section('content')
    <h1>Crear Usuario</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <h6>Por favor corrige los siguientes errores:</h6>
        {{-- <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
    </div>
    @endif
    
    <div style="position: absolute;margin-top: 50px;">
        
        <form method="POST" action="{{ url('usuarios/crear') }}">
            {{ csrf_field() }}

            <label for="name">Nombre: </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            
            @if ($errors->has('name'))
                <p style="color:red;">{{ $errors->first('name') }}</p>
            @endif
            
            <br>
            
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            
            @if ($errors->has('email'))
            <p style="color:red;">{{ $errors->first('email') }}</p>
            @endif

            <br>
            
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
            
            @if ($errors->has('password'))
            <p style="color:red;">{{ $errors->first('password') }}</p>
            @endif
            
            <br>

            <button type="submit">Crear usuario</button>

        </form>

        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
    </div>
    
@endsection
