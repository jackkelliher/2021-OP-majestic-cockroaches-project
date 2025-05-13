<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
   
    protected $table = 'enrolment';
    protected $primaryKey = 'id';
    public $timestamps=false;
    protected $fillable = ["id", "cohortId", "studentId"];
   
    public function getStatusStr(){
        $estatus= EnrolmentStatus::where('id',$this->id)->first();
        $status =EnrolmentCode::select('status')->where('id', $estatus->statusCode)->first();
        $status = $status->status;
        return $status;
    }

    public function students(){
        return $this->hasMany ('App\Student');
    }
    public function cohorts(){
        return $this->hasMany ('App\Cohort');
    }

    public function enrolment_status()
    {
        return $this->hasMany('App\EnrolmentStatus');
    }
    public function enrolment_data()
    {
        return $this->hasMany('App\EnrolmentData');
    }
}
