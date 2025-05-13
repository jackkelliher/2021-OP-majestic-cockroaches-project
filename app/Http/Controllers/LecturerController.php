<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cohort;
use App\Lecturer;

class LecturerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lecturers = Lecturer::all();
        return view('lecturer.index', compact('lecturers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lecturer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request =  $request->all();
        
        $name = $request['name'];
        $password = $request['password'];
        
        $email = $request['email'];
        $username = $request['username'];

        $lecturer = Lecturer::where('name', $name)->first();
        if (is_null($lecturer)) {
            $lecturer = new Lecturer;
        }
        
        $lecturer->password = bcrypt($password);
        $lecturer->name = $name;
        $lecturer->save();
        if (is_null($username)) {
            $lecturer->username =  $lecturer->getUsername();
        } else {
            
            $lecturer->username = $username;
        }
        if (is_null($email)) {
            $lecturer->email =  $lecturer->getEmail();
        } else {
            $lecturer->email = $email;
        }
        $lecturer->save();
        $lecturers = Lecturer::all();
        return view('lecturer.index', compact('lecturers'));
    }

    public function unassign($id){
        $cohort = Cohort::find($id);
        $cohort->lecturerId = null;
        $cohort->save();
       
        return redirect()->route('cohort.show', $cohort->id);

    }
    public function assign($id, Request $request){
        $request= $request->all();
        $cohort = Cohort::find($id);
        $lecturer = Lecturer::where('name', $request['lecturer'])->first();
        $cohort->lecturerId= $lecturer->id;
        $cohort->save();
    
        return redirect()->route('cohort.show', $cohort->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lecturer= Lecturer::find($id);
        $cohorts=Cohort::where('lecturerId', $lecturer->id)->get();
        return view('lecturer.show', compact('lecturer', 'cohorts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lecturer = Lecturer::find($id);
        # Passing the student to the edit view
        return view('lecturer.edit', compact('lecturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lecturer = Lecturer::find($id);
        $lecturer->name = request('name');
        $lecturer->email = request('email');
        $lecturer->username = request('username');
        $lecturer->save();
        return redirect()->route('lecturer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $l = Lecturer::find($id);
        $l->delete();
        return redirect()->route('lecturer.index');
    }
}
