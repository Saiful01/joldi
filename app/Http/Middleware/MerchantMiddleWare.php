<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MerchantMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);

        if (!Auth::guard('merchant')->check()) {
            return redirect('/logout');
        } else {

            if (!Auth::guard('merchant')->user()->active_status) {

                return redirect('/merchant/login')->with('failed', 'Your account is not activate yet.');
            }


        }
        return $next($request);
    }
}
