<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;



class GetCohortDetailTest extends DuskTestCase

{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testGetCohort()
    {
        $this->browse(function (Browser $browser) {
            //login page
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in')
                    ->visit('/Cohort');

            $browser->visit('/cohort/create')
                    ->assertSee('Add Course')
                    ->click('#subject')
                    ->keys('#subject', 'Studio1 - IN510001')
                    ->click('#semester')
                    ->keys('#semester', 'Summer School')
                    ->type('#stream', 'TT')
                    ->type('#year', '2555')
                    ->click('#lecturer')
                    ->keys('#lecturer', 'Manu Keyes')
                    ->press('Create Cohort')
    
                    ->assertSee('Studio1')
                    ->assertSee('2555')
                    ->assertSee('TT')
                    ->assertSee('S')
                    ->assertSee('Manu Keyes')
                    ;

            $browser->driver
                    ->findElement(WebDriverBy::xpath('/html/body/div[2]/div/div/table/tbody/tr[last()]/td[1]/a'))
                    ->click();
                    
            $browser->assertSee('Studio1') 
                    ->assertSee('Currently Enrolled:')
                    ->assertSee('Students Avaliable To Enroll:');

        });
    }
}
