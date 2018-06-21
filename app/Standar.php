<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standar extends Model
{
    protected $table ="standars";
	protected $primaryKey = 'idstandar';
    public $timestamps = false;
    protected $fillable = [
        'name', 'value','number','module_idmodule'
    ];
    // relationships
    public function module(){
    	return $this->belongsTo(Module::class,'module_idmodule');
    }
    public function assignments() {
        return $this->hasMany(Assignment::class,'standars_idstandars');
    }
}
