<?php
namespace Mnarbash\ApiVersioningByHeaderRequest\Helper;

class ApiVersioning{
    public static function UseApiVersions(array $path)
    {
        $apiVersioningEnabled = config('api-versioning.api_versioning_enabled');


        if (!$apiVersioningEnabled) {
            return $controller;
        }

        $apiVersion = app('request')->route()->parameter('api_version');

        $notDoAnythingWhenVersionIsNotSet = config('api-versioning.not_do_anything_when_version_is_not_set');
        if ($notDoAnythingWhenVersionIsNotSet && !$apiVersion) {
            return $path;
        }

        $folder = config('api-versioning.folder', '');
        $folder = $folder ? $folder . '/' : '';

        $controller[0] = str_replace('Controllers', "Controllers/{$folder}{$apiVersion}", $controller[0]);
        $controller[1] = $apiVersion . $controller[1];

        return $controller;
    }
}