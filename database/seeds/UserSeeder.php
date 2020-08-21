<?php

use App\Profession;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //$professions = DB::select('SELECT id FROM professions WHERE title =?', ['Desarrollador Back-end']);

        // $profesions = DB::table('profesions')->select('id')->take(1)->get();
        // $profession = DB::table('professions')->select('id')->first(); //nos quedamos con el primer resultado de la consulta
        // $profession = DB::table('professions')->select('id','title')->first(); //nos quedamos con el primer resultado de la consulta
        // $profession = DB::table('professions')->where(['title' => 'Desarrolador Back-end'])->first(); //nos quedamos con el primer resultado de la consulta
        
        $professionId = Profession::where('title', 'Desarrollador Back-end')->value('id'); //devuelve el campo id


        factory(User::class)->create([
            'name' => 'Daniel Carrasco',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt('laravel'),
            'profession_id' => $professionId,
            'is_admin' => true
        ]);

        factory(User::class)->create([
            'profession_id' => $professionId
        ]);

        // factory(User::class)->create();
        factory(User::class, 34)->create(); //crea 34 usuarios aleatorios

        

        // User::create([
        //     'name' => 'Pepe',
        //     'email' => 'pepe@gmail.com',
        //     'password' => bcrypt('laravel'),
        //     'profession_id' => null
        // ]);

        // DB::insert('insert into users (name, email, password, profession_id) values (?, ?, ?, ?)', ['Dayle', 'prueba@gmail.com', bcrypt('laravel2'),2]);

        // DB::delete('delete professions where title = "?"', ['Diseñador web']);

    }
}
