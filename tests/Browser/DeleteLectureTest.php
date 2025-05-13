<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;


class DeleteLectureTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDeleteLecture()
    {
        $this->browse(function (Browser $browser) {
              //login
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in')
                    ->visit('/lecturer');

            //test Create lecturer 
            $browser->visit('/lecturer/create')
                    ->assertSee('Add Lecturer')
                    ->type('username', 'TestDelete')
                    ->type('password', 'testpass')
                    ->type('email', 'TestDelete@com')
                    ->type('name', 'TestDelete')
                    ->press('+')
                    ->visit('/lecturer')
                    ->assertSee('TestDelete@com')
                    ->assertSee('TestDelete');

            //Pressing the delete button from the last row
            $browser->driver
                    ->findElement(WebDriverBy::xpath('/html/body/div[2]/div/div/table/tbody/tr[last()]/td[4]/div/form/button/i'))
                    ->click();

            //Checking the test cohort is no longer present on the page
            $browser->assertDontSee('TestDelete')
                    ->assertDontSee('TestDelete@com');
              
        });
    }
}
