<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjectlist extends Model
{
    protected $table ="subjectslist";
    protected $primaryKey ="idsubjectslist";
    public $timestamps = false;
    protected $fillable = [
      'semester','career_idcareer','year','period','subject_code','teacher_teachernip'
    ];
    // relationships
    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }
    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }
    public function career()
    {
    	return $this->belongsTo(Career::class);
    }
    public function schedule(){
        return $this->hasMany(Schedule::class,'subjectslist_idsubjectslist')->orderByRaw('day,time(starttime),subjectslist_idsubjectslist ASC');
    }
    public function student_subject(){
        return $this->hasOne(StudentSubject::class,'subjectslist_idsubjectslist','idsubjectslist');
    }
    public function modules(){
        return $this->hasMany(Module::class,'subjectslist_idsubjectslist');
    }
}
