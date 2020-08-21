<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return "Home";
});

Route::get('/usuarios', 'UserController@index')
    ->name('users.index');

Route::get('/usuarios/nuevo', 'UserController@create')
    ->name('users.create');

Route::post('/usuarios/crear', 'UserController@store');

Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user', '[0-9]+') //expresion regular para controlar que solo sean numeros
    ->name('users.show');

Route::get('/usuarios/editar/{id}', 'UserController@editar')
->where('id', '[0-9]+'); //expresion regular para controlar que solo sean numeros

Route::get('saludo/{name}/{nickname?}', 'WelcomeUserController');
