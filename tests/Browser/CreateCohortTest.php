<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateCohortTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateCohort()
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
                ->type('#stream', 'T1')
                ->type('#year', '2000')
                ->click('#lecturer')
                ->keys('#lecturer', 'Manu Keyes')
                ->press('Create Cohort')
                ->assertSee('Studio1')
                ->assertSee('2000')
                ->assertSee('T1')
                ->assertSee('S')
                ->assertSee('Manu Keyes')
                ;

        });
    }
}
