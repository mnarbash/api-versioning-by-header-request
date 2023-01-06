<?php

namespace Mnarbash\ApiVersioningByHeaderRequest\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mnarbash\ApiVersioningByHeaderRequest\Exceptions\UnsupportedAppVersionException;

class CheckAppVersion
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('api-versioning.check_app_version_support')) {
            return $next($request);
        }

        $appVersion = $request->header('APP-VERSION');
        $appVersion = $appVersion ? $appVersion : config('api-versioning.default_app_version');


        $minSupportedAppVersion = config('api-versioning.min_supported_app_version');

        if($appVersion >= $minSupportedAppVersion) {
            return $next($request);
        }

        //throw UnsupportedAppVersionException::create($appVersion, $minSupportedAppVersion);

        return response()->json([
            'message' => 'Unsupported App Version',
            'data' => [
                'app_version' => $appVersion,
                'min_supported_app_version' => $minSupportedAppVersion,
            ],
            'errors' => [
                'app_version' => [
                    'Unsupported App Version',
                ],
            ],
        ], 422);
    }
}
