<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request){
    // validate the form data
      $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required|min:6'
      ]);
    // Attempt to log the user in
      if (Auth::guard()->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)) {
    // if successful, thhen redirect to their intendent location
        return redirect()->intended(route('personal.index'));
      }
     // if unsuccessful, then dedirect back to the login with the form data
     $invalid = array('invalid' => true,'lala'=>'lala');
      return redirect()->back()->with($invalid)->withinput($request->all());
    }
}
