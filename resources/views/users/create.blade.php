@extends('layout')

@section('title', "Crear Usuario")

@section('content')
    <h1>Crear Usuario</h1>
    
    <div style="position: absolute;margin-top: 50px;">
        
        <form method="POST" action="{{ url('usuarios/crear') }}">
            {{ csrf_field() }}

            <label for="name">Nombre: </label>
            <input type="text" name="name" id="name">
            <br>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email">
            <br>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
            <br>
            <button type="submit">Crear usuario</button>

        </form>

        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
    </div>
    
@endsection
