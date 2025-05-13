<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\EnrolmentCode;

class EnrolmentStatus extends Model
{
    protected $table = 'enrolment_status';
    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];


    public function getSemester()
    {
        $cmonth = intval(date("m"));
        $cyear = intval(date("y"));
        $cday = intval(date("d"));
        $semester = "S";
        if ($cmonth < 3) {
            if ($cmonth < 2 && $cday > 19) {
                $semester = "1";
            } else {
                $semester = "S";
            }
        } else if ($cmonth > 6) {
            $semester = "2";
        } else {
            $semester = "1";
        }
        return $semester;
    }



    public function getStatusCode($statusStr)
    {
        $result = null;
        switch ($statusStr) {
            case "enrolled":
                $result = EnrolmentCode::select('id')->where('status', 'Enrolled')->first();
                break;
            case "withdrawn":
                $result = EnrolmentCode::select('id')->where('status', 'Withdrawn')->first();
                break;
            case "passed":
                $result = EnrolmentCode::select('id')->where('status', 'Passed')->first();
                break;
            case "failed":
                $result = EnrolmentCode::select('id')->where('status', 'Failed')->first();
                break;
            default:
                $result = EnrolmentCode::select('id')->where('status', 'Enrolled')->first();
        }
        $result = $result->id;
        return $result;
    }
    public function setStatus($statusStr)
    {
        $statusStr = strtolower($statusStr);
        $this->statusCode = $this->getStatusCode($statusStr);
        $this->save();
    }
    public function getStatusStr(){
        $status =EnrolmentCode::select('status')->where('id', $this->statusCode)->first();
        $status = $status->status;
        return $status;
    }
    public function getDefault()
    {
        $enrolled = EnrolmentCode::select('id')->where('status', 'Enrolled')->first();
        $enrolled = $enrolled->id;
        return $enrolled;
    }
    public function enrolment()
    {
        return $this->belongsTo('App\Enrolment');
    }
    public function enrolment_code()
    {
        return $this->belongsTo('App\EnrolmentCode');
    }
}
