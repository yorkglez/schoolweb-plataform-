<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $guard = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function admin(){
      return $this->type === 'admin';
    }
    public function personal(){
      return $this->type === 'personal';
    }
    protected $primaryKey ="iduser";
    protected $fillable = [
        'name', 'email', 'password','phone','lastname','type'
    ];
    public function scopeSearch($query,$text){
      if (trim($text)!='') {
          return $query->where('name','LIKE','%'.$text.'%')->orwhere('lastname','LIKE','%'.$text.'%')->Orwhere('iduser','LIKE','%'.$text.'%');
        }
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
