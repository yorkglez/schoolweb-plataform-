<?php

namespace App\Http\Controllers;
use App\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $subjects =Subject::Orderby('name','ASC')->paginate(5);
      return view('admin.subjects.index')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exists = Subject::find($request->code);
        if ($exists == null ) {
          $subject = new Subject($request->all());
          $subject->code = $request->code;
          $subject->save();
          $message = array(
          'message' => 'Materia creada exitosamente!',
          'alert-type' => 'success'
          );
          return back()->with($message);
        }else{
          $inuse = array('inuse' => true);
          return redirect()->back()->with($inuse)->withInput($request->all());
        }
    }
    public function updatesubject(Request $request)
    {
        if ($request->ajax()) {
          $subject = Subject::find($request->code);
          $subject->fill($request->all());
          $subject->save();
          return response(['update'=>true]);
        }
    }
    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return redirect()->back();
    }
}
