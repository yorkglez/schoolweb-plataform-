<?php

namespace App\Http\Controllers;
use App\Academicload;
use App\StudentSubject;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class AcademicloadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth:student',['only' => ['create','store']]);
    }
    public function index()
    {

    }
    public function store_student(Reques $request){

    }

    public function showubjects($semester){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $month = Carbon::now()->month;
        $nip = Auth::user()->studentnip;
        $year = Carbon::now()->year;
        $actualcicle = actualcicle($month);
        $academicload = Academicload::where('students_studentnip',$nip)->where('cicle',$actualcicle)->where('date','LIKE',$year.'%')->first();
        if($academicload == null)
            $loadexists = false;
        else
            $loadexists = true;
        return view('students.academicload.create')->with('loadexists',$loadexists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            $date = Carbon::now()->toDateString();
            $turn = 'matutino';
            $studentnip = Auth::user()->studentnip;
            $academicload = new Academicload;
            $academicload->date = $date;
            $academicload->semester = $request->semester;
            $academicload->turn = $turn;
            $academicload->cicle = actualcicle(Carbon::now()->month);
            $academicload->students_studentnip = $studentnip;
            $academicload->save();
            $size = count($request->subjects);
            for ($i=0; $i < $size ; $i++) {
                $subjectslist = new StudentSubject;
                $subjectslist->academicload_idacademicload = $academicload->idacademicload;
                $subjectslist->subjectslist_idsubjectslist =  $request->subjects[$i];
                $subjectslist->save();
            }
            return response(['save'=>true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
