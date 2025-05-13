<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'username',
        'github',
        'email'
    ];
    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];

    public function getEmail()
    {
        $email = $this->getUsername() . "@student.op.ac.nz";
        return $email;
    }

    public function setEmail()
    {
        $email = $this->getEmail();
        $this->email = $email;
        $this->save();
    }
    public function setUsername(){
        $user = $this->getUsername();
        $this->username = $user;
        $this->save();
    }
    public function getUsername()
    {
        $name = strtolower($this->name);
        $user = substr($name, strpos($name, " ") + 1, 3) . substr($name, 0, 3) . $this->id;
        return $user;
    }
    public function setGithub(){
        $git = $this->getUsername();
        $this ->github = $git;
        $this->save();
    }
   
    public function setDefaults()
    {
        if (is_null($this->email)) {
            $this->setEmail();
        }
        
        if (is_null($this->username)) {
            $this->setUsername();
        }
        
        if (is_null($this->github)) {
            $this->setGithub();
        }
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function enrolment()
    {
        return $this->belongsTo('App\Enrolment');
    }
}
