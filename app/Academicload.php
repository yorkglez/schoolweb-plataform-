<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academicload extends Model
{
	protected $table ="academicloads";
	protected $primaryKey = 'idacademicload';
    public $timestamps = false;
    protected $fillable = [
        'date', 'semester','turn','students_studentnip','cicle'
    ];
    // relationships
    public function student_subject(){
    	return $this->hasMany(StudentSubject::class);
    }
    public function student(){
    	return $this->belongsTo(Student::class,'students_studentnip')->Orderby('name','ASC');
    }
}
