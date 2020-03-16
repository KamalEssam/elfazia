<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Controllers\API\ApiController as Api;
use function Helper\Common\__lang;

class AuthWeb
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
        if(auth()->check()){
            return $next($request);
        }else{
            return redirect("login");
        }
    }
}
