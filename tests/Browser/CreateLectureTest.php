<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateLectureTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateLecturer()
    {
        $this->browse(function (Browser $browser) {
                 //login page
                $browser->visit('/login')
                        ->assertSee('Login')
                        ->type('#username', 'admin')
                        ->type('#password', 'aMoreSecureP@ssw0rd')
                        ->press('Sign in');

                 //test Create lecturer 
                $browser->visit('/lecturer/create')
                        ->assertSee('Add Lecturer')
                        ->type('username', 'TestUsername')
                        ->type('password', 'testpass')
                        ->type('email', 'Test@com')
                        ->type('name', 'TestName')
                        ->press('+')
                        ->visit('/lecturer')
                        ->assertSee('TestUsername')
                        ->assertSee('Test@com')
                        ->assertSee('TestName');
        });
    }
}
