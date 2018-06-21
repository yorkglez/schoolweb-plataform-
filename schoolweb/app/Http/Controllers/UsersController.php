<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $users = User::search($request->search)->Orderby('iduser','ASC')->paginate('10');
      return view('admin.users.index')->with('users',$users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        if($user->save()){
          $message = array(
          'message' => 'Usuario creado exitosamente!',
          'alert-type' => 'success'
          );
          return redirect()->back()->with($message);
        }

    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit')->with('user',$user);
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->type = $request->type;
        if($request->password != '')
          $user->password = Hash::make($request->password);
        $user->save();
        $message = array(
        'message' => 'EL usuario ha sido modificado exitosamente!',
        'alert-type' => 'info'
        );
        return redirect()->route('users.index')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $message = array(
        'message' => 'EL usuario ha sido eliminado',
        'alert-type' => 'info'
        );
        return redirect()->route('users.index')->with($message);

    }
}
