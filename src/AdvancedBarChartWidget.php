<?php

namespace  EightyNine\FilamentAdvancedWidget;

/**
 * @deprecated Extend `ChartWidget` instead and define the `getType()` method.
 */
class AdvancedBarChartWidget extends AdvancedChartWidget
{
    protected function getType(): string
    {
        return 'bar';
    }
}
