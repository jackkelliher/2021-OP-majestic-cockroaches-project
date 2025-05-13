<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;



class GetLecturerDetailTest extends DuskTestCase

{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testGetLecturer()
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
                    ->type('username', 'TestGetDetail')
                    ->type('password', 'testpass')
                    ->type('email', 'TestDetail@com')
                    ->type('name', 'TestDetail')
                    ->press('+')
                    ->visit('/lecturer')
                    ->assertSee('TestGetDetail')
                    ->assertSee('TestDetail@com')
                    ->assertSee('TestDetail');
                                

            $browser->driver
                    ->findElement(WebDriverBy::xpath('/html/body/div[2]/div/div/table/tbody/tr[last()]/td[1]/a/p'))
                    ->click();
                    
            $browser->assertSee('TestGetDetail') 
                    ->assertSee('Paper')
                    ->assertSee('Unassign');
        });
    }
}
