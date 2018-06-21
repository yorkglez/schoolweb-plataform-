<?php

namespace App\Http\Controllers;
use App\Subjectlist;
use Carbon\Carbon;
use App\Module;
use App\Rating;
use App\Standar;
use Auth;
use App\Assignment;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:teacher',['only' => ['index','store','storescore']]);
    }

    public function index()
    {
        $year = Carbon::now()->year;
        $teachernip = Auth::user()->teachernip;
        $subjectslist = Subjectlist::select('idsubjectslist','subject_code')->where('year',$year)
        ->where('teacher_teachernip',$teachernip)->get();
        $subjectlist[0] = '----';
        $count = 0;
        foreach ($subjectslist as $subject) {
            $subjectlist[$subjectslist[$count]->idsubjectslist] = $subject->subject->name;
            $count++;
        }
        return view('teachers.assignments.index')->with('subjectlist',$subjectlist);
    }
    public function getmodules(Request $request){
        if ($request->ajax()) {
            $module = Module::Orderby('idmodule','ASC')->where('subjectslist_idsubjectslist',$request->subject);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showassignaments()
    {
        if ($request->ajax()) {
            foreach ($module->standars as $standars) {
                foreach ($standars->assignments as $assignments) {
                    $listassigments[$assignments->idassignment] = $assignments->name;
                }
            }
            return response(['assignments'=>$assignments]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storescore(Request $request)
    {
        if ($request->ajax()) {
            $rating = new Rating;
            $rating->score = $request->score;
            $rating->assignment_idassignment = $request->assignament;
            $rating->student_subject_idstudent_subject  = $request->student;
            $rating->save();
            return response(['store'=>true]);
        }
    }
    public function store(Request $request){
        if ($request->ajax()) {
            $number = Standar::where('idstandar',$request->standar)->first();
            $number->number = $number->number + 1;
            $number->save();
            $assignment = new Assignment;
            $assignment->name = $request->name;
            $assignment->standars_idstandars = $request->standar;
            $assignment->save();
            return response(['store'=>true,'assignment'=>$assignment]);
        }
    }
    public function destroy($id)
    {
        //
    }
}
