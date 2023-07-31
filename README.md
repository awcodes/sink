# A collection of components for Filament.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/sink.svg?style=flat-square)](https://packagist.org/packages/awcodes/sink)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/sink.svg?style=flat-square)](https://packagist.org/packages/awcodes/sink)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require awcodes/sink
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="sink-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="sink-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="sink-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$sink = new Awcodes\Sink();
echo $sink->echoPhrase('Hello, Awcodes!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Adam Weston](https://github.com/awcodes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
