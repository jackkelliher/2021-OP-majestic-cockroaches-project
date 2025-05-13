<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;


class GetStudentDetailTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testGetStudentDetail()
    {
        $this->browse(function (Browser $browser) {

             //login page
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in')
                    ->visit('/student');

            //test Create student 
            $browser->visit('/student/create')
                    ->assertSee('Add Student')
                    ->type('name', 'TestDetail')
                    ->type('email', 'TestDetail@com')
                    ->type('github', 'TestDetail')
                    ->press('Create')
                    ->visit('/student')
                    ->assertSee('TestDetail')
                    ->pause(1000);

            $browser->driver
                    ->findElement(WebDriverBy::xpath('/html/body/div[2]/div[2]/table/tbody/tr[last()]/td[1]/a'))
                    
                    ->click();
                    
            $browser->assertSee('TestDetail')
                    ->assertSee('Paper')
                    ->assertSee('Year')
                    ->assertSee('Semester');

        });
    }
}
