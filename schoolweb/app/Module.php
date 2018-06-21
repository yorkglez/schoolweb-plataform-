<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	protected $table ="modules";
	protected $primaryKey = 'idmodule';
	public $timestamps = false;
    protected $fillable = [
        'name', 'description','averange','subjectslist_idsubjectslist'
    ];
    // relationships
    public function subjectslist(){
    	return $this->belongsTo(Subjectlist::class,'subjectslist_idsubjectslist');
    }
    public function standars(){
        return $this->hasMany(Standar::class,'module_idmodule')->Orderby('idstandar','ASC');
    }
    public function ratintgreport(){
        return $this->hasOne(Ratingsreport::class);
    }

}
