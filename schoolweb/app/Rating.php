<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table ="ratings";
	protected $primaryKey = 'idrating';
	public $timestamps = false;
	protected $fillable = [
        'score', 'assignment_idassignment',
    ];
    public function assignment(){
    	return $this->belongsTo(Assignment::class);
    }
    public function student(){
    	return $this->belongsTo(Student::class);
    }
}
