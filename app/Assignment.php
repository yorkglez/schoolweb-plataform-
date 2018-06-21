<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
	protected $table ="assignments";
	protected $primaryKey = 'idassignment';
	public $timestamps = false;
    protected $fillable = [
        'name','standars_idstandars','status'
    ];
  	public function standar(){
  		return $this->belongsTo(Standar::class,'standars_idstandars');
  	}
  	public function rating(){
  		return $this->hasOne(Rating::class);
  	}
}
