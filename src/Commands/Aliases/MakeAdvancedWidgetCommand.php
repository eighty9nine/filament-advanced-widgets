<?php

namespace  EightyNine\FilamentAdvancedWidget\Commands\Aliases;

use Filament\Widgets\Commands;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'filament:widget')]
class MakeAdvancedWidgetCommand extends MakeAdvancedWidgetCommand
{
    protected $hidden = true;

    protected $signature = 'filament:advanced-widget {name?} {--R|resource=} {--C|chart} {--T|table} {--S|stats-overview} {--panel=} {--F|force}';
}
