<?php

namespace App\Http\Controllers;
use App\Student;
use App\Career;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  public function __construct()
    // {
    //     $this->middleware('auth:student');
    // }
    public function index(Request $request)
    {
      $students = Student::searchall($request->search)->status($request->status)->Orderby('name','ASC')->paginate(10);
      $students->each(function($students){
        $students->career;
      });
      return view('admin.students.index')->with('students',$students);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $careers = Career::all()->pluck('name','idcareer');
        return view('personal.students.create')->with('careers',$careers);
    }
    public function indexstudentsbyscareer(){

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkemail = Student::select('email')->where('email',$request->email)->first();
        if($checkemail == null){
          $career =  $request->career_id;
          $lastnip = Student::select('studentnip')->Orderby('studentnip','desc')->where('careers_idcareer',$career)->first();
          $year = substr(Carbon::now()->year,-2);
          $careercode = substr($career,10);
          $student = new Student($request->all());
          $uniqued =substr($lastnip->studentnip,5)+1;
          $nip = $year.$careercode.$uniqued;
          $student->studentnip = $nip;
          $student->careers_idcareer = $request->career_id;
          $tmpcode = temporalcode(8);
          //$student->password = Hash::make($tmpcode);
          $student->password = Hash::make('password');
          $student->save();
          $email = $request->email;
          $usertype = 'Alumno';
          $portal = 'Alumnos';
          return view('personal.registercomplete')->with('tmpcode',$tmpcode)->with('email',$email)
          ->with('usertype',$usertype)->with('portal',$portal);
        }
        else{
          $invalid = array('invalid' =>true);
          return redirect()->back()->withInput($request->all())->with($invalid);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $students = Student::searchall($request->search)->select('studentnip','name','lastname','address','postalcode','phone','email','careers_idcareer')->where('careers_idcareer',$id)->Orderby('studentnip','ASC')->paginate(20);
        if($students->first() != null){
            $code = $students->first()->career_idcareer;
            $students->each(function($students){
                $students->career;
            });
        }
        return view('personal.students.show')->with('students',$students)->with('code',$id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      $student = Student::find($id);
      $student->status = $request->statuss;
      $student->save();
      return redirect()->back();
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
