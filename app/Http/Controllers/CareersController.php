<?php

namespace App\Http\Controllers;
use App\Career;
use Illuminate\Http\Request;

class CareersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $careers = Career::search($request->search)->Orderby('name','ASC')->paginate(10);
        return view('admin.careers.index')->with('careers',$careers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.careers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exists = Career::find($request->code);
        if($exists == null){
          $career = new Career($request->all());
          $career->idcareer = $request->code;
          $career->save();
          $message = array(
          'message' => 'Carrera creada exitosamente!',
          'alert-type' => 'success'
          );
          return back()->with($message);
        }else{
          $message = array(
          'message' => 'Ocurrio un problema al intentar guardar!',
          'alert-type' => 'error'
          );
          $inuse = array('inuse' => true);
          return redirect()->back()->with($inuse)->with($message)->withInput($request->all());
        }


    }

    public function updatecareer(Request $request)
    {
        if ($request->ajax()) {
          $career = Career::find($request->id);
          $career->fill($request->all());
          $career->save();
          return response(['update'=>true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $career = Career::find($id);
        $career->delete();
        return redirect()->back();
    }
}
