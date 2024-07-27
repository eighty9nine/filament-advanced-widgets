<?php

namespace EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Concerns;

trait HasProgressBar
{
    protected ?string $progress = null;

    protected ?string $progressColor = "primary";

    public function progressBarColor(string | array | null $color): static
    {
        $this->progressColor = $color;

        return $this;
    }

    public function progress(string | float | int $progress): static
    {
        $this->progress = $progress;
        if ($progress === 'full') {
            $this->progress = 100;
        }
        if($progress === 'empty') {
            $this->progress = 0;
        }
        if($progress > 100) {
            $this->progress = 0;
        }

        if($progress < 0) {
            $this->progress = 0;
        }

        return $this;
    }

    public function getProgress(): ?string
    {
        return $this->progress;
    }

    public function getProgressBarColor(): string | array | null
    {
        return match ($this->progressColor) {
            'primary' => 'bg-primary-500',
            'secondary' => 'bg-secondary-500',
            'success' => 'bg-success-500',
            'danger' => 'bg-danger-500',
            'warning' => 'bg-warning-500',
            'info' => 'bg-info-500',
            default => 'bg-gray-500',
        };
    }
}
