<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Controllers\API\ApiController as Api;
use function Helper\Common\__lang;

class ApiVersion
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
        $api = new Api();
        //check api access
        if(!$api->checkVersion())
        {
            return $api->respondBadRequest(__lang("api_version_changed"));
        }
        return $next($request);
    }
}
