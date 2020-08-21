@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
    <h1>Usuario #{{ $user->id }}</h1>
    
    <div style="position: absolute;margin-top: 50px;">
        <p>Nombre del usuario: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        
        {{-- <p><a href="{{ url('/usuarios/') }}">Regresar</a></p> --}}
        {{-- <p><a href="{{ action('UserController@index') }}">Regresar al listado de usuarios</a></p> <!-- otra opcion de url --> --}}
        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
    </div>
    
@endsection
