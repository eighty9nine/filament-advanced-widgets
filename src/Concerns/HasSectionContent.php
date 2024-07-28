<?php

namespace EightyNine\FilamentAdvancedWidget\Concerns;

trait HasSectionContent
{
    protected static ?string $heading = null;

    protected static ?string $description = null;

    protected static ?string $label = null;

    protected static ?array $filters = null;

    public function getFilters(): ?array
    {
        return static::$filters;
    }

    public function getHeading(): ?string
    {
        return static::$heading;
    }

    public function getDescription(): ?string
    {
        return static::$description;
    }

    public function getLabel(): ?string
    {
        return static::$label;
    }   

}
