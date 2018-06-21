<?php

namespace App\Http\Controllers;
use App\Subjectlist;
use Carbon\Carbon;
use App\Module;
use App\Standar;
use App\StudentSubject;
use Auth;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:teacher',['only' => ['create','moduleslist']]);
    }
    public function create()
    {
        $year =Carbon::now()->year;
        $teachernip = Auth::user()->teachernip;
        $subjectslist = Subjectlist::select('idsubjectslist','subject_code')->where('year',$year)
        ->where('teacher_teachernip',$teachernip)->get();
        if(count($subjectslist)>0){
          $subjectlist[$subjectslist[0]->idsubjectslist] = 'test';
          $count = 0;
          foreach ($subjectslist as $subject) {
              $subjectlist[$subjectslist[$count]->idsubjectslist] = $subject->subject->name;
              $count++;
          }
          return view('teachers.modules.create')->with('subjectlist',$subjectlist);
        }else{
          $alert = array('type'=>'info','head'=>'Sin materias!','message'=>'Aun no tienes materias asignadas, no te preocupes cuando estas se te asignen las podras ver :)');

          return view('teachers.alerts')->with('alert',$alert);
        }

    }
    public function moduleslist(Request $request){
        if ($request->ajax()) {
            $modules = Module::where('subjectslist_idsubjectslist',$request->subject)->Orderby('idmodule','ASC')->pluck('name','idmodule');
            if (count($modules)>0) {
                $students = StudentSubject::where('subjectslist_idsubjectslist',$request->subject)->get();
                $list[] = null;
                $count = 0;
                //$list[$students[0]->idstudent_subject]['name'] = $students[0]->academicload->student->name.' '.$students[0]->academicload->student->lastname;
                foreach ($students as $student) {
                    $list[$count] = array('idsubject' =>$student->idstudent_subject , 'name'=>$student->academicload->student->name.' '.$student->academicload->student->lastname);
                    $count++;
                }
                return response(['modules'=>$modules,'students'=>$list,'exists'=>true]);
            }else{
                return response(['exists'=>false]);
            }
        }
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
           $module = new Module;
           $module->name = $request->name;
           $module->subjectslist_idsubjectslist = $request->subjectcode;
           $module->save();
           foreach ($request->list as $list) {
                $standars = new Standar;
                $standars->name = $list['name'];
                $standars->value = $list['value'];
                $standars->module_idmodule = $module->idmodule;
                $standars->save();
           }
           return response(['message'=>'La unidad a sido guardada correctamente','alert-type' => 'success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
