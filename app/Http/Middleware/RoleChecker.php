<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;


class RoleChecker
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
        $Role    =   new Role;
        $type	 =   $request->route()->parameter('type');
        
        if($type != null)
        {
	        if($Role->checkRole($type)){
	            return $next($request);
	        }
	        \Flash::error('Invalid URL');
	        return redirect()->back();
        }

        return $next($request);
    }
}
