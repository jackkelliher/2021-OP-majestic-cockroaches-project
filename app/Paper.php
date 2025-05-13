<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $table = 'papers';
    protected $fillable = ['name','code','level'];
    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];

    public function setCode()
    {
        $this->code = "IN".$this->level . $this->id;
        $this->save();
    }
    public function getCode()
    {
        $code = "IN".$this->level . $this->id;
        return $code;
    }
    public function cohort()
    {
        return $this->hasMany(Cohort::class);
    }
    
    
}
