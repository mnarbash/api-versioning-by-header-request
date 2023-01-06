<?php

namespace Mnarbash\ApiVersioningByHeaderRequest\Helper;

use Mnarbash\ApiVersioningByHeaderRequest\Exceptions\UnsupportedApiVersionException;

class ApiVersioning
{

    public static function UseApiMultiVersions(array $controllers)
    {
        if(!is_array($controllers)) {
            throw new \Exception('Controllers must be an array');
        }

        $apiVersioningEnabled = config('api-versioning.api_versioning_enabled');


        if (!$apiVersioningEnabled) {
            return $controllers['0'];
        }

        $apiVersion = app('request')->header('API-VERSION');

        $notDoAnythingWhenVersionIsNotSet = config('api-versioning.not_do_anything_when_version_is_not_set');
        if ($notDoAnythingWhenVersionIsNotSet && !$apiVersion) {
            return $controllers['0'];
        }

        if (!isset($controllers[$apiVersion])) {

            $apiVersion = self::GetOlderApiVersion($controllers,$apiVersion);
            
            if (!isset($controllers[$apiVersion])) {
                throw UnsupportedApiVersionException::create($apiVersion);
            }
        }

        return $controllers[$apiVersion];

    }

    public static function GetApiVersion()
    {
        $apiVersion = app('request')->header('API-VERSION');
        $apiVersion = $apiVersion ? $apiVersion : config('api-versioning.default_api_version');
        return $apiVersion;
    }

    private static function GetOlderApiVersion(array $controllers, $apiVersion)
    {
        //api version will be lock like V1 or V2 or V3
        $apiVersions = array_keys($controllers);
        rsort($apiVersions);
        foreach ($apiVersions as $version) {
            if ($version <= $apiVersion) {
                return $version;
            }
        }
        return $apiVersion;
    }

    private static function GetNewestApiVersion(array $controllers)
    {
        $apiVersions = array_keys($controllers);
        rsort($apiVersions);
        return $apiVersions[0];
    }


}
