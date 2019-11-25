<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class AdminAuth 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    
	
	 public function handle($request, Closure $next)
    {
        $adminId = session()->get('loginId');
		//echo("ok");
		//exit;
		
        if(empty($adminId)){
			
			return 	redirect('login');
        }
        return $next($request);
    }
	
}
