<?php

namespace EightyNine\FilamentAdvancedWidget\Concerns;

trait CanBeCustomised
{
    protected static ?string $icon = null;

    protected static ?string $iconColor = null;

    protected static ?string $iconBackgroundColor = null;

    protected static ?string $badge = null;

    protected static ?string $badgeColor = null;

    protected static ?string $badgeIcon = null;

    /**
     * Icon position can be either "before" or "after".
     *
     * @var string|null
     */
    protected static ?string $badgeIconPosition = 'before';

    /**
     * Size can be either "sm" or "xs.
     *
     * @var string|null
     */
    protected static ?string $badgeSize = 'sm';

    public function getIconBackgroundColor(): ?string
    {
        return static::$iconBackgroundColor;
    }

    public function getIconColor(): ?string
    {
        return static::$iconColor;
    }

    public function getIcon(): ?string
    {
        return static::$icon;
    }

    public function getBadge(): ?string
    {
        return static::$badge;
    }

    public function getBadgeColor(): ?string
    {
        return static::$badgeColor;
    }

    public function getBadgeIcon(): ?string
    {
        return static::$badgeIcon;
    }

    public function getBadgeIconPosition(): ?string
    {
        return static::$badgeIconPosition;
    }

    public function getBadgeSize(): ?string
    {
        return static::$badgeSize;
    }
}
