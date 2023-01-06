<?php

namespace Mnarbash\ApiVersioningByHeaderRequest\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mnarbash\ApiVersioningByHeaderRequest\Exceptions\UnsupportedAppVersionException;

class CheckAppVersion
{
    public function handle(Request $request, Closure $next)
    {
        $appVersion = $request->header('APP-VERSION');

        if (!$appVersion) {
            return $next($request);
        }

        $supportedVersions = config('api-versioning-by-header-request.supported_versions');
        $minSupportedAppVersion = config('api-versioning-by-header-request.min_supported_app_version');
        $checkAppVersionSupport = config('api-versioning-by-header-request.check_app_version_support');

        if (!$checkAppVersionSupport || in_array($appVersion, $supportedVersions)) {
            return $next($request);
        }

        throw UnsupportedAppVersionException::create($appVersion, $minSupportedAppVersion);
    }
}
