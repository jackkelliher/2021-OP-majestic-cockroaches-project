<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is_admin', function($user) {
            $user_id = Auth::id();
            //Finds the user with matching id
            $current_user = User::find($user_id);

            //If there was no entries in the users database with that id
            if($current_user == null) {
                return false; //Current user is not in the users table
            } else {
                if( $current_user->name == $user->name && $current_user->username == $user->username ) { //Checking that the names and username match the entry
                    return true; //Current user is in the users table
                } else {
                    return false; //Current user is not in the users table
                }
            }
        });


        Gate::define('check_ownership', function($user, $owner) {

            $current_user = Auth::user();
            $admin_user = User::find($current_user->id);
            if($admin_user == null) {
                //If there is no entry in the users table with the same id
                if($current_user->id == $owner->id) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if ( $current_user->name == $admin_user->name && $current_user->username == $admin_user->username ) { //Testing if the user is an admin
                    return true; //Current user is an admin
                } else { //else user is lecturer
                                    //If there is no entry in the users table with the same id
                if($current_user->id == $owner->id) {
                    return true;
                } else {
                    return false;
                }
                }

            }

        });
    }
}
