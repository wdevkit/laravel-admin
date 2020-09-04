# Admin scafolding for Laravel

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

- todo

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email wdarking@gmail.com instead of using the issue tracker.

## Credits

- [Gilmar Pereira](https://github.com/wdarking)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
