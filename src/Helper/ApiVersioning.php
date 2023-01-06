<?php

namespace Mnarbash\ApiVersioningByHeaderRequest\Helper;

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
            return $controllers[0];
        }

        $apiVersion = app('request')->header('API-VERSION');

        $notDoAnythingWhenVersionIsNotSet = config('api-versioning.not_do_anything_when_version_is_not_set');
        if ($notDoAnythingWhenVersionIsNotSet && !$apiVersion) {
            return $controllers[0];
        }

        if (!isset($controllers[$apiVersion])) {
            return response()->json([
                'errors' => ['API version not found for this controller'],
                'message' => 'API version not found for this controller'],
                404);
        }

        return $controllers[$apiVersion];

    }


}
