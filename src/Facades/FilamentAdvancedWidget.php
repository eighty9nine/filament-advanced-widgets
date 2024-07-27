<?php

namespace EightyNine\FilamentAdvancedWidget\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EightyNine\FilamentAdvancedWidget\FilamentAdvancedWidget
 */
class FilamentAdvancedWidget extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \EightyNine\FilamentAdvancedWidget\FilamentAdvancedWidget::class;
    }
}
