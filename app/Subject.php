<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table ="subjects";
    protected $primaryKey ="code";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'name','credits'
    ];
    public function subjectlist()
    {
    	return $this->hasOne(Subjectlist::class);
    }

}
