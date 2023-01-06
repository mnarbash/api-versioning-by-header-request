# Laravel API Versioning By Header Request

This package provides middleware for managing API versioning in Laravel using request headers.

## Features

- **API versioning by header request**: This package allows you to version your API by adding the `API-VERSION` header
  to the request. You can specify the supported API versions and the default API version in the configuration file.

- **App version checking**: This package includes a middleware that checks the `APP-VERSION` header in the request
  against the supported app versions and the minimum supported app version specified in the configuration file. If the
  app version is not supported, the middleware returns an error response to update app.

- **Customizable folder structure**: You can specify a custom folder structure for the API versions in the configuration
  file. This allows you to organize your controllers and routes in a way that makes sense for your application.

- **Global middleware**: Both the app version checking and API versioning middlewares are global, which means they will
  be applied to all routes in your application.

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
<ul><li><p><code>check_app_version_support</code>: This option tells the package whether to check the app version support. If set to <code>true</code>, the package will check the app version and return an error response if the app version is not supported.</p></li><li><p><code>api_versioning_enabled</code>: This option tells the package whether to enable API versioning. If set to <code>true</code>, the package will check the <code>API-VERSION</code> header in the request and use it to determine the version of the API to be used.</p></li><li><p><code>default_api_version</code>: This option specifies the default API version to be used when the <code>API-VERSION</code> header is not present in the request.</p></li><li><p><code>not_do_anything_when_version_is_not_set</code>: This option tells the package whether to do anything when the version is not set. If set to <code>true</code>, the package will not change the controller name when the version is not set.</p></li><li><p><code>folder</code>: This option specifies the folder name where the versioned controllers are located. If set to an empty string, the versioned controllers will be placed in the same folder as the original controllers.</p></li><li><p><code>default_app_version</code>: This option specifies the default app version to be used when the <code>APP-VERSION</code> header is not present in the request.</p></li><li><p><code>min_supported_app_version</code>: This option specifies the minimum supported app version. If the app version in the request</p></li></ul>

## Middleware

The package includes the following middleware:

- `CheckAppVersion`: This middleware checks the app version in the `APP-VERSION` request header. If the version is not
  supported, it returns an error.
- `CheckApiVersion`: This middleware checks the API version in the `API-VERSION` request header. If the header is not
  present, it uses the default version specified in the configuration.

To use the check api and riderct to new controller, apply it to a route as follows:

```php
 Route::get('testVer', ApiVersioning::UseApiVersions([Test::class, 'testVer']));
```

to use the check app middleware, apply it to a api $middlewareGroups in app/Http/Kernel file as follows:

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
