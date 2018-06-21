<?php

namespace App\Http\Controllers;
use App\StudentSubject;
use App\Module;
use App\Standar;
use App\Assignment;
use App\Academicload;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class StudentsubjectsController extends Controller
{
  public function __construct()
    {
         $this->middleware('auth:student',['only' => ['indexschedule_student']]);
         $this->middleware('auth:teacher',['only' => ['studentslist','showstandars','assignmentslist']]);
    }
  public function showstandars(Request $request){
    if ($request->ajax()) {
      $module = Module::where('subjectslist_idsubjectslist',$request->subject)->where('idmodule',$request->module)->first();
      if (count($module)>0) {
        $liststandars[0] = '----';
        foreach ($module->standars as $standars) {
          $liststandars[$standars->idstandar] = $standars->name;
        }
        return response(['standars'=>$liststandars,'exists'=>true]);
      }
      else
        return response(['exists'=>false]);
    }
  }
	public function assignmentslist(Request $request){
		if ($request->ajax()) {
        $assignments = Assignment::where('standars_idstandars',$request->standar)->pluck('name','idassignment');
        if (count($assignments)>0)
          return response(['assignments'=>$assignments,'exists'=>true]);
        else
          return response(['exists'=>false]);
	  }
  }
	public function indexschedule_student(){
	    $list[0][0] = null;
	    $list[1][0] = null;
	    $list[2][0] = null;
	    $list[3][0] = null;
	    $list[4][0] = null;
      $month = Carbon::now()->month;
      $nip = Auth::user()->studentnip;
      $year = Carbon::now()->year;
      $actualcicle = actualcicle($month);
      $academicload = Academicload::where('students_studentnip',$nip)->where('cicle',$actualcicle)->where('date','LIKE',$year.'%')->first();
    //  dd($academicload[0]->student_subject[1]->subjectlist);
      foreach ($academicload->student_subject as $subject) {
        $name = $subject->subjectlist->subject->name;
        $teacher = $subject->subjectlist->teacher->name;
        foreach ($subject->subjectlist->schedule as $schedule ) {
          if(substr($schedule->starttime,0,-4) == 0)
            $start = substr($schedule->starttime,1);
          else
            $start = $schedule->starttime;
          if($schedule->day == 'Monday'){
            $index = getindex_schedule($start);
            $list[0][$index] = '<p>'.$name.'</p> <p><b>Maestro:</b> '.$teacher.'</p>';
            }
            if($schedule->day == 'Tuesday'){
                $index = getindex_schedule($start);
                $list[1][$index] = '<p>'.$name.'</p> <p><b>Maestro:</b> '.$teacher.'</p>';
            }
            if($schedule->day == 'Wednesday'){
                $index = getindex_schedule($start);
                $list[2][$index] = '<p>'.$name.'</p> <p><b>Maestro:</b> '.$teacher.'</p>';
            }
            if($schedule->day == 'Thursday'){
                $index = getindex_schedule($start);
                $list[3][$index] = '<p>'.$name.'</p> <p><b>Maestro:</b> '.$teacher.'</p>';
            }
            if($schedule->day == 'Friday'){
                $index = getindex_schedule($start);
                $list[4][$index] = '<p>'.$name.'</p> <p><b>Maestro:</b> '.$teacher.'</p>';
            }
        }
      }
      $hours = array('7:00 AM','7:50 AM','8:40 AM','9:30 AM','10:50 AM','11:40 AM','12:30 PM','1:20 PM','2:10 PM', '3:00 PM');
	    return view('students.schedule.index')->with('hours',$hours)->with('subjectslist',$list);

	}
}
