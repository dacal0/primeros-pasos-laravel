<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        
        // $users = ['Juan','Pepe','Daniel','Antonio','Rafael'];
        // $users = DB::table('users')->get();
        $users = User::all(); //eloquent

        $title = "Listado de usuarios";

        // return view('users', [
        //     'usuarios' => $users,
        //     'title' => $title
        // ]);

        return view('users.index', compact('users','title'));

        // return view('users')
        //     ->with('usuarios', $users) 
        //     ->with('title', $title);
    }

    public function show(User $user)
    {
        $title = "Listado de usuarios";

        // $user = User::find($id);

        // if ($user === null) 
        // {
        //     return response()->view('errors.404',[],404);
        // }

        //la linea de abajo sustituye lo de arriba
        //$user = User::findOrFail($id);

        return view('users.show', compact('user', 'title'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function editar($id) 
    {
        return "Editar usuario {$id}";
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required','email','unique:users,email'],
            'password' => 'required|min:6'
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.email' => 'Por favor ingresa un email valido',
            'email.unique' => 'Error, ya exist este email',
            'password.min' => 'La contraseña debe tener minimo 6 caracteres'
        ]);

        // if (empty($data['name'])) {
        //     return redirect('usuarios/nuevo')->withErrors([
        //         'name' => 'El campo nombre es obligatorio'
        //     ]);
        // }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users.index');
    }

}
