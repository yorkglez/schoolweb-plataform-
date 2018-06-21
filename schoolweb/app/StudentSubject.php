<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    protected $table ="student_subject";
	protected $primaryKey = 'idstudent_subject';
    public $timestamps = false;
    protected $fillable = [
        'academicload_idacademicload', 'subjectslist_idsubjectslist'
    ];
    // relationships
    public function academicload(){
    	return $this->belongsTo(Academicload::class);
    }
    public function subjectlist(){
    	return $this->belongsTo(Subjectlist::class,'subjectslist_idsubjectslist','idsubjectslist');
    }
    public function attendances(){
    	return $this->hasMany(Attendances::class);
    }
    public function ratingreport(){
      return $this->hasMany(Ratingsreport::class,'studentsubject_idstudentsubject');
    }
}
