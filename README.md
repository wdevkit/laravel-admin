# Admin scafolding for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v//admin.svg?style=flat-square)](https://packagist.org/packages//admin)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status//admin/run-tests?label=tests)](https://github.com//admin/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt//admin.svg?style=flat-square)](https://packagist.org/packages//admin)


This package allows you to scafold a simple _admin_ structure to your application.

## Support us

- todo

## Installation

You can install the package via composer:

```bash
composer require webdk/admin
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Webdk\Admin\AdminServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Webdk\Admin\AdminServiceProvider" --tag="config"
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
