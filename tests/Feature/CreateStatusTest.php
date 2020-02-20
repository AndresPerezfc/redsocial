<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DatabaseMigrations;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_los_invitados_no_pueden_crear_estados(){
        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer status']);

        $response->assertRedirect('login');
    }

    public function test_un_usuario_autenticado_puede_crear_estados(){

        $this->withoutExceptionHandLing();

        // 1 - given => teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // 2 - when => cuando hace un post request a status 
        $response = $this->postJson(route('statuses.store'), ['body' => 'Mi primer status']);
        //$response->assertSuccessful();
        $response->assertJson([
            'body' => 'Mi primer status'
        ]);

        // 3 - then => Entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer status'
            
        ]);
    }

    public function test_un_estado_requiere_un_texto(){

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => '']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
           'message', 'errors' => ['body']
        ]);
    }

    public function test_un_estado_requiere_un_minimo_de_caracteres(){

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => 'asdf']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
           'message', 'errors' => ['body']
        ]);
    }
}
