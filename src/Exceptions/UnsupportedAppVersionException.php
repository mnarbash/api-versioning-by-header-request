<?php

namespace Mnarbash\ApiVersioningByHeaderRequest\Exceptions;

use Exception;

class UnsupportedAppVersionException extends Exception
{
    public static function create(string $appVersion, string $minSupportedAppVersion): self
    {
        return new self("Unsupported app version: {$appVersion}. Minimum supported app version: {$minSupportedAppVersion}.");
    }
}
