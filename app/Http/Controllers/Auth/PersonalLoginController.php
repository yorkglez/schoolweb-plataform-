<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonalLoginController extends Controller
{
  public function __construct(){
    $this->middleware('guest:user',['except'=>['logout']]);
  }
  public function showLoginForm(){
    return view('auth.personal-login');
  }
  public function login(Request $request){
  // validate the form data
    $this->validate($request,[
      'email'=>'required|email',
      'password'=>'required|min:6'
    ]);
  // Attempt to log the user in
    if (Auth::guard('user')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)) {
  // if successful, thhen redirect to their intendent location
      return redirect()->intended(route('personal.index'));
    }
   // if unsuccessful, then dedirect back to the login with the form data
   $invalid = array('invalid' => true,'lala'=>'lala');
    return redirect()->back()->with($invalid)->withinput($request->all());
  }
  public function logout()
  {
      Auth::guard('user')->logout();
      return redirect('/');
  }
}
