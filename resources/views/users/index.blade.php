@extends('layout')

@section('title', 'Listado de usuarios')

@section('content')
    <h1>{{ $title }}</h1>
    
    <br>
    <ul style="position: absolute;margin-top: 50px;">
        @forelse ($users as $usuario)
            <li>
                {{ $usuario->name }}, ({{ $usuario->email }})
            
                {{-- <a href="{{ url("/usuarios/{$usuario->id}") }}">Ver detalles</a> --}}
                {{-- <a href="{{ action('UserController@show', ['id' => $usuario->id]) }}">Ver detalles</a> --}}
                <a href="{{ route('users.show', ['id' => $usuario->id]) }}">Ver detalles</a>

            </li>
        @empty
            <li>No hay usuarios registrados</li>
        @endforelse
    </ul>

@endsection
    