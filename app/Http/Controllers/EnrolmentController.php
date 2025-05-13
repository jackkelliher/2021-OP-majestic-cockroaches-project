<?php

namespace App\Http\Controllers;

use App\Cohort;
use Illuminate\Http\Request;
use App\Student;
use Illuminate\Session\Store as Session;
use App\Enrolment;
use App\EnrolmentCode;
use App\EnrolmentData;
use App\EnrolmentStatus;

class EnrolmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrolment = EnrolmentData::all();
        $cohort = Cohort::all();
        return view('enrolment.index', compact('enrolment', 'cohort'));
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

        $r = $request->request;
        $contains = array();

        foreach ($r as $p) {

            array_push($contains, $p);
        }

        $item = end($contains);
        $itemarray = explode(',', $item);
        $cohortId = substr($itemarray[0], strpos($itemarray[0], ":") + 1);
        $cohort = Cohort::find($cohortId);
        $index = 1;
        while ($index < count($contains) - 1) {
            $item = $contains[$index];
            $itemarray = explode(',', $item);
            $studentId = substr($itemarray[0], strpos($itemarray[0], ":") + 1);
            $student = Student::find($studentId);
            $this->enroll($student, $cohort);
            $index += 1;
        }

        return redirect(route('cohort.show', $cohort->id));
    }

    public function enroll($student, $cohort)
    {
        $enrolment = new Enrolment();
        $status = new EnrolmentStatus();
        $enrolment->cohortId = $cohort->id;
        $enrolment->studentId = $student->id;
        $enrolment->save();

        $e = Enrolment::where('studentId', $student->id)->where('cohortId', $cohort->id)->first();
        $status->id = $e->id;
        $status->setStatus("Enrolled");
        $status->save();
        $data = new EnrolmentData();
        $data->enrolmentId=$e->id;
        $data->setObjects();
        $data->save();
    }
    public function enrollStudent($studentId,  $cohortId)
    {
        $cohort = Cohort::find($cohortId);
        $student = Student::find($studentId);
        $this->enroll($student, $cohort);
        return redirect(route('cohort.show', $cohort->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$student = Student::where('student_id', $id)->first();
        $enrolment = EnrolmentData::find($id);
        return view('enrolment.show', compact('enrolment'));
    }
    public function changeStatus(Session $session, Request $request, $id)
    {

        $r = $request->request->all();

        if (isset($r['students'])) {
            foreach ($r['students'] as $e) {
                $enrolment = EnrolmentStatus::where('id', $e)->first();

                switch ($r['setStatusBtn']) {
                    case "fail":
                        $enrolment->setStatus('failed');

                        break;
                    case "unenroll":
                        $enrolment->setStatus('withdrawn');
                        break;
                    case "pass":
                        $enrolment->setStatus('passed');
                        break;
                }
                $enrolment->save();
            }
        }

        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unenrollStudents(Session $session, Request $request, $id)
    {

        $r = $request->request;
        
        $contains = array();

        foreach ($r as $p) {

            array_push($contains, $p);
        }
        $index = 1;
        while ($index < count($contains)) {
            $item = $contains[$index];
            $itemarray = explode(',', $item);
            $e = substr($itemarray[0], strpos($itemarray[0], ":") + 1);
            $this->destroy($session, $e);
            $index += 1;
        }

        return redirect(route('cohort.show', $id));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enrolment = EnrolmentStatus::find($id);
        $enrolment->setStatus('withdrawn');
        $enrolment= EnrolmentData::find($id);
        $enrolment->setObjects();
        return redirect()->back();
    }
}
