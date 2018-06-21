<?php

namespace App\Http\Controllers;
use App\Teacher;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
class TeacherController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:teacher');
    }
    public function index()
    {
        return view('teachers.index');
    }
    public function porfile(){
    	$teachernip = Auth::user()->teachernip;
    	$datateacher = Teacher::find($teachernip);
    	return view('teachers.porfile.index')->with('datateacher',$datateacher);
    }
     public function updateinfo(Request $request){
        if ($request->ajax()) {
            $nip = Auth::user()->teachernip;
            $teacher = Teacher::find($nip);
            $teacher->fill($request->all());
            $teacher->save();
            return response(['update'=>true]);
        }
    }
    public function changepassword(Request $request){
        $oldpass = $request->oldpass;
        $newpass = $request->newpass;
        $nip = Auth::user()->teachernip;
        $teacher = Teacher::find($nip);
        $actualpass = $teacher->password;
        if (Hash::check($oldpass,$actualpass)) {
            $teacher->password =  Hash::make($newpass);
            $teacher->save();
        }
        else
           return response(['validation'=>false]); 
        return response(['validation'=>true]); 
    }
}
