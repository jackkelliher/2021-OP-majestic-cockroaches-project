<?php

namespace App\Http\Controllers;
use App\Note;
Use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();
        $student = Student::all();
        return view('notes.index',compact('student', 'notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $notes = Note::all();
        $student = Student::all();
        return view('notes.create',compact('student', 'notes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $note = new Note;
        $student = Student::where('name', 'LIKE', '%' . $request->student . '%')->get();
      
            $note->student_name = $request->student;
            $note->notes = $request->notes;
            $note->student_id = $student[0]->id;
     
       
        $note->save(); // save it to the database.

        $students = Student::all();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notes = Note::query();
        if ($notes->where('id', $id)->exists()) {
            $note = $notes->where('id', $id)->get();
            return response($note, 200);
        } else {
            return response()->json(['message' => 'note not found.'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $notes = Note::query();
        if ($notes->where('id', $id)->exists()) {
            $note = $notes->find($id);
            $note->student_name = is_null($request->student_name) ? $note->student_name : $request->student_name;
            $note->notes = is_null($request->notes) ? $note->notes : $request->notes;
            $note->save();
            return response()->json(['message' => 'note updated.'], 200);
        } else {
            return response()->json(['message' => 'note not found.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notes = Note::query();
        if ($notes->where('id', $id)->exists()) {
            $note = $notes->find($id);
            $note->delete();
        } else {
            //return response()->json(['message' => 'note not found.'], 404);
        }
    }
}