<?php

namespace Tests\Browser;


use Illuminate\Foundation\Testing\DatabaseMigrations;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SearchStudentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSearchStudent()
    {
        $this->browse(function (Browser $browser) {
            //login
            $browser->visit('/login')
                ->assertSee('Login')
                ->type('#username', 'admin')
                ->type('#password', 'aMoreSecureP@ssw0rd')
                ->press('Sign in');

            // Create student 1
            $browser->visit('/student/create')
            ->assertSee('Add Student')
            ->type('name', 'TestSearch1')
            ->type('email', 'Test@com')
            ->type('github', 'TestSearchGithub1')
            ->press('Create')
            ->visit('/student')
            ->assertSee('TestSearch1')
            ->assertSee('TestSearchGithub1');
            
            //Create student 2
            $browser->visit('/student/create')
            ->assertSee('Add Student')
            ->type('name', 'TestSearch2')
            ->type('email', 'Test@com')
            ->type('github', 'TestSearchGithub2')
            ->press('Create')
            ->visit('/student')
            ->assertSee('TestSearch2')
            ->assertSee('TestSearchGithub2');

            //test Search bar
            $browser->visit('/student')
                    ->type('#mySearch', 'TestSearch1')
         
                    ->assertSee('TestSearch1')
                    ->assertDontSee('Testsearch2');
        });
    }
}
