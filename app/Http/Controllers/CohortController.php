<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Cohort;
use App\Enrolment;
use App\EnrolmentData;
use App\Lecturer;
use App\Student;
use App\Paper;
use App\User;
use Illuminate\Support\Facades\Auth;

class CohortController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::all();
        $papers = Paper::all();
        $cohorts = Cohort::all();

        $user = Auth::user();
        if ($user->type == "lecturer") {
            $l = Lecturer::where('username', $user->username)->first();
            $cohorts = Cohort::where('lecturerId', $l->id)->get();
        }
        return view('cohort.index', compact('cohorts', 'papers', 'lecturers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lecturers = Lecturer::all();
        $papers = Paper::all();
        return view('cohort.create', compact('papers', 'lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cohorts = $request->all();
        $stream = $cohorts['stream'];
        if (is_null($stream)) {
            $stream = Schema::getConnection()->getDoctrineColumn('cohorts', 'stream')->getDefault();
        }

        $cohort = Cohort::where([['subject', $cohorts['subject']], ['year', $cohorts['year']], ['semester', $cohorts['semester']], ['stream', $stream]])->first();

        if (empty($cohort)) {
            $cohort = new Cohort;
        }
        $cohort->subject = $cohorts['subject'];
        $cohort->semester = $cohorts['semester'];
        $cohort->stream = $stream;
        $cohort->year = $cohorts['year'];
        $lecturer = Lecturer::where('name', $request['lecturer'])->first();
        $cohort->lecturerId = $lecturer->id;
        $cohort->save();

        return redirect()->route('cohort.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $cohorts = Cohort::query();
        $included = array();
        
        $previous = array();
        $cohort = Cohort::find($id);
        $paper = $cohort->subject;
        
        $enrolled  = EnrolmentData::where('cohortId', $id)->get();
        
        foreach ($enrolled as $e){
            array_push($included, $e->studentId);
        }
        $students = Student::whereNotIn('id', $included)->get();
        if ($cohorts->where('id', $id)->exists()) {
            $cohort = $cohorts->where('id', $id)->first();
            $lecturer = Lecturer::find($cohort->lecturerId);
            $lecturers = Lecturer::all();
            return view('cohort.show', compact('user', 'cohort', 'enrolled', 'students', 'lecturer', 'lecturers'));
        } else {

            return response()->json(['message' => 'Cohort not found.'], 404);
        }
       
        $students = Student::whereNotIn('id', $included)->whereNotIn('id', $previous)->get();
        $lecturer = Lecturer::find($cohort->lecturerId);
        $lecturers = Lecturer::all();
        
        return view('cohort.show', compact('cohort', 'enrolled', 'students', 'lecturer', 'lecturers'));
    }

    // Update the students list individually
    public function update_students(Request $request, $id)
    {
        $cohort = Cohort::find($id);

        $cohort->students = request('Students');
        $cohort->save();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Edit the containing cohort, the cohorts details
        $cohort = Cohort::find($id);
        $papers = Paper::all();
        $lecturers = Lecturer::all();
        return view('cohort.edit', compact('cohort', 'papers', 'lecturers'));
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

        if (Cohort::where('id', $id)->exists()) {
            $cohort = Cohort::find($id);

            $cohort->subject = request('subject');
            $cohort->year = request('year');
            $cohort->stream = request('stream');
            $cohort->semester = request('semester');
            $cohort->save();
            return redirect()->route('cohort.index');
        } else {
            return redirect()->route('cohort.index');
        }
    }
    public function year($year)
    {
        $summer = Cohort::where([['year', $year], ['semester', 'S']])->get();
        $first = Cohort::where([['year', $year], ['semester', '1']])->get();
        $second = Cohort::where([['year', $year], ['semester', '2']])->get();
        $user = Auth::user();
        if ($user->type == "lecturer") {
            $l = Lecturer::where('username', $user->username)->first();
            $summer = Cohort::where([['year', $year], ['semester', 'S'], ['lecturerId', $l->id]])->get();
            $first = Cohort::where([['year', $year], ['semester', '1'], ['lecturerId', $l->id]])->get();
            $second = Cohort::where([['year', $year], ['semester', '2'], ['lecturerId', $l->id]])->get();
            return view('cohort.year', compact('summer', 'first', 'second', 'year', 'l','user'));
        }
        else if($user->type =="admin"){
            $lecturers = Lecturer::all();
            return view('cohort.year', compact('summer', 'first', 'second', 'year', 'lecturers','user'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        if (Cohort::where('id', $id)->exists()) {
            $cohort = Cohort::find($id);

            $cohort->delete();
            return redirect()->route('cohort.index', compact('cohort'));
        } else {
            return redirect()->route('cohort.index', compact('cohort'));
        }
    }
}
