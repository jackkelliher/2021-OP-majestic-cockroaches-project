<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Student;
use App\Evidence;
use App\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
class EvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evidence = Evidence::all();
        $students = Student::all();
        $lecturers = Lecturer::all();
        return view('evidence.index', compact('students', 'evidence', 'lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $evidence = Evidence::all();
        $students = Student::all();
        $lecturers = Lecturer::all();
        return view('evidence.create', compact('students', 'evidence', 'lecturers'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    
    {
        $evidence = new Evidence();
        $data = $request->all();
        
        
        $request->validate([

            'file' => 'mimes:pdf,xlx,csv,jpg,jpeg|max:2048',
        
            'uploadType' => 'required',
            'selectUser' => 'required'

        ]);
        $user = null;
        if ($data['selectUser'] == "student") {
            try {
                $user = Student::find($data['student']);
            } catch (Exception $e) {

                return back()

                    ->with('error', 'Please select a student');
            }
        }if ($data['selectUser'] == "lecturer") {
            try {
                $user = Lecturer::find($data['lecturer']);
            } catch (Exception $e) {

                return back()

                    ->with('error', 'Please select a lecturer');
            }
        }

        if ($user ==null ){
            return back()

                    ->with('error', 'Please select a user');
        }else{
            if( $data['uploadType'] == "file"){
               $data['url']=null;
            }
            if($data['uploadType'] == "url"){
                $data['file']=null;
                
             }
            $userName = $user->name;
            $userId = $user->id;
            if($data['itemName']==null){
                if( $data['uploadType'] == "file"){
                    $fileName = strstr($data['file']->getClientOriginalName(),'.',true);
                }
                else{
                    $parse = parse_url($data['url']);
                   
                    $fileName= $parse['host'];
                }
                
            }
            else{
                $fileName = $data['itemName'];
            }
           
            if ($data['file'] != null && $data['uploadType'] == "file") {
                $type = $data['file']->getMimeType();
                $fileType = strstr($data['file']->getClientOriginalName(),'.');
                $path = "uploads/" . $userName . "/";
                $request->file->move(public_path($path), $fileName.$fileType);
                $path =$path.$fileName.$fileType;
            }
            if ($data['url'] != null && $data['uploadType'] == "url") {
                $type = "url";
                $path = $data['url'];
                
            }
            if ($data['url'] != null ||$data['file'] != null) {
                
                
                $evidence->name = $fileName;
                $evidence->location = $path;
                $evidence->type = $type;
                $evidence->userType = $data['selectUser'];
                $evidence->userId = $userId;
                
            } else {
                if ($data['uploadType'] == "file") {
                    return back()
    
                        ->with('error', 'Please select a file to upload ');
                } else if ($data['uploadType'] == "url") {
                    return back()
    
                        ->with('error', 'Please enter a URL');
                }
            }
            
            
        }
        try {
            $evidence->save();
           
            return back()
                ->with('success', 'You have successfully upload '.$userName."'s  file.");
        } catch (Exception $e) {
    
            return back()

                ->with('error', 'Whoops! An error occurred, please try again.');
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // return Storage::disk('s3')->responce('images/' . $image->filename);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $evidence = Evidence::find($id);
        $students = Student::all();
        $lecturers = Lecturer::all();
        return view('evidence.edit', compact('students', 'evidence', 'lecturers'));
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

        $evidence = Evidence::find($id);
        $type = $request->file->getMimeType();

        $fileName = $request->file->getClientOriginalName();
        $request->file->move(public_path('uploads'), $fileName);

        $path = "uploads/" . $fileName;
        $evidence->name = $fileName;
        $evidence->location = $path;
        $evidence->type = $type;

        $evidence->save();
        return redirect()->route('evidence.index', compact('evidence'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete the Todo
        $evidence = Evidence::findOrFail($id);
        $id = $evidence->student_id;
        $evidence->delete();
        return back()->withSuccess('Deleted');
    }
}
