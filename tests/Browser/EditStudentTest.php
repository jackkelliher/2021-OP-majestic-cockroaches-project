<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;

class EditStudentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testEditStudent()
    {
        $this->browse(function (Browser $browser) {
            //login page
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in');


            //test Create student 
            $browser->visit('/student/create')
                    ->assertSee('Add Student')
                    ->type('name', 'TestEdit')
                    ->type('email', 'Edit@com')
                    ->type('github', 'EditGithub')
                    ->press('Create')
                    ->visit('/student')
                    ->assertSee('TestEdit')
                    ->assertSee('Edit@com')
                    ->assertSee('EditGithub');

            //Pressing the edit button from the last row
            $browser->driver
                    ->findElement(WebDriverBy::xpath('/html/body/div[2]/div[2]/table/tbody/tr[last()]/td[4]/div/a/i'))
                    
                    ->click();
                    
                    //edit student
            $browser->assertSee('Edit Test')
                    ->type('name', 'TestEdit1')
                    ->type('email', 'Edit1@com')
                    ->type('github', 'EditGithub1')
                    ->press('Save')
                    ->visit('/student')
                    ->assertSee('TestEdit1')
                    ->assertSee('Edit1@com')
                    ->assertSee('EditGithub1');
        });
    }
}
