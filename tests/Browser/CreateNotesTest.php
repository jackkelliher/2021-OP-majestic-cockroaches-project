<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateNotesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testNotes()
    {
        $this->browse(function (Browser $browser) {
             //login
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in');

             //Create a student for test notes
            $browser
                ->visit('/student/create')
                ->assertSee('Add Student')
                ->type('name', 'TestNotes')
                ->type('email', 'Notes@com')
                ->type('github', 'NotesGithub')
                ->press('Create')
                ->visit('/student')
                ->assertSee('TestNotes')
                ->assertSee('Notes@com')
                ->assertSee('NotesGithub')

                //create notes
                ->visit('/notes/create')
                ->click('#student')
                ->keys('#student', 'TestNotes')
                ->type('notes', 'TestAddNotes')
                ->press('Submit')
                ->visit('/notes')
                ->assertSee('TestAddNotes')
                ;
        });
    }
}
