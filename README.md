# Admin scaffolding for Laravel

This package allows you to scafold a simple _admin_ structure to your application.

## Support us

- todo

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

This is the contents of the published config file:

```php
return [
];
```

## Usage

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
