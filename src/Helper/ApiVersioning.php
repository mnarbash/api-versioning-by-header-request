<?php

namespace Mnarbash\ApiVersioningByHeaderRequest\Helper;

use Mnarbash\ApiVersioningByHeaderRequest\Exceptions\UnsupportedApiVersionException;

class ApiVersioning
{
    public static function UseApiVersions(array $controller)
    {
        $apiVersioningEnabled = config('api-versioning.api_versioning_enabled');


        if (!$apiVersioningEnabled) {
            return $controller;
        }

        $apiVersion = app('request')->header('API-VERSION');

        $notDoAnythingWhenVersionIsNotSet = config('api-versioning.not_do_anything_when_version_is_not_set');
        if ($notDoAnythingWhenVersionIsNotSet && !$apiVersion) {
            return $controller;
        }

        $folder = config('api-versioning.folder', '');
        $folder = $folder ? $folder . '\\' : '';

        $controller[0] = str_replace('Controllers\\', "Controllers\\{$folder}{$apiVersion}\\{$apiVersion}", $controller[0]);
        return $controller;
    }


    public static function UseApiMultiVersions(array $controllers)
    {
        $apiVersioningEnabled = config('api-versioning.api_versioning_enabled');


        if (!$apiVersioningEnabled) {
            return $controllers['default'];
        }

        $apiVersion = app('request')->header('API-VERSION');

        $notDoAnythingWhenVersionIsNotSet = config('api-versioning.not_do_anything_when_version_is_not_set');
        if ($notDoAnythingWhenVersionIsNotSet && !$apiVersion) {
            return $controllers['default'];
        }

        if (!isset($controllers[$apiVersion])) {
            throw UnsupportedApiVersionException::create($apiVersion);
        }

        return $controllers[$apiVersion];

    }

    public static function GetApiVersion()
    {
        $apiVersion = app('request')->header('API-VERSION');
        $apiVersion = $apiVersion ? $apiVersion : config('api-versioning.default_api_version');
        return $apiVersion;
    }


}
