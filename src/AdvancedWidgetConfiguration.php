<?php

namespace  EightyNine\FilamentAdvancedWidget;

class AdvancedWidgetConfiguration
{
    /**
     * @param  class-string<Widget>  $widget
     * @param  array<string, mixed>  $properties
     */
    public function __construct(
        readonly public string $widget,
        protected array $properties = [],
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}
