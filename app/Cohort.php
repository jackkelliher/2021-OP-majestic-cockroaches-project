<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{

    protected $table = 'cohorts';
    protected $fillable = ['lecturerId','subject','code'. 'year', 'semester', 'stream'];
    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];
    public function getDefault()
    {
        return $this->_default;
    }

   
    public  function setLecturer(){
        $lecturers = Lecturer::all();
        $max = Lecturer::all()->count();
            $sel = rand(0, $max-1);
            $l = $lecturers[$sel];
            $this->lecturerId = $l->id;
        $this->save();

    }
    public function setCode(){
        $subject = $this->subject;
        $p= Paper::where('name', $subject)->first();
       
        if(is_null($p->code)){
            $p->setCode();
        }
        $this->code = $p->code;
        $this->save();
    }
    public function setDefaults(){
        $this->setLecturer();
        $this->setCode();
    }

    //links the foreign key to this table
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function lecturer()
    {
        return $this->belongsTo('App\Lecturer');
    }
    public function enrolment()
    {
        return $this->belongsTo('App\Enrolment');
    }
    public function paper()
    {
        return $this->belongsTo('App\Paper');
    }
}
