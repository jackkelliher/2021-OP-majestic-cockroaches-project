<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = ['username', 'type','password', 'email', 'name'];

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
}
