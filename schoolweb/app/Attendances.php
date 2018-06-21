<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
	protected $table ="attendances";
	protected $primaryKey = 'idattendance';
	public $timestamps = false;
    protected $fillable = [
        'type', 'date_at','student_subject_idstudent_subject'
    ];
    // relationships
    public function student_subject(){
    	return $this->belongsTo(StudentSubject::class);
    }
}
