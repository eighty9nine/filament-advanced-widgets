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

## Usage

### Advanced Stats Overview Widget

The package comes with a "advanced stats overview". It's exactly like the [stats overview widget](https://filamentphp.com/docs/3.x/widgets/stats-overview), but with a few extra features.

Start by creating a widget with the command:
```bash
php artisan make:filament-advanced-widget AdvancedStatsOverviewWidget --stats-overview
```

This command will create a new StatsOverview.php file. Open it, and return Stat instances from the getStats() method. Below is a sample widget:

```php

use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;

class GeneralStatsOverviewWidget extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', "124k")->icon('heroicon-o-user')
                ->backgroundColor('info')
                ->progress(69)
                ->progressBarColor('success')
                ->iconBackgroundColor('success')
                ->chartColor('success')
                ->iconPosition('start')
                ->description('The users in this period')
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('success')
                ->iconColor('success'),
            Stat::make('Total Posts', "1.2k")->icon('heroicon-o-newspaper')
                ->description('The posts in this period')
                ->descriptionIcon('heroicon-o-chevron-up', 'before')               
                ->descriptionColor('primary')
                ->iconColor('warning'),
            Stat::make('Total Comments', "23.4k")->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->description("The comments in this period")
                ->descriptionIcon('heroicon-o-chevron-down', 'before')
                ->descriptionColor('danger')
                ->iconColor('danger')
        ];
    }
}
```

### Advanced Chart Widget

The package comes with a "advanced chart". It's exactly like the [chart widget](https://filamentphp.com/docs/3.x/widgets/chart), but with a few extra features.

Start by creating a widget with the command:

```bash
php artisan make:filament-advanced-widget AdvancedChartWidget --chart
```

This command will create a new AdvancedChartWidget.php file. Below is a sample widget:

```php

use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;

class MonthlyUsersChart extends AdvancedChartWidget
{

    protected static ?string $heading = '187.2k';
    protected static string $color = 'info';
    protected static ?string $icon = 'heroicon-o-chart-bar';
    protected static ?string $iconColor = 'info';
    protected static ?string $iconBackgroundColor = 'info';
    protected static ?string $label = 'Monthly users chart';

    protected static ?string $badge = 'new';
    protected static ?string $badgeColor = 'success';
    protected static ?string $badgeIcon = 'heroicon-o-check-circle';
    protected static ?string $badgeIconPosition = 'after';
    protected static ?string $badgeSize = 'xs';


    public ?string $filter = 'today';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

```

### Advanced Table Widget
Currently, the table widget is not fully customizable. This is a work in progress.


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
