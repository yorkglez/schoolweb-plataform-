<?php

namespace App\Http\Controllers;
use App\Subjectlist;
use App\StudentSubject;
use App\Schedule;
use Auth;
use App\Attendances;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendancelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    { //,['only' => ['index','history']]
        $this->middleware('auth:teacher');
    }
    public function index()
    {
        $year =Carbon::now()->year;
        $teachernip = Auth::user()->teachernip;
        $subjectslist = Subjectlist::select('idsubjectslist','subject_code')->where('year',$year)
        ->where('teacher_teachernip',$teachernip)->get();
        if(count($subjectslist)>0){
          $subjectlist[0] = '-------------';
          $count = 0;
          foreach ($subjectslist as $subject) {
              $subjectlist[$subjectslist[$count]->idsubjectslist] = $subject->subject->name;
              $count++;
          }
          return view('teachers.attendancelist.index')->with('subjectlist',$subjectlist);
        }else{
            $alert = array('type'=>'info','head'=>'Sin materias!',
            'message'=>'Aun no tienes materias asignadas, no te preocupes cuando estas se te asignen podras utilizar el control de asistencias :)');
          return view('teachers.alerts')->with('alert',$alert);
        }
    }
    public function attupdate(Request $request){
      if ($request->ajax()) {
        $att = Attendances::find($request->code);
        $att->type = $request->type;
        $att->save();
        return response(['update'=>true]);
      }
    }
    public function showhistory(Request $request){
        $attlist = Attendances::join('student_subject','student_subject.idstudent_subject','student_subject_idstudent_subject')
        ->where('date_at',$request->date)->where('student_subject.subjectslist_idsubjectslist',$request->code)->get();
        $students[] = null;
        $count = 0;
        if (count($attlist)>0) {
          foreach($attlist as $list){
              $name = $list->student_subject->academicload->student->name.' '.$list->student_subject->academicload->student->lastname;
              $nip = $list->student_subject->academicload->student->studentnip;
              $students[$count] = array('idattendance' =>$list->idattendance ,'type'=>$list->type,'name'=>$name,'nip'=>$nip);
              $count++;
          };
          return response(['list'=>$students,'exists'=>true]);
        }
        else{
            return response(['exists'=>false]);
        }
    }
    public function history(){
      //  $students = StudentSubject::where('subjectslist_idsubjectslist',54)->get();
        $year =Carbon::now()->year;
        $teachernip = Auth::user()->teachernip;
        $subjectslist = Subjectlist::select('idsubjectslist','subject_code')->where('year',$year)
        ->where('teacher_teachernip',$teachernip)->get();
        if (count($subjectslist)>0) {
          $subjectlist[$subjectslist[0]->idsubjectslist] = 'test';
          $count = 0;
          foreach ($subjectslist as $subject) {
              $subjectlist[$subjectslist[$count]->idsubjectslist] = $subject->subject->name;
              $count++;
          }
          return view('teachers.attendancelist.history')->with('subjectlist',$subjectlist);
        }
        else{
          $alert = array('type'=>'info','head'=>'Sin materias!',
          'message'=>'Aun no tienes materias asignadas, no te preocupes cuando estas se te asignen podras utilizar el control de asistencias :)');
        return view('teachers.alerts')->with('alert',$alert);
        }
    }
    public function showassistancelist(Request $request){
        if ($request->ajax()) {
            $day = Carbon::now('America/Mexico_City')->format( 'l' );
            $modules = Schedule::where('subjectslist_idsubjectslist',$request->code)->where('day',$day)->get();
            $modules = count($modules);
            if ($modules > 0) {
              $students = StudentSubject::where('subjectslist_idsubjectslist',$request->code)->get();
              if(count($students) != 0){
                  $count = 0;
                  $list[$students[0]->idstudent_subject]['name'] = $students[0]->academicload->student->name.' '.$students[0]->academicload->student->lastname;
                  $list[$students[0]->idstudent_subject]['nip'] =  $students[0]->academicload->student->studentnip;
                  foreach ($students as $student) {
                      $list[$student->idstudent_subject]['name'] = $student->academicload->student->name.' '.$student->academicload->student->lastname;
                      $list[$student->idstudent_subject]['nip'] =  $student->academicload->student->studentnip;
                  }
                  return response(['list'=>$list,'modules'=>$modules,'exists'=>true]);
              }
            }
            else{
              return response(['exists'=>false]);
            }


        }
    }
    public function modulesofday(Request $request){
        if ($request->ajax()) {
          $day = Carbon::now('America/Mexico_City')->format( 'l' );
          // $day = 'Monday';
          $modules = Schedule::Orderby('idschedule','ASC')->where('day',$day)->where('subjectslist_idsubjectslist',$request->subject)->pluck('module','idschedule');
          return response(['modules'=>$modules]);
        }
    }
    public function storeassistancelist(Request $request){
        if ($request->ajax()) {
          $day = Carbon::now()->dayOfWeek;
          //$day = '1';
          $date = Carbon::now()->toDateString();
          if($request->allmodules > 0){
            for ($i=0; $i <$request->allmodules ; $i++) {
              foreach ($request->list as $student) {
                $attendance =  new Attendances;
                $attendance->student_subject_idstudent_subject = $student['code'];
                $attendance->type = $student['attendance'];
                $attendance->date_at = $date;
                $attendance->save();
              }
            }
          }
          else{
            foreach ($request->list as $student) {
              $attendance =  new Attendances;
              $attendance->student_subject_idstudent_subject = $student['code'];
              $attendance->type = $student['attendance'];
              $attendance->date_at = $date;
              $attendance->save();
            }
          }
          return response(['message'=>'Asistencias guardadas correctamente']);
        }
    }
    public function destroy($id)
    {
        //
    }
}
