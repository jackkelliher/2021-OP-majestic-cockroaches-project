<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NavBarTest extends DuskTestCase
{
    /**
     * @return void
     */
    public function testNav()
    {
        $this->browse(function (Browser $browser) {
            //login
            $browser->visit('/login')
                ->assertSee('Login')
                ->type('#username', 'admin')
                ->type('#password', 'aMoreSecureP@ssw0rd')
                ->press('Sign in');

            //test navBar can be click
            $browser
                //click view all student
                ->press('#navbarSupportedContent > ul > div:nth-child(2) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(2) > div > a:nth-child(1)')
                ->assertSee('Students')
                ->assertSee('Name')
                ->assertSee('Email')
                ->assertSee('Github')
                ->assertSee('Edit/Delete')

                //click add student
                ->press('#navbarSupportedContent > ul > div:nth-child(2) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(2) > div > a:nth-child(2)')
                ->assertSee('Add Student')
                ->assertSee('Create')

                //click view course
                ->press('#navbarSupportedContent > ul > div:nth-child(3) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(3) > div > a:nth-child(1)')
                ->assertSee('Courses')
                ->assertSee('Paper')
                ->assertSee('Year')
                ->assertSee('Edit/Delete')

                //click view add course
                ->press('#navbarSupportedContent > ul > div:nth-child(3) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(3) > div > a:nth-child(2)')
                ->assertSee('Courses')
                ->assertSee('Add Course')

                //click view evidence
                ->press('#navbarSupportedContent > ul > div:nth-child(5) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(5) > div > a:nth-child(1)')
                ->assertSee('Evidence')

                //click add evidence
                ->press('#navbarSupportedContent > ul > div:nth-child(5) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(5) > div > a:nth-child(2)')
                ->assertSee('Select upload type')
                ->assertSee('Add Evidence')
              
                //click view notes
                ->press('#navbarSupportedContent > ul > div:nth-child(6) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(6) > div > a:nth-child(1)')
                ->assertSee('Notes')

                //click add notes
                ->press('#navbarSupportedContent > ul > div:nth-child(6) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(6) > div > a:nth-child(2)')
                ->assertSee('Notes:')
                ->assertSee('Submit')

                //click Home
                ->press('#navbarSupportedContent > ul > li > a')
                ->assertSee('Welcome')

                //click view all Lecturers
                ->press('#navbarSupportedContent > ul > div:nth-child(7) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(7) > div > a:nth-child(1)')
                ->assertSee('Lecturers')
                ->assertSee('Name')
                ->assertSee('Email')
                ->assertSee('Username')
                ->assertSee('Delete')


                //click Add Lecturer
                ->press('#navbarSupportedContent > ul > div:nth-child(7) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(7) > div > a:nth-child(2)')
                ->assertSee('Add Lecturer')
                ->assertSee('Userame:')
                ->assertSee('Real Name:')

                //click profile
                ->press('#navbarSupportedContent > ul > div:nth-child(8) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(8) > div > a:nth-child(1)')
                ->assertSee('Profile')
                ->assertSee('Admin User')
                ->assertSee('Email: admin@hotmail.com')

                //click logout
                ->press('#navbarSupportedContent > ul > div:nth-child(8) > li')
                ->press('#navbarSupportedContent > ul > div:nth-child(8) > div > a:nth-child(2)')
                ->assertSee('Login');
        });
    }
}
