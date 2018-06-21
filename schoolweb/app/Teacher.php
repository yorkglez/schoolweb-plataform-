<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Teacher extends Authenticatable
{
    use Notifiable;
    protected $guard = 'teacher';
     /**
    * The attributes that are mass assignable.
    *
    * @var array

    */
    protected $table ="teachers";
    protected $primaryKey ="teachernip";
    protected $fillable = [
        'name','lastname', 'email', 'password','phone','address','postalcode','bdate','state','specialism','degree','status'
    ];

    public function scopeSearch($query,$text){
    	if (trim($text)!='') {
        	return $query->where('name','LIKE','%'.$text.'%');
        }
    }
    public function scopeSearchall($query,$text){
    	if (trim($text)!='') {
        	return $query->where('name','LIKE','%'.$text.'%')->orwhere('lastname','LIKE','%'.$text.'%')->Orwhere('teachernip','LIKE','%'.$text.'%');
        }
    }
    // relationships
    public function subjectlist()
    {
        return $this->hasOne(Subjectlist::class);
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
}
