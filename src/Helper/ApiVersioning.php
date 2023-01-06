<?php
namespace Mnarbash\ApiVersioningByHeaderRequest\Helper;

class ApiVersioning{
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
}
