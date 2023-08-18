# A collection of components for Filament.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/sink.svg?style=flat-square)](https://packagist.org/packages/awcodes/sink)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/awcodes/sink/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/awcodes/sink/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/awcodes/sink/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/awcodes/sink/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/sink.svg?style=flat-square)](https://packagist.org/packages/awcodes/sink)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require awcodes/sink
```

## Fixed Width Sidebar

```php
use Awcodes\Sink\Components\FixedWidthSidebar;

FixedWidthSidebar::make()
    ->mainSchema(array | Closure $schema)
    ->sidebarSchema(array | Closure $schema)
    ->breakpoint(string | int $breakpoint)
    ->sidebarWidth(string | int $width)
```

## Heading

```php
use Awcodes\Sink\Components\Heading;

Heading::make()
    ->level(string | int $level)
    ->content(string | Closure $content)
    ->color(string | array | Closure | null $color);
```

## Separator (Horizontal Rule)

```php
use Awcodes\Sink\Components\Separator;

Separator::make()
    ->color(string | array | Closure | null $color);
```

## Timestamps

```php
use Awcodes\Sink\Components\Timestamps;

Timestamps::make();
```

## Now Action

```php
use Awcodes\Sink\Components\NowAction;

DatePicker::make('published_at')
    ->suffixAction(NowAction::make('published_at'));
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
