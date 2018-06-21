<?php

namespace App\Http\Controllers;
use App\Rating;
use App\Academicload;
use App\Student;
use App\Subjectlist;
use App\StudentSubject;
use Carbon\Carbon;
use App\Module;
use Auth;
use App\Ratingsreport;
use Illuminate\Http\Request;

class RatingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:student',['only' => ['index_student','availablesubjects','ratingsreport']]);
        $this->middleware('auth:teacher',['only' => ['create','store','studentlist','getmodules']]);
    }
    public function index()
    {
        return view('personal.ratings.index');
    }
    public function index_student(){
      return view('students.ratings.index');
    }
    public function availablesubjects(Request $request){
      if ($request->ajax()) {
        $cicle = $request->cicle;
        $year = $request->year;
        $academicload = Academicload::where('cicle',$cicle)->where('date','LIKE',$year.'%')->first();
        $count = 0;
        if(count($academicload)>0){
          $subjects = StudentSubject::where('academicload_idacademicload',$academicload->idacademicload)->get();
          foreach ($subjects as $subject) {
            $tm[$count] = count($subject->subjectlist->modules);
            $count++;
            if($subject->ratingreport != null){
              foreach ($subject->ratingreport as $report) {
                $module = $report->module->name;
                $listreport[$report->idratingsreport] = array('averange' =>$report->averange,'module'=>$module);
              }
              if ($listreport != null)
                $ratings[$subject->subjectlist->subject->name] = $listreport;
              $listreport = null;
            }
          }
          return response(['exists'=>true,'$ratings'=>$ratings,'tm'=>$tm]);
          }
          else
            return response(['exists'=>false]);
        }
    }
    public function show_studentsubjects(){
        dd();

    }
    public function ratingsreport(Request $request){
      if ($request->ajax()) {
        $reports = Ratingsreport::where('studentsubject_idstudentsubject',$request->subject)->get();
        foreach ($reports as $report) {
          $averange = $report->averange;

        }
      }
    }
    public function searchnip(Request $request){
        if ($request->ajax()) {
            $student = Student::find($request->nip);
            if($student == null){
                return response(['nip'=>'null']);
            }
        }
    }
    public function create()
    {
        $year = Carbon::now()->year;
        $period = actualcicle(Carbon::now()->month);
        $teachernip = Auth::user()->teachernip;
        $subjects = Subjectlist::where('year',$year)->where('period',$period)->where('teacher_teachernip',$teachernip)->get();
            $listsubjects[0] = '----';
        foreach ($subjects as $subject) {
            $listsubjects[$subject->idsubjectslist] = $subject->subject->name;
        }
        return view('teachers.ratings.create')->with('listsubjects',$listsubjects);
    }
    public function studentlist(Request $request){
        if ($request->ajax()) {
            $students = StudentSubject::where('subjectslist_idsubjectslist',$request->subject)->get();
            foreach ($students as $student) {
               $exists = Ratingsreport::where('studentsubject_idstudentsubject',$student->idstudent_subject)->where('module_idmodule',$request->module)->first();
                if (count($exists) == 0)
                    $list[$student->idstudent_subject] = $student->academicload->student->name.' '.$student->academicload->student->lastname;
            }
            if (count($list)>0)
                return response(['students'=>$list,'exists'=>true]);
            else
                return response(['exists'=>false]);

        }


    }
    public function store(Request $request){
        if ($request->ajax()) {
            $report = new Ratingsreport;
            $module = Module::where('idmodule',$request->module)->first();
            $averange = 0;
            foreach ($module->standars as $standar) {
                $number = $standar->number;
                $value = $standar->value;
                $score = 0;
                $count = 0;
                $total = 0;
                if ($number>0) {
                    foreach ($standar->assignments as $asassignment) {
                        $idassig = $asassignment->idassignment;
                        $rating = Rating::where('assignment_idassignment',$idassig)->where('student_subject_idstudent_subject',$request->student)->first();
                        if(count($rating)>0)
                            $score = ($score + $rating->score);
                        $count++;
                    }
                    if ($count>0){
                        $total = number_format(($score/$number)*($value/100),2,'.', '');
                        $averange = $averange + $total;
                    }
                }
                $report->averange = $averange;
                $report->module_idmodule = $request->module;
                $report->studentsubject_idstudentsubject = $request->student;
                $report->save();

            }
            return response(['store'=>true]);
        }
    }
    public function getmodules(Request $request)
    {
        if($request->ajax()){
            $modules = Module::where('subjectslist_idsubjectslist',$request->subject)->Orderby('idmodule','ASC')->pluck('name','idmodule');
            return response(['modules'=>$modules]);
        }

    }
    public function destroy($id)
    {
        //
    }
}
