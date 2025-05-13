<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class EnrolmentCode extends Model
{
    protected $table = 'enrolment_code';
    public $timestamps=false;
    protected $hidden=['created_at', 'updated_at'];

    public function enrolment_status()
    {
        return $this->hasMany(EnrolmentStatus::class);
    }
}
