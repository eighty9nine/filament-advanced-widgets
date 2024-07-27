<?php

namespace  EightyNine\FilamentAdvancedWidget;

/**
 * @deprecated Extend `AdvancedWidget` instead and define the `getType()` method.
 */
class AdvancedPolarAreaChartWidget extends AdvancedWidget
{
    protected function getType(): string
    {
        return 'polarArea';
    }
}
