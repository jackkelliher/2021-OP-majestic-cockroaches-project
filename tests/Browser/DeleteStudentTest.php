<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;


class DeleteStudentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testDeleteStudent()

    {
        $this->browse(function (Browser $browser) {
            //Testing the delete function on the students table. Using the students name as a unqiue identifier as there is little chance of another student having the name
            // completly_unique_student
            $browser->visit('/login')
                    //Logging in
                    ->assertSee('Login')
                    ->type('#username', 'admin')
                    ->type('#password', 'aMoreSecureP@ssw0rd')
                    ->press('Sign in')
                    ->visit('/student/create')
                    //Filling in the create student form
                    ->type('name', 'completly_deleted_student')
                    ->type('email', 'completly@deleted.student')
                    ->type('github', 'completly-deleted-student-git')
                    ->press('Create')
                    ->visit('/student')
                    //Checking the test student can be found
                    ->assertSee('completly_deleted_student');


             //Pressing the delete button from the last row
            $browser->driver
                    ->findElement(WebDriverBy::xpath('/html/body/div[2]/div[2]/table/tbody/tr[last()]/td[4]/div/form/button/i'))
                    ->click();
                  
            //Checking the test cohort is no longer present on the page
            $browser->assertDontSee('completly_deleted_student');
                    
        });
    }
}
