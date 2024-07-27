<?php

namespace  EightyNine\FilamentAdvancedWidget;

/**
 * @deprecated Extend `AdvancedWidget` instead and define the `getType()` method.
 */
class AdvancedDoughnutChartWidget extends AdvancedWidget
{
    protected function getType(): string
    {
        return 'doughnut';
    }
}
