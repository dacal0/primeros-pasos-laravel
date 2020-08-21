<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Joel',
        ]);

        factory(User::class)->create([
            'name' => 'Ellie',
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Joel')
            ->assertSee('Ellie');
    }

    /** @test */
    function it_shows_a_default_message_if_there_are_no_users()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados');
    }

    /** @test */
    function it_display_the_users_details()
    {
        $user = factory(User::class)->create([
            'name' => 'Daniel Carrasco'
        ]);

        $this->get('/usuarios/'.$user->id)
            ->assertStatus(200)
            ->assertSee("Daniel Carrasco");
    }

    /** @test */
    function it_display_a_404_error_if_user_not_found() 
    {
        $this->get('/usuarios/9999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /** @test */
    function it_loads_the_new_users_page() 
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear usuario');
    }

    /** @test */
    function it_creates_a_new_user() 
    {
        $this->withoutExceptionHandling();

        $this->post('/usuarios/crear', [
            'name' => 'Daniel Carrasco',
            'email' => 'dani@gmail.com',
            'password' => '123456'
        ])->assertRedirect('usuarios');

        $this->assertCredentials([
            'name' => 'Daniel Carrasco',
            'email' => 'dani@gmail.com',
            'password' => '123456'
        ]);
    }

    /** @test */
    function the_name_is_required() 
    {
        //hacia donde nosotros enviamos la peticion
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
            'name' => '',
            'email' => 'dani@gmail.com',
            'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'email' => 'daniel@gmail.com'
        ]);

    }

    /** @test */
    function the_email_is_required() 
    {
        //hacia donde nosotros enviamos la peticion
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
            'name' => 'Daniel',
            'email' => '',
            'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());

    }

    /** @test */
    function the_password_is_required() 
    {
        //hacia donde nosotros enviamos la peticion
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
            'name' => 'Daniel',
            'email' => 'daniel@gmail.com',
            'password' => ''
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());

    }

    /** @test */
    function the_email_must_be_valid() 
    {
        //hacia donde nosotros enviamos la peticion
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
            'name' => 'Daniel',
            'email' => 'email-no-valido',
            'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());

    }

    /** @test */
    function the_email_must_be_unique() 
    {
        factory(User::class)->create([
            'email' => 'daniel@gmail.com'
        ]);

        //hacia donde nosotros enviamos la peticion
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
            'name' => 'Daniel',
            'email' => 'email-no-valido',
            'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());

    }

    /** @test */
    function the_password_must_have_six() 
    {
        //hacia donde nosotros enviamos la peticion
        $this->from('usuarios/nuevo')
            ->post('/usuarios/crear', [
            'name' => 'Daniel',
            'email' => 'email-no-valido',
            'password' => '123'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());

    }


}
