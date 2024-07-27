<?php

namespace EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Concerns;

trait HasColorCustomisation
{
    protected ?string $backgroundColor = null;

    protected ?string $borderColor = null;

    protected ?bool $iconHasBackgroundColor = false;

    /**
     * Icon color can be either "primary", "secondary", "success", "danger", "warning", "info".
     *
     * @var string|null
     */
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

    public function getLabelColor(): string
    {
        return match ($this->labelColor) {
            'primary' => 'text-primary-500',
            'secondary' => 'text-secondary-500',
            'success' => 'text-success-500',
            'danger' => 'text-danger-500',
            'warning' => 'text-warning-500',
            'info' => 'text-info-500',
            default => 'text-gray-950 dark:text-white',
        };
    }

    public function getValueColor(): string
    {
        return match ($this->valueColor) {
            'primary' => 'text-primary-600',
            'secondary' => 'text-secondary-600',
            'success' => 'text-success-600',
            'danger' => 'text-danger-600',
            'warning' => 'text-warning-600',
            'info' => 'text-info-600',
            default => 'text-gray-950 dark:text-white',
        };
    }

    public function getDescriptionColor(): string | array | null
    {
        return match ($this->descriptionColor) {
            'primary' => 'text-primary-600',
            'secondary' => 'text-secondary-600',
            'success' => 'text-success-600',
            'danger' => 'text-danger-600',
            'warning' => 'text-warning-600',
            'info' => 'text-info-600',
            default => 'text-gray-950 dark:text-white',
        };
    }

    public function getBackgroundColor(): string
    {
        return match ($this->backgroundColor) {
            'primary' => 'bg-primary-500',
            'secondary' => 'bg-secondary-500',
            'success' => 'bg-success-500',
            'danger' => 'bg-danger-500',
            'warning' => 'bg-warning-500',
            'info' => 'bg-info-500',
            default => ' bg-white dark:bg-gray-900',
        };
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
        return match ($this->iconColor) {
            'primary' => 'text-primary-500',
            'secondary' => 'text-secondary-500',
            'success' => 'text-success-500',
            'danger' => 'text-danger-500',
            'warning' => 'text-warning-500',
            'info' => 'text-info-500',
            default => 'text-gray-500',
        };
    }

    public function getIconBackgroundColor(): string
    {
        $iconBackgroundColor = $this->iconBackgroundColor ?? $this->iconColor;
        return match ($iconBackgroundColor) {
            'primary' => 'bg-primary-200 dark:bg-primary-800',
            'secondary' => 'bg-secondary-200 dark:bg-secondary-800',
            'success' => 'bg-success-200 dark:bg-success-800',
            'danger' => 'bg-danger-200 dark:bg-danger-800',
            'warning' => 'bg-warning-200 dark:bg-warning-800',
            'info' => 'bg-info-200 dark:bg-info-800',
            default => 'bg-gray-200 dark:bg-gray-800',
        };
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
        return match ($this->chartBorderColor) {
            'primary' => 'text-primary-600 border-3',
            'secondary' => 'text-secondary-600 border-3',
            'success' => 'text-success-600 border-3',
            'danger' => 'text-danger-600 border-3',
            'warning' => 'text-warning-600 border-3',
            'info' => 'text-info-600 border-3',
            default => 'text-gray-600 border-3',
        };
    }

    public function getChartBackgroundColor(): ?string
    {
        $color = match ($this->chartBackgroundColor) {
            'gray' => 'text-gray-100 dark:text-gray-800',
            default => 'text-custom-50 dark:text-custom-400/10',
        };
        return $color;
    }
}
