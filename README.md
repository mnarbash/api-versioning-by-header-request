# Laravel API Versioning By Header Request
[![Latest Version on Packagist](https://img.shields.io/packagist/v/mnarbash/api-versioning-by-header-request.svg?style=flat-square)](https://packagist.org/packages/mnarbash/api-versioning-by-header-request)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/mnarbash/api-versioning-by-header-request.svg?style=flat-square)](https://packagist.org/packages/mnarbash/api-versioning-by-header-request)


This package provides middleware for managing API versioning in Laravel using request headers.

## Features

- **You Not Need To Change Your Routes Endpoints**. You can use the same endpoints for all versions of your API.
- **API versioning by header request**: This package allows you to version your API by adding the `API-VERSION` header
  to the request. You can specify the supported API versions and the default API version in the configuration file.

- **App version checking**: This package includes a middleware that checks the `APP-VERSION` header in the request
  against the supported app versions and the minimum supported app version specified in the configuration file. If the
  app version is not supported, the middleware returns an error response to update app.

- **Customizable folder structure**: You can specify a custom folder structure for the API versions in the configuration
  file. This allows you to organize your controllers and routes in a way that makes sense for your application.

- **Api Versioning base on your controller classes**: The package allows you to version your API by multi controller
  classes in
  your route define.

## Installation

To install the package, run the following command:

```sh
composer require mnarbash/api-versioning-by-header-request
```

## Configuration

Add ServiceProvider to `config/app.php` in `providers` section:

```php  
Mnarbash\ApiVersioningByHeaderRequest\ApiVerServiceProvider::class,
```

To configure the package, publish the configuration file using the following command:

```sh
php artisan vendor:publish --provider="Mnarbash\ApiVersioningByHeaderRequest\ApiVerServiceProvider" --tag=config
```

This will create a `config/api-versioning.php` file in your project. You can modify the following options in this file:
- <code>check_app_version_support</code>: This option tells the
package whether to check the app version support.
If set to <code>true</code>, the package will check the 
app version and return an error response if the app version 
is not supported.
- <code>api_versioning_enabled</code>: 
This option tells the package whether to enable API 
versioning. If set to <code>true</code>, the package will check
the <code>API-VERSION</code> header in the request and use it 
to determine the version of the API to be used.
- <code>default_api_version</code>: 
This option specifies the default API version to be used when 
the <code>API-VERSION</code> header is not present in the request.
- <code>not_do_anything_when_version_is_not_set</code>: 
This option tells the package whether to do anything when the 
version is not set. If set to <code>true</code>, the package
will not change the controller name when the version is not set.

- <code>default_app_version</code>: This option specifies the 
default app version to be used when the <code>APP-VERSION</code> 
header is not present in the request.
- <code>min_supported_app_version</code>: 
This option specifies the minimum supported app version.
If the app version in the request is less than this version, 
return an error response.
- <code>update_urls</code>: This option specifies the URLs to show update app.
- <code>not_support_response_status_code</code>: this option specifies the status code of the 
response when the app version is not supported.

To use the check api and redirect to new controller, apply it to a route as follows:

-**Note**: Add the newer controller in the first of array. We use this order
to check the version and redirect to the older controller if version is not exist.
**Example**: If you have 2 controller with version 1 and 2 and you want
to redirect to version 1 if version 2 is not exist,

```php
    Route::get('testVer', ApiVersioning::UseApiMultiVersions([
        'V1' => [V1TestApiController::class, 'testVer'],
        'V0' => [TestApiController::class, 'testVer'], 
        '0' => [TestApiController::class, 'testVer'] //set default version if not set in header
    ]))

```

## Full Example For Route File

```php
Route::prefix('test')->group( function () {
    Route::get('func', ApiVersioning::UseApiMultiVersions(
        [
            '0'=> function () {
                return 'version 0 or default version';
            },
            'V1' => function () {
                return 'v1';
            },
            'V2' => function () {
                return 'v2';
            },
            'V3' => function () {
                return 'v3';
            },
            'V5' => function () {
                return 'v5';
            },
        ]
    ));

    Route::get('controller', ApiVersioning::UseApiMultiVersions(
        [
            '0'=> [V0TestController::class, 'index'],
            'V1' =>  [V1TestController::class, 'index'],
            'V2' =>  [V2TestController::class, 'index'],
            'V3' =>  [V3TestController::class, 'index'],
            'V5' =>  [V5TestController::class, 'index'],
        ]
    ));
    Route::resource('res', ApiVersioning::UseApiMultiVersions(
        [
            '0'=> ResourceController::class,
            'V2'=> V2ResourceController::class,
        ]
    ));
});
```

Also you can get api version from anywhere in your code like this:

```php
    $apiVersion = ApiVersioning::getApiVersion();
```

The package includes the `CheckAppVersion` middleware:

- `CheckAppVersion`: This middleware checks the app version in the `APP-VERSION` request header. If the version is not
  supported, it returns an error.

- to use the check app middleware, apply it to a api $middlewareGroups in app/Http/Kernel file as follows:

```php
    use Mnarbash\ApiVersioningByHeaderRequest\Middleware\CheckAppVersion;

    protected $middlewareGroups = [
        'api' => [
        // ...
                  CheckAppVersion::class,
        ],
    ];

```

## License

This package is licensed under the MIT license. See the `LICENSE` file for more information.
