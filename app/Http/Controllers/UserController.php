<?php

namespace App\Http\Controllers;

use App\Cohort;
use App\Evidence;
use App\Lecturer;
use App\Note;
use App\Paper;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (isset($user)) {
            if ($user->type == "lecturer") {
                $lecturer = Lecturer::where('username', $user->username)->first();
                
                return redirect()->route('lecturer.show', $lecturer->id);
            } else if ($user->type == "student") {
                $student = Student::where('username', $user->username)->first();
                return redirect()->route('student.show', $student->id);
            } else if ($user->type == "admin") {

                $cohorts = Cohort::all();
                $students = Student::all();
                $notes = Note::all();
                $evidence = Evidence::all();
                $lecturers = Lecturer::all();
                $papers = Paper::all();
                return view('pages.index', compact('cohorts', 'students', 'notes', 'evidence', 'lecturers', 'papers'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }
    public function profile()
    {
        $user = Auth::user();
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
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
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->username = request('username');
        $user->save();
        return view('user.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
