<?php

namespace App\Http\Controllers;

use App\Cohort;
use App\Lecturer;
use Illuminate\Http\Request;
use App\Paper;
use Illuminate\Support\Facades\Auth;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $papers = Paper::all();
        return view('paper.index', compact('papers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paper.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paper = new paper;
        $paper->name = $request->name;
        $paper->level = $request->level;
        $paper->save();
        $paper->setCode();
        $paper->save();
        
        //Returns to the create paper page, but when refreshed does not resubmit form data
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paper = Paper::find($id);
        $user = Auth::user();
        $cohorts = Cohort::where('subject', $paper->name)->get();
        if ($user->type == "lecturer") {
            $l = Lecturer::where('username', $user->username)->first();
            $cohorts = Cohort::where([['lecturerId', $l->id], ['subject', $paper->name]])->get();
        }
        return view('paper.show', compact('paper', 'user', 'cohorts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $paper = paper::find($id);
        # Passing the paper to the edit view
        return view('paper.edit', compact('paper'));
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


       
         $paper = paper::find($id);

         $paper->name = request('name');
         $paper->code = request('code');
         $paper->level = request('level');
         $paper->save();
         return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paper = paper::find($id);
        $paper->delete();
        return redirect()->route('paper.index');
    }
}
