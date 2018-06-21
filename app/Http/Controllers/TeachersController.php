<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers = Teacher::search($request->search)->Orderby('name','ASC')->paginate(5);
        return view('personal.teachers.index')->with('teachers',$teachers);
    }
    public function teacherslist(Request $request)
    {
        $teachers = Teacher::searchall($request->search)->Orderby('name','ASC')->paginate(5);
        return view('admin.teachers.index')->with('teachers',$teachers);
    }
    public function editstatus(Request $request,$id){
      $teacher = Teacher::find($id);
      $teacher->status = $request->statuss;
      $teacher->save();
      return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personal.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkemail = Teacher::select('email')->where('email',$request->email)->first();
        if ($checkemail == null) {
          $lastnip = Teacher::select('teachernip')->Orderby('created_at','desc')->first();
          $year = substr(Carbon::now()->year,-2);
          $newnip = substr($lastnip->teachernip,5)+1;
          $nip = $year.'691'.$newnip;
          $teacher = new Teacher($request->all());
          $tmpcode = temporalcode(8);
          // $teacher->password = Hash::make($tmpcode);
          $teacher->password = Hash::make('password');
          $teacher->teachernip = $nip;
          $email = $request->email;
          $usertype = 'Maestro';
          $portal = 'Maestros';
          $teacher->save();
          return view('personal.registercomplete')->with('tmpcode',$tmpcode)->with('email',$email)->with('usertype',$usertype)
          ->with('portal',$portal);
        }else{
          $invalid = array('invalid'=>true);
          return redirect()->back()->withInput($request->all())->with($invalid);
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
