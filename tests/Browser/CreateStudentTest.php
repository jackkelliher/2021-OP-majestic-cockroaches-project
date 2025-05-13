<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class CreateStudentTest extends DuskTestCase


{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateStudent()
    {
        $this->browse(function (Browser $browser) {
             //login
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in');


            //test Create student 
            $browser->visit('/student/create')
                ->assertSee('Add Student')
                ->type('name', 'Test')
                ->type('email', 'Test@com')
                ->type('github', 'TestGithub')
                ->press('Create')
                ->visit('/student')
                ->assertSee('Test')
                ->assertSee('Test@com')
                ->assertSee('TestGithub');
        });
    }
}
