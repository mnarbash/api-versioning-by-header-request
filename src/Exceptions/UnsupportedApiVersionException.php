<?php

namespace Mnarbash\ApiVersioningByHeaderRequest\Exceptions;

use Exception;

class UnsupportedApiVersionException extends Exception
{
    public static function create(string $apiVersion): self
    {
        return new self("Unsupported api version: {$apiVersion}.");
    }
}
