<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Lecturer extends Authenticatable
{

  protected $table = 'lecturers';
  protected $fillable = ["username", "password", "name", "email"];

  //protected $guarded = ['username', 'password', 'email', 'name'];

  public function getAuthIdentifier()
  {
    return $this->getKey();
  }

  public function getAuthPassword()
  {
    return $this->password;
  }

  public function getRememberToken()
  {
    return $this->remember_token;
  }

  public function setRememberToken($value)
  {
    $this->remember_token = $value;
  }

  public function getRememberTokenName()
  {
    return "remember_token";
  }

  public function getReminderEmail()
  {
    return $this->email;
  }
  public function cohort()
  {
    return $this->hasMany(cohort::class);
  }
  public function getEmail()
  {
    $name = strtolower($this->name);
    $email = substr($name, 0, strpos($name, " ")) . substr($name, strpos($name, " ") + 1) . "@lecturer.op.ac.nz";
    $l = Lecturer::where('email', $email)->get();
    if (!is_null($l)) {
      $email = $this->getUsername() . "@lecturer.op.ac.nz";
    }
    return $email;
  }
  public function setEmail()
  {
    $email = $this->getEmail();
    $this->email = $email;
    $this->save();
  }
  public function getUsername()
  {
    $name = strtolower($this->name);
    $user = substr($name, strpos($name, " ") + 1, 3) . substr($name, 0, 3) . $this->id;
    return $user;
  }
  public function setUsername()
  {
    $user = $this->getUsername();
    $this->username = $user;
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
  }
}
