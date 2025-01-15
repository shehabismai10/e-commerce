<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {


        if(!Auth::check()){
            return redirect()->route('login');
        }


        $authrUseRole=Auth::user()->role;

    switch($role){
        case 'admin':
                if($authrUseRole == 0){
                        return $next($request);
                }
                break;
        case 'vendor':
                if($authrUseRole == 1){
                    return $next($request);
            }
            break;


        case 'user':
                if($authrUseRole == 2){
                    return $next($request);
            }
            break;

        }

        switch($authrUseRole){

            case 0:
                return redirect()->route('admin-dashboard');
            case 1:
                return redirect()->route('vendor-dashboard');
            case 2:
                    return redirect()->route('dashboard');    
    
        }
        //if no role defiend

        return redirect()->route('login');
    }
}
