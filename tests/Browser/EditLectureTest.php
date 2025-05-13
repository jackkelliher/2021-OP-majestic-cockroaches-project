<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;


class EditLectureTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testEditLecture()
    {
        $this->browse(function (Browser $browser) {
            //login
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in')
                    ->visit('/lecturer');

             //Pressing the edit button from the last row
            $browser->driver
                    ->findElement(WebDriverBy::xpath('//*[@id="tables"]/tbody/tr[last()]/td[4]/div/a/i'))
                    ->click();

                    
            //edit lecturer
            $browser->assertSee('Edit')
                    ->assertSee('Save')
                    ->type('name', 'TestEdit1')
                    ->type('username', 'TestEdit1')
                    ->type('email', 'test@edit')
                    ->press('Save')
                    ->visit('/lecturer')
                    ->assertSee('TestEdit1')
                    ->assertSee('test@edit');
        });
    }
}
