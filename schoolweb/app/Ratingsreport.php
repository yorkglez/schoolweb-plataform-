<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratingsreport extends Model
{
  protected $table ="ratingsreport";
	protected $primaryKey = 'idratingsreport';
	public $timestamps = false;
  protected $fillable = [
      'module_idmodule', 'averange','studentsubject_idstudentsubject'
    ];
  public function module(){
  	return $this->belongsTo(Module::class)->Orderby('idmodule','ASC');
  }
  public function studentsubject(){
    return $this->belongsTo(StudentSubject::class,'studentsubject_idstudentsubject');
  }
}
