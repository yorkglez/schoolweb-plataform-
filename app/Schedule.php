<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table ="schedules";
    protected $primaryKey ="idschedule";
    public $timestamps = false;
    protected $fillable = [
        'starttime','endtime','day','module','subjectslist_idsubjectslist'
    ];
    // relationships
    public function subjectslist(){
        return $this->belongsTo(Subjectlist::Class,'subjectslist_idsubjectslist');
    }
}
