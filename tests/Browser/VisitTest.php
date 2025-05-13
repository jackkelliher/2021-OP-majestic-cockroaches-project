<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VisitTest extends DuskTestCase
{
    /**
     * @return void
     */

    //login the page
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Login')
                ->type('#username', 'admin')
                ->type('#password', 'aMoreSecureP@ssw0rd')
                ->press('Sign in');
        });
    }

    //test home page
    public function testHome()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Welcome');
        });
    }

    //test add student page
    public function testAddStudent()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/student/create')
                ->assertSee('Add Student');
        });
    }

     //test view all student page
     public function testViewAllStudent()
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/student')
                 ->assertSee('Students');
         });
     }

    //test Cohort page
    public function testCohort()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/cohort')
                ->assertSee('Courses');
        });
    }

     //test add Cohort page
     public function testAddCohort()
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/cohort/create')
                 ->assertSee('Add Course');
         });
     }
 

    //test Evidence page
    public function testEvidence()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/evidence')
                ->assertSee('Evidence');
        });
    }

    //test add Evidence page
    public function testAddEvidence()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/evidence/create')
                ->assertSee('Add Evidence')
                ->assertSee('Select upload type');
        });
    }

    //test Notes page
    public function testNotes()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/notes')
                ->assertSee('Notes');
        });
    }

     //test add Notes page
     public function testAddNotes()
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/notes/create')
                 ->assertSee('Notes:')
                 ->assertSee('Submit');
         });
     }

     //test Profile page
     public function testProfile()
     {
         $this->browse(function (Browser $browser) {
             $browser->visit('/user')
                 ->assertSee('Profile');
         });
     }
}
