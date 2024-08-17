# Advanced widgets for your filament php application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/eightynine/filament-advanced-widgets.svg?style=flat-square)](https://packagist.org/packages/eightynine/filament-advanced-widgets)
[![Total Downloads](https://img.shields.io/packagist/dt/eightynine/filament-advanced-widgets.svg?style=flat-square)](https://packagist.org/packages/eightynine/filament-advanced-widgets)


## 🛠️ Be Part of the Journey

Hi, I'm Eighty Nine. I created page alerts plugin to solve real problems I faced as a developer. Your sponsorship will allow me to dedicate more time to enhancing these tools and helping more people. [Become a sponsor](https://github.com/sponsors/eighty9nine) and join me in making a positive impact on the developer community.

## Introduction

This package provides a set of advanced widgets for your Filament application. These widgets are designed to be highly customizable and offer a range of features to enhance your application's user experience. Whether you're looking for a simple chart widget or a complex table widget, you can find the perfect solution here.

![Package screenshot](https://raw.githubusercontent.com/eighty9nine/filament-advanced-widgets/3.x/resources/img/advanced-widget-screenshot.png)

## Installation

You can install the package via composer:

```bash
composer require eightynine/filament-advanced-widgets
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-advanced-widgets-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-advanced-widgets-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-advanced-widgets-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filamentAdvancedWidget = new EightyNine\FilamentAdvancedWidget();
echo $filamentAdvancedWidget->echoPhrase('Hello, EightyNine!');
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

- [Eighty Nine](https://github.com/eighty9nine)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
