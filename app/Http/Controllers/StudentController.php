<?php

namespace App\Http\Controllers;

use Auth;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('students.index');
    }
    public function porfile(){
        $nip = Auth::user()->studentnip;
        $datastudent = Student::find($nip);
        // $datastudent->each(function($datastudent){
        //     $datastudent->career;
        // });
        return view('students.porfile.index')->with('datastudent',$datastudent);
    }
    public function updateinfo(Request $request){
        if ($request->ajax()) {
            $nip = Auth::user()->studentnip;
            $student = Student::find($nip);
            $student->fill($request->all());
            $student->save();
            return response(['update'=>true]);
        }
    }
    public function changepassword(Request $request){
        $oldpass = $request->oldpass;
        $newpass = $request->newpass;
        $nip = Auth::user()->studentnip;
        $student = Student::find($nip);
        $actualpass = $student->password;
        if (Hash::check($oldpass,$actualpass)) {
            $student->password =  Hash::make($newpass);
            $student->save();
        }
        else{
           return response(['validation'=>false]);
        }
        return response(['validation'=>true]);
    }
  
}
