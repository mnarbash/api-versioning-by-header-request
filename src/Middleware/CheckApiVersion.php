<?php

namespace Mnarbash\ApiVersioningByHeaderRequest\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiVersion
{
    public function handle(Request $request, Closure $next)
    {
        $apiVersion = $request->header('API-VERSION');
        $apiVersion = $apiVersion ?: config('api-versioning.default_version');

        $request->route()->setParameter('api_version', $apiVersion);

        return $next($request);
    }
}
