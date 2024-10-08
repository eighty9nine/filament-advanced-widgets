<?php

namespace  EightyNine\FilamentAdvancedWidget\Concerns;

trait CanPoll
{
    protected static ?string $pollingInterval = '5s';

    protected function getPollingInterval(): ?string
    {
        return static::$pollingInterval;
    }
}
