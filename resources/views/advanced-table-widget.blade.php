@php
    use Filament\Support\Facades\FilamentView;

    $heading = $this->getHeading();
    $description = $this->getDescription();
    $label = $this->getLabel();
    $filters = $this->getFilters();

    $icon = $this->getIcon();
    $iconColor = $this->getIconColor();
    $iconBackgroundColor = filled($this->getIconBackgroundColor())
        ? match ($this->getIconBackgroundColor()) {
            'primary' => 'bg-primary-200 dark:bg-primary-950',
            'secondary' => 'bg-secondary-200 dark:bg-secondary-950',
            'success' => 'bg-success-200 dark:bg-success-950',
            'danger' => 'bg-danger-200 dark:bg-danger-950',
            'warning' => 'bg-warning-200 dark:bg-warning-950',
            'info' => 'bg-info-200 dark:bg-info-950',
            default => 'bg-gray-200 dark:bg-gray-950',
        }
        : '';

    $badge = $this->getBadge();
    $badgeColor = $this->getBadgeColor();
    $badgeIcon = $this->getBadgeIcon();
    $badgeIconPosition = $this->getBadgeIconPosition();
    $badgeSize = $this->getBadgeSize();
@endphp
<x-filament-widgets::widget class="fi-wi-table">

    <x-advanced-widgets::section :description="$description" :heading="$heading" :icon="$icon" :iconColor="$iconColor"
        :iconBackgroundColor="$iconBackgroundColor" :label="$label" :badge="$badge" :badgeColor="$badgeColor" :badgeIcon="$badgeIcon" :badgeIconPosition="$badgeIconPosition"
        :badgeSize="$badgeSize">
        @if ($filters)
            <x-slot name="headerEnd">
                <x-filament::input.wrapper inline-prefix wire:target="filter" class="w-max sm:-my-2">
                    <x-filament::input.select inline-prefix wire:model.live="filter">
                        @foreach ($filters as $value => $label)
                            <option value="{{ $value }}">
                                {{ $label }}
                            </option>
                        @endforeach
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </x-slot>
        @endif
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\Widgets\View\WidgetsRenderHook::TABLE_WIDGET_START, scopes: static::class) }}

        {{ $this->table }}

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\Widgets\View\WidgetsRenderHook::TABLE_WIDGET_END, scopes: static::class) }}
    </x-advanced-widgets::section>
</x-filament-widgets::widget>
