<?php

namespace App\Http\Controllers;

use App\Cohort;
use Illuminate\Http\Request;
use App\Student;
use App\Evidence;
use App\Note;
use App\Enrolment;
use App\EnrolmentData;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index() // Display all students
    {
        $student = Student::all();
        $cohort = Cohort::all();
        return view('student.index', compact(['student', 'cohort'])); // return data with students context
    }

    public function changeSort()
    {
        // Get the current sort order
        $sortOrder = session()->get('sortOrder', 'asc');

        // Flip the sort order, so it toggles when clicked
        $sortOrder = $sortOrder == 'desc' ? 'asc' : 'desc';
        session()->put('sortOrder', $sortOrder);

        return redirect()->back(); // Take them back to the last page (the student page)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Allows inputing fields for the student table and stores them in the database
    public function store(Request $request)
    {

        $student = new Student;
        $student->github = $request->github;
        $student->name = $request->name;
        $email = $request->email;


        if (is_null($email)) {
            $email = $student->setEmail();
        }
        $student->save();
        $email = $request->email;
        $student->email = $email;
        $github = $request->github;
        if (is_null($github)) {
            $github = "";
        }
        $student->github = $github;
        $student->save();

        $student = Student::all();
        //get the cohorts 
        $cohort = Cohort::all();
        //Returns to the create student page, but when refreshed does not resubmit form data
        return back()->withSuccess($request->name . ' Created');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        # Passing the student to the edit view
        return view('student.edit', compact('student'));
    }
    public function show($id)
    {
        // 
        $enrolment = EnrolmentData::where('studentId', $id)->get();
        $student = Student::find($id);
        $notes = Note::Where('student_id', $id)->get();
        $evidence = Evidence::Where('userId', $id)->where('userType', "student")->get();
    
        return view('student.show', compact('student', 'notes', 'evidence','enrolment'));
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
        //
        $students = Student::find($id);

        $students->name = request('name');
        $students->email = request('email');
        $students->github = request('github');
        $students->save();
        return redirect()->back()->withSuccess('Updated Sucsessfully');
    }
    public function year($year)
    {
        $enrol = EnrolmentData::select('studentId')->where('year', $year)->distinct()->get();
        $students = Student::whereIn('id', $enrol)->get();

        return view('student.year', compact('students', 'year'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* Uncomment when pushed to finished student controller
        $sortOrder = session()->get('sortOrder', 'asc');
        $students = student::orderBy('name', $sortOrder)->get();
        */

        //Removing evidence linked to the deleted student
        $removeEvidence = Evidence::where('userId', $id);
        $removeEvidence->delete();

        //Removing Notes linked to the deleted student
        $removeNotes = Note::where('student_id', 'LIKE', $id);
        $removeNotes->delete();

        //Finally delete the student
        $delStudent = Student::find($id);
        $delStudent->delete();
        $student = Student::all();
        $cohort = Cohort::all();
        return view('student.index', compact(['student', 'cohort']));
    }
}
