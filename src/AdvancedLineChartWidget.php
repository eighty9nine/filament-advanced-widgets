<?php

namespace  EightyNine\FilamentAdvancedWidget;

/**
 * @deprecated Extend `AdvancedWidget` instead and define the `getType()` method.
 */
class AdvancedLineChartWidget extends AdvancedWidget
{
    protected function getType(): string
    {
        return 'line';
    }
}
