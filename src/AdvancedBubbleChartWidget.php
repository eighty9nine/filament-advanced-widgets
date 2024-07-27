<?php

namespace  EightyNine\FilamentAdvancedWidget;

/**
 * @deprecated Extend `ChartWidget` instead and define the `getType()` method.
 */
class AdvancedBubbleChartWidget extends AdvancedChartWidget
{
    protected function getType(): string
    {
        return 'bubble';
    }
}
