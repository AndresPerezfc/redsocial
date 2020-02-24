<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{

    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_usuarios_registrados_pueden_hacer_login()
    {
        factory(User::class)->create([
            'email' => 'andres@test.com'
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'andres@test.com')
                    ->type('password', 'secret')
                    ->press('#login-btn')
                    ->assertPathIs('/')
                    ->assertAuthenticated();
        });
    }
}
