<?php

namespace  EightyNine\FilamentAdvancedWidget\Commands\Aliases;

use EightyNine\FilamentAdvancedWidget\Commands\MakeAdvancedWidgetCommand as CommandsMakeAdvancedWidgetCommand;
use Filament\Widgets\Commands;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'filament:advanced-widget')]
class MakeAdvancedWidgetCommand extends CommandsMakeAdvancedWidgetCommand
{
    protected $hidden = true;

    protected $signature = 'filament:advanced-widget {name?} {--R|resource=} {--C|chart} {--T|table} {--S|stats-overview} {--panel=} {--F|force}';
}
