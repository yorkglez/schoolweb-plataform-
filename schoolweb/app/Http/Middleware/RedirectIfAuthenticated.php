<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

      // if (Auth::user() != null){
      //     dd(Auth::user());
      //   if (Auth::user()->type === 'personal'){
      //     dd('personal');
      //   }
      // }
      // else{
      //   return $next($request);
      // }
        if (Auth::guard($guard)->check()) {
        //  return redirect('/home');
          if (Auth::user()->type === 'personal'){
            return redirect('/personal');
          }
          else if (Auth::user()->type === 'admin'){
              return redirect('/admin');
          }
        }
        else if (Auth::guard('student')->check()){
            return redirect('/student');
        }
        else if (Auth::guard('teacher')->check()){
            return redirect('/teacher');
        }

        return $next($request);
        // return redirect('/student/login');

    }
}
