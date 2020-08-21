<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    function it_welcomes_users_with_nickname()
    {
        $this->get('saludo/Daniel/dacalo')
            ->assertStatus(200)
            ->assertSee('Bienvenido Daniel, tu apodo es dacalo');
    }

    /** @test */
    function it_welcomes_users_without_nickname()
    {
        $this->get('saludo/Daniel')
            ->assertStatus(200)
            ->assertSee('Bienvenido Daniel');
    }
}
