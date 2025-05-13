<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use App\Lecturer;
use Tests\DuskTestCase;

class LecturerAuthTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLecturerAuthentication()
    {
        $this->browse(function (Browser $browser) {
            $lecturer=Lecturer::first();
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('#username', $lecturer->username)
                    ->type('#password', 'password') //Cannot use the encrypted password stored in the database
                    ->press('Sign in')
                    //Tests to see if the lecturer option is avaliable on the navbar
                    ->assertDontSee('@lecturer-button')
                    ->visit('/lecturer/4')
                    ->assertSee('Unauthorized')
                    ->visit('/lecturer/create')
                    ->assertSee('Unauthorized')
                    ->visit('/login')
                    ->type('#username', 'badmin')
                    ->type('#password', 'password') //Cannot use the encrypted password stored in the database
                    ->press('Sign in')
                    ->visit('/lecturer')
                    ->assertSee($lecturer->name);
        });
    }
}
