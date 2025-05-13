<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TestDeleteCohort extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDeleteCohort()
    {
        $this->browse(function (Browser $browser) {
            //login
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in')
                    ->visit('/cohort/create')
                    ->type('subject', 'completly_deleted_subject')
                    ->type('year', '2021')
                    ->select('semester', '1')
                    ->press('Create Cohort')
                    ->assertSee('completly_deleted_subject')
                    ->press('@completly_deleted_subject')
                    ->assertDontSee('completly_deleted_subject');
        });
    }
}
