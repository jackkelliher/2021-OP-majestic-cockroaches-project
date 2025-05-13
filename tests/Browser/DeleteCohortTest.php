<?php

namespace Tests\Browser;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;

class DeleteCohortTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDeleteCohort()
    {
        $this->browse(function (Browser $browser) {
            //Testing the delete function on the cohort table. Using the year as the unique identifier as the likelihood of another year being set at 9999 (breaking the test)
            // at the time of testing is low
            $browser->visit('/login')
                    //Logging in
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in')
          


                    ->visit('/cohort/create')
                    //Filling out the create cohort form
                    ->select('subject')
                    ->select('semester')
                    ->type('stream', '99')
                    ->type('year', '9999')
                    ->press('Create Cohort')
                    //Using year to find the test cohort
                    ->assertSee('9999');
                    
                    
            //Pressing the delete button from the last row
            $browser->driver
                    ->findElement(WebDriverBy::xpath('/html/body/div[2]/div[2]/div/table/tbody/tr[last()]/td[6]/div/form/button/i'))
                    ->click();
            
            //Checking the test cohort is no longer present on the page
            $browser->assertDontSee('9999');

                  
                    


          
        });
    }
}
