<?php

namespace App\Http\Controllers;
use App\Teacher;
use App\Subject;
use App\Career;
use Auth;
use Carbon\Carbon;
use App\Schedule;
use App\Subjectlist;
use Illuminate\Http\Request;

class SubjectslistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:teacher',['only' => ['indexschedule_teacher']]);
        $this->middleware('auth:student',['only' => ['indexschedule_student','showsubjectsacload']]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::Orderby('name','ASC')->pluck('name','teachernip');
        $subjects = Subject::Orderby('name','ASC')->pluck('name','code');
        $careers =  Career::Orderby('name','ASC')->pluck('name','idcareer');
        return view('admin.subjectslist.create')->with('teachers',$teachers)->with('subjects',$subjects)
        ->with('careers',$careers);
    }
    public function indexschedule_teacher()
    {
        $list[0][0] = null;
        $list[1][0] = null;
        $list[2][0] = null;
        $list[3][0] = null;
        $list[4][0] = null;
        $teachernip = Auth::user()->teachernip;
        $year =Carbon::now()->year;
        $subjectslist = Subjectlist::where('year',$year)->where('teacher_teachernip',$teachernip)->get();
        $count = 0;
        $i = 0;
        foreach ($subjectslist as $subject) {
            $career = $subject->career->alias;
            $name = $subject->subject->name;
            $semester = $subject->semester;
            foreach ($subject->schedule as $schedule) {
                if(substr($schedule->starttime,0,-4) == 0)
                  $start = substr($schedule->starttime,1);
                else
                  $start = $schedule->starttime;
                if($schedule->day == 'Monday'){
                    $index = getindex_schedule($start);
                    $list[0][$index] = '<p>'.$name.'</p> <p><b>Carrera:</b> '.$career.'</p><p><b>Semestre: </b>'.$semester.'</p>';
                }
                if($schedule->day == 'Tuesday'){
                    $index = getindex_schedule($start);
                    $list[1][$index] = '<p>'.$name.'</p> <p><b>Carrera:</b> '.$career.'</p><p><b>Semestre: </b>'.$semester.'</p>';
                }
                if($schedule->day == 'Wednesday'){
                    $index = getindex_schedule($start);
                    $list[2][$index] = '<p>'.$name.'</p> <p><b>Carrera:</b> '.$career.'</p><p><b>Semestre: </b>'.$semester.'</p>';
                }
                if($schedule->day == 'Thursday'){
                    $index = getindex_schedule($start);
                    $list[3][$index] = '<p>'.$name.'</p> <p><b>Carrera:</b> '.$career.'</p><p><b>Semestre: </b>'.$semester.'</p>';
                }
                if($schedule->day == 'Friday'){
                    $index = getindex_schedule($start);
                    $list[4][$index] = '<p>'.$name.'</p> <p><b>Carrera:</b> '.$career.'</p><p><b>Semestre: </b>'.$semester.'</p>';
                }
            }
        }
        $hours = array('7:00 AM','7:50 AM','8:40 AM','9:30 AM','10:50 AM','11:40 AM','12:30 PM','1:20 PM','2:10 PM', '3:00 PM');
        return view('teachers.schedule.index')->with('subjectslist',$list)->with('hours',$hours);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if ($request->ajax()) {
        $subjectslist = new Subjectlist($request->all());
        $subjectslist->period = actualcicle(Carbon::now()->month);
        $subjectslist->year = Carbon::now()->year;
        $subjectslist->save();
        foreach ($request->list as $module) {
          $starttime = new Carbon($module['starttime']); //8:40
          $endtime = new Carbon($module['endtime']); //10:20
          $modules = ($starttime->diffInMinutes($endtime))/50;
          $count = 0;
          for ($i=0; $i <$modules; $i++) {
            $schedule = new Schedule;
            if($starttime->toTimeString() == '10:20:00'){
              $starttime = $starttime->addMinutes(30);
              $i++;
            }
            $schedule->module = $i + 1;
            $schedule->starttime = substr($starttime->addMinutes(50*$count)->toTimeString(),0,-3); //7:00-7:50
            $schedule->endtime = substr($starttime->addMinutes(50*($count+1))->toTimeString(),0,-3);//7:00-8:40
            $schedule->day = $module['day'];
            $schedule->subjectslist_idsubjectslist = $subjectslist->idsubjectslist;
            $schedule->save();
          }
        }
      }
        return response(['message'=>'La materia a sido dada de alta!','alert-type' => 'success']);
      }

// $tal=explode("-",$cadenatal);
// echo $tal[1];
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //P
    }
    public function showsubjectsacload(Request $request){
        if ($request->ajax()) {
            $career = Auth::user()->careers_idcareer;
            $cicle = actualcicle(Carbon::now()->month);
            $subjects = Subjectlist::where('semester',$request->semester)->where('year',Carbon::now()->year)->where('period',$cicle)
            ->where('career_idcareer',$career)->get();
            if(count($subjects)>0){
              $count = 0;
              foreach ($subjects as $subject) {
                  $subjectslist[$count]['idsubject'] = $subject->idsubjectslist;
                  $subjectslist[$count]['code'] = $subject->subject_code;
                  $subjectslist[$count]['name'] = $subject->subject->name;
                  $subjectslist[$count]['credits'] = $subject->subject->credits;
                  $count++;
              }
              return response(['subjects'=>$subjectslist,'exists'=>true]);
            }
            else
              return response(['exists'=>false]);

        }
    }
}
