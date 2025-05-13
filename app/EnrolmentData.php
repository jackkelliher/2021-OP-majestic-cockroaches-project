<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class EnrolmentData extends Model
{
    protected $table = 'enrolment_data';
    protected $primaryKey = 'enrolmentId';
    public $timestamps = false;
    protected $fillable = ["enrolmentId", "cohortId", "studentId"];
    public function getStatusStr()
    {
        $enrolment = Enrolment::find($this->enrolmentId);
        $status = $enrolment->getStatusStr();
        return $status;
    }
    public function setObjects()
    {   

        $enrolment =Enrolment::find($this->enrolmentId);

        $cohort = Cohort::find($enrolment->cohortId);
        $student = Student::find($enrolment->studentId);
        $this->cohortId= $cohort->id;
        $this->studentId= $student->id;
        $this->subject = $cohort->subject;
        $this->semester = $cohort->semester;
        $this->year = $cohort->year;
        $this->stream = $cohort->stream;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->github = $student->github;
        $this->status = $this->getStatusStr();
        $this->save();
    
    }
    public function insertEnrolmentData($enrolmentId)
    {
        $this->enrolmentId = $enrolmentId;
        $this->save();
        $this->setObjects();
    }
    public function enrolment()
    {
        return $this->belongsTo('App\Enrolment');
    }
}
