<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {

       /* if(!$request->has('foo')){
            return response(['status_code' => "400",
                'message' => "Error",
                'token'=>"00"
            ]);
        }*/


        if(!Auth::check()){
            return redirect('/login');
        }
        return $next($request);
    }
}
