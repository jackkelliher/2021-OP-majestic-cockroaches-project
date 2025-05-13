<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    //return the login page page
    public function index()
    {
        return view('auth.login');
    }     

    //log the user in and check they exist in the database
    public function login(Request $request)
    {
        $userdata = array(
            'username' => $request->username,
            'password' => $request->password
        );

        //if the user exists, send the to the home page. otherwise return them to login page
        if (Auth::attempt($userdata)) {
            return redirect('/')->withSuccess('Login Successful');
        }
        
        if(Auth::guard('lecturer')
            ->attempt($userdata)){            
            return redirect('/')->withSuccess('Login Successful');
        }

        return redirect("login")->withSuccess('Invalid User Details');
        
    }
        
    //log the user out
    public function logout(Request $request) {
        Auth::logout();
        Auth::guard('lecturer')->logout();  
        return view('auth.login');
    }

    /*
    This is code that is unused for regestaring a user, may be implemented at a later date but
    for now seeding a user is ok

    public function registration()
    {
        return view('registration');
    }      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        $student = DB::select('select * from student'); 
        return view('pages.index',  ['student'=>$student])->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password']
      ]);
    }     

    */

}

