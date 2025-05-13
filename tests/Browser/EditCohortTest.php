<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;

class EditCohortTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testEditCohort()
    {
        $this->browse(function (Browser $browser) {
            //login
            $browser->visit('/login')
                ->assertSee('Login')
                ->type('#username', 'admin')
                ->type('#password', 'aMoreSecureP@ssw0rd')
                ->press('Sign in');

            //test add cohort
            $browser
                ->visit('/cohort/create')
                ->assertSee('Add Course')
                ->click('#subject')
                ->keys('#subject', 'Studio1 - IN510001')
                ->click('#semester')
                ->keys('#semester', 'Summer School')
                ->type('#stream', 'T2')
                ->type('#year', '2010')
                ->click('#lecturer')
                ->keys('#lecturer', 'Manu Keyes')
                ->press('Create Cohort')

                ->assertSee('Studio1')
                ->assertSee('2010')
                ->assertSee('T2')
                ->assertSee('S')
                ->assertSee('Manu Keyes');

            //Pressing the delete button from the last row
            $browser->driver
                ->findElement(WebDriverBy::xpath('//*[@id="tables"]/tbody/tr[last()]/td[6]/div/a/i'))
                ->click();

            $browser
                ->assertSee('Edit Cohort')
                ->click('#subject')
                ->keys('#subject', 'Studio2 - IN510002')
                ->click('#semester')
                ->keys('#semester', 'Semester 1')
                ->type('#stream', 'T3')
                ->type('#year', '2111')
                ->press('Save Cohort')
                ->visit('/cohort')

                ->assertSee('Studio2')
                ->assertSee('1')
                ->assertSee('T3')
                ->assertSee('2111');
        });
    }
}
