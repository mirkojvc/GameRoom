<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if($request->session()->has('user')){
            $user = $request->session()->get('user')[0];
            if(intval($user->roleId) === 1){
                return $next($request);
            } else {
                return redirect('/')->with('error','Nemate pravo pristupa ovoj stranici!');
            }
        }
        
        return redirect('/')->with('error','Nemate pravo pristupa ovoj stranici!');
    }
}
