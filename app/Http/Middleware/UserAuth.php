<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('userData')){
            $prefix = 'v2';
            if(Session::get('userData')['MODULE_ID']==1){
                if(request()->is($prefix . '*')){
                    abort(404);
                }
            }
            if(Session::get('userData')['MODULE_ID']==2){
                if(!request()->is($prefix . '*')){
                    abort(404);
                }
            }
            return $next($request);
        }else{
            return redirect()->route('portal.login');
        }
    }
}
