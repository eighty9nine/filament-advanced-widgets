<?php

namespace EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Concerns;

trait CanCustomiseIconPosition
{
    /**
     * Icon position can be either "start" or "end".
     *
     * @var string|null
     */
    protected ?string $iconPosition = "end";

    public function iconPosition(string $position): static
    {
        $this->iconPosition = $position;

        return $this;
    }

    public function getIconPosition(): string
    {
        return $this->iconPosition;
    }
}
