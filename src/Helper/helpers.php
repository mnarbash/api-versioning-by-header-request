<?php


if (!function_exists('change_controller_path')) {
    function UseApiVersions(string $path)
    {
        $apiVersioningEnabled = config('api-versioning.api_versioning_enabled');

        if (!$apiVersioningEnabled) {
            return $path;
        }

        $apiVersion = app('request')->route()->parameter('api_version');
        $folder = config('api-versioning.folder', 'Apis');

        return str_replace('Controllers', "Controllers/{$folder}/{$apiVersion}", $path);
    }
}
