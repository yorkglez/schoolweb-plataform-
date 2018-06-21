<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Student extends  Authenticatable
{
    use Notifiable;
    protected $guard = 'student';
    /**
    * The attributes that are mass assignable.
    *
    * @var array

    */
    protected $table ="students";
    protected $primaryKey ="studentnip";
    protected $fillable = [
        'name','lastname', 'email', 'password','phone','address','postalcode','bdate','state','careers_idcareer',
    ];
    public function scopeSearchall($query,$text){
    	if (trim($text)!='') {
        	return $query->where('name','LIKE','%'.$text.'%')->orwhere('lastname','LIKE','%'.$text.'%')->Orwhere('studentnip','LIKE','%'.$text.'%');
        }
    }
    public function scopeStatus($query,$text){
    	if (trim($text)!='') {
        	return $query->where('status',$text);
        }
    }
    // relationships
    public function career(){
        return $this->belongsTo(Career::Class,'careers_idcareer','idcareer');
    }
    public function academicload(){
        return $this->hasOne(Academicload::class);
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
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
