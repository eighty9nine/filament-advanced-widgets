<?php

namespace EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Concerns;

trait HasColorCustomisation
{
    protected ?string $backgroundColor = null;

    protected ?string $borderColor = null;

    protected ?bool $iconHasBackgroundColor = false;

    protected ?string $iconColor = "gray";

    protected ?string $graphColor = null;

    protected ?string $labelColor = null;

    protected ?string $valueColor = null;

    protected ?string $iconBackgroundColor = null;

    protected ?string $chartBorderColor = null;

    protected ?string $chartBackgroundColor = null;

    public function textColor(
        string $labelColor,
        string $valueColor,
        string $descriptionColor
    ): static {
        $this->labelColor = $labelColor;
        $this->valueColor = $valueColor;
        $this->descriptionColor = $descriptionColor;

        return $this;
    }

    public function graphColor(string $color): static
    {
        $this->graphColor = $color;

        return $this;
    }

    public function iconColor(string $color): static
    {
        $this->iconColor = $color;

        return $this;
    }

    public function backgroundColor(string $color): static
    {
        $this->backgroundColor = $color;

        return $this;
    }

    public function getLabelColor(): ?string
    {
        return $this->labelColor;
    }

    public function getValueColor(): ?string
    {
        return $this->valueColor;
    }

    public function getDescriptionColor(): ?string
    {
        return $this->descriptionColor;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function borderColor(string $color): static
    {
        $this->borderColor = $color;

        return $this;
    }

    public function iconBackgroundColor(string $color): static
    {
        $this->iconBackgroundColor = $color;
        $this->iconHasBackgroundColor = true;

        return $this;
    }

    public function getIconColor(): string
    {
        return $this->iconColor;
    }

    public function getIconBackgroundColor(): string
    {
        return $this->iconBackgroundColor;
    }

    public function iconHasBackgroundColor(): bool
    {
        return $this->iconHasBackgroundColor;
    }

    public function getChartColor(): string | array | null
    {
        return $this->chartColor ?? $this->chartBorderColor;
    }

    public function chartColor(string $chartBorderColor, ?string $chartBackgroundColor = null): static
    {
        $this->chartBorderColor = $chartBorderColor;
        $this->chartBackgroundColor = $chartBackgroundColor;

        return $this;
    }

    public function getChartBorderColor(): ?string
    {
        return $this->chartBorderColor;
    }

    public function getChartBackgroundColor(): ?string
    {
        return $this->chartBackgroundColor;
    }
}
