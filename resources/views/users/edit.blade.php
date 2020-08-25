@extends('layout')

@section('title', "Editar usuario")

@section('content')
    <h1>Editar usuario</h1>

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
    
    <div style="position: absolute;margin-top: 50px;">
        
        <form method="POST" action="{{ url("usuarios/{$user->id}") }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <label for="name">Nombre: </label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
            
            <br>
            
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">

            <br>
            
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
            
            <br>

            <button type="submit">Actualizar usuario</button>

        </form>

        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
    </div>
    
@endsection
