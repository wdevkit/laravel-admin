
# Admin scaffolding for Laravel

This package allows you to scafold a simple _admin_ structure to your application. It's Laravel 8 compatible!

## Installation

You can install the package via composer:

```bash
composer require wdevkit/laravel-admin
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Wdevkit\Admin\AdminServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Wdevkit\Admin\AdminServiceProvider" --tag="config"
```

You can publish the routes file with:
```bash
php artisan vendor:publish --provider="Wdevkit\Admin\AdminServiceProvider" --tag="routes"
```

You can publish the views files with:
```bash
php artisan vendor:publish --provider="Wdevkit\Admin\AdminServiceProvider" --tag="views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

### Create Admin

To create a admin user, you can use the `admin:create` command.

```bash
php artisan admin:create
```
You will be asked to input a admin name, email, password and password confirmation. Alternatively, you can use the one line command to input all the required arguments:

```bash
php artisan admin:create "John Doe" johndoe@email.test 1234 1234
```

### Guard & User provider Structure



After publishing the migrations, the model `Wdevkit\Admin\Models\Admin::class` will be available. You can use this model to define a new user provider in the `config/auth.php` file:

```php
return [

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        // new user provider
        'admins' => [
            'driver' => 'eloquent',
            'model' => Webdk\Admin\Models\Admin::class,
        ],
    ],
];
```

By creating the `admins` user provider, you can use it in your _guards_ (web, api) or you can create a new _guard_ which uses the _admins_ user provider in the `config/auth.php` file:

```php
return [

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'admins', // you can update the `web` guard to use the `admins` user provider
        ],

        // or you can create your own `guard` with the `admins` user provider.
        'web_admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ]
    ],
];
```

When using the auth structure with the `web_admin` guard, you should also update the `app/Http/Middleware/Authenticate.php` middleware to correctly redirect the request to the admin login route, by updating the `redirectTo` method:

```php
protected function redirectTo($request)
{
    if (! $request->expectsJson()) {

        // ensure it will redirect to correct login route.
        if ($request->is('admin/*')) {
            return route('wdevkit_admin.login');
        }

        return route('login');
    }
}
```

And also update the method `handle` on the `app/Http/Middleware/RedirectIfAuthenticated.php` middleware to correctly redirect to the admin home page when already authenticated:

```php
public function handle($request, Closure $next, ...$guards)
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {

            // redirect to /admin/home when guard is web_admin
            if ($guard == 'web_admin') {
                return redirect('/admin/home');
            }

            return redirect(RouteServiceProvider::HOME);
        }
    }

    return $next($request);
}
```

### Routing

The `routes` publishing will create a `routes/admin.php` routes file in your application. You can use this admin routes file to tweak the package routes accordingly to your needs. In this routes file, you can override the packages controllers as you wish. If the admin routes is not published, the default admin routes file from the package will be used.

```php
<?php

use Illuminate\Support\Facades\Route;

Route::name('wdevkit_admin.')->group(function () {

    Route::get('login', [\Wdevkit\Admin\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\Wdevkit\Admin\Http\Controllers\LoginController::class, 'login'])->name('login_post');

    Route::middleware('auth:web_admin')->group(function () {
        Route::get('home', \Wdevkit\Admin\Http\Controllers\HomeController::class)->name('home');
    });
});

// you can place any other routes in here
```

Any routes placed in this file will have the `/admin` prefix and the `web` middleware applied by default.

### Views

This package has its own view resources for the layout structure. You can override this files by publishing the `views` tag from the service provider. The package `views` files will be published in the `resources/views/vendor/wdevkit_admin` folder of your application.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email wdevkit@gmail.com instead of using the issue tracker.

## Credits

- [Gilmar Pereira](https://github.com/wdarking)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
