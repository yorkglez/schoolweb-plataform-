<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
	protected $table ="careers";
	protected $primaryKey = 'idcareer';
	public $incrementing = false;
  public $timestamps = false;
  protected $fillable = [
      'name', 'semesters','alias'
  ];
	public function scopeSearch($query,$text){
		if (trim($text)!='') {
				return $query->where('name','LIKE','%'.$text.'%')->Orwhere('idcareer','LIKE','%'.$text.'%');
			}
	}
  // relationships
  public function students(){
  	return $this->hasMany(Student::Class,'careers_idcareer','idcareer');
  }
  public function subjectlist()
  {
      return $this->hasMany(Subjectlist::class);
  }
}
