# API Versioning By Header Request

This package provides middleware for managing API versioning in Laravel using request headers.

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

This will create a `config/api-versioning-by-header-request.php` file in your project. You can modify the following options in this file:

- `supported_versions`: An array of supported API versions.
- `default_version`: The default API version to use if the `API-VERSION` request header is not present.
- `min_supported_app_version`: The minimum supported app version.
- `check_app_version_support`: A boolean value indicating whether to check the app version in the `APP-VERSION` request header.
- `api_versioning_enabled`: A boolean value indicating whether API versioning is enabled.

## Middleware

The package includes the following middleware:

- `CheckAppVersion`: This middleware checks the app version in the `APP-VERSION` request header. If the version is not supported, it returns an error.
- `CheckApiVersion`: This middleware checks the API version in the `API-VERSION` request header. If the header is not present, it uses the default version specified in the configuration.

To use the middleware, apply it to a route as follows:
```sh
Route::get('/', function () {
//
})->middleware('check.app.version', 'check.api.version');
```

This will apply both middleware to the route, so that the app version and API version are checked for each request.

## License

This package is licensed under the MIT license. See the `LICENSE` file for more information.
