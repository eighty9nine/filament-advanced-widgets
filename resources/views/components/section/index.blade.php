@php
    use Filament\Support\Enums\Alignment;
    use Filament\Support\Enums\IconSize;
@endphp

@props([
    'aside' => false,
    'collapsed' => false,
    'collapsible' => false,
    'compact' => false,
    'contentBefore' => false,
    'description' => null,
    'label' => null,
    'footerActions' => [],
    'footerActionsAlignment' => Alignment::Start,
    'headerActions' => [],
    'headerEnd' => null,
    'heading' => null,
    'icon' => null,
    'iconColor' => 'gray',
    'iconBackgroundColor' => '',
    'badge' => null,
    'badgeColor' => 'gray',
    'badgeIcon' => null,
    'badgeIconPosition' => null,
    'badgeSize' => null,
    'iconSize' => IconSize::Large,
    'persistCollapsed' => false,
])

@php
    $hasDescription = filled((string) $description);
    $hasLabel = filled((string) $label);
    $hasHeading = filled($heading);
    $hasIcon = filled($icon);
    $hasBadge = filled($badge);

    $iconContainerClasses = "{$iconBackgroundColor} h-fit p-1 rounded-lg";

    if (is_array($headerActions)) {
        $headerActions = array_filter($headerActions, fn($headerAction): bool => $headerAction->isVisible());
    }

    if (is_array($footerActions)) {
        $footerActions = array_filter($footerActions, fn($footerAction): bool => $footerAction->isVisible());
    }

    $hasHeaderActions =
        $headerActions instanceof \Illuminate\Contracts\Support\Htmlable
            ? !\Filament\Support\is_slot_empty($headerActions)
            : filled($headerActions);

    $hasFooterActions =
        $footerActions instanceof \Illuminate\Contracts\Support\Htmlable
            ? !\Filament\Support\is_slot_empty($footerActions)
            : filled($footerActions);

    $hasHeader =
        $hasIcon || $hasHeading || $hasDescription || $collapsible || $hasHeaderActions || filled((string) $headerEnd);
@endphp

<section {{-- TODO: Investigate Livewire bug - https://github.com/filamentphp/filament/pull/8511 --}} x-data="{
    isCollapsed: @if ($persistCollapsed) $persist(@js($collapsed)).as(`section-${$el.id}-isCollapsed`) @else @js($collapsed) @endif,
}"
    @if ($collapsible) x-on:collapse-section.window="if ($event.detail.id == $el.id) isCollapsed = true"
        x-on:expand="isCollapsed = false"
        x-on:open-section.window="if ($event.detail.id == $el.id) isCollapsed = false"
        x-on:toggle-section.window="if ($event.detail.id == $el.id) isCollapsed = ! isCollapsed"
        x-bind:class="isCollapsed && 'fi-collapsed'" @endif
    {{ $attributes->class([
        'fi-section',
        match ($aside) {
            true => 'fi-aside grid grid-cols-1 items-start gap-x-6 gap-y-4 md:grid-cols-3',
            false => 'rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10',
        },
    ]) }}>
    @if ($hasHeader)
        <header @if ($collapsible) x-on:click="isCollapsed = ! isCollapsed" @endif
            @class([
                'fi-section-header flex flex-col gap-3',
                'cursor-pointer' => $collapsible,
                match ($compact) {
                    true => 'px-4 py-2.5',
                    false => 'px-6 py-4',
                } => !$aside,
            ])>
            <div class="flex items-center gap-3">
                @if ($hasIcon)
                    <div class="{{ $iconContainerClasses }}">
                        <x-filament::icon :icon="$icon" @class([
                            'fi-section-header-icon self-start',
                            match ($iconColor) {
                                'gray' => 'text-gray-400 dark:text-gray-500',
                                default => 'fi-color-custom text-custom-500 dark:text-custom-400',
                            },
                            is_string($iconColor) ? "fi-color-{$iconColor}" : null,
                            match ($iconSize) {
                                IconSize::Small, 'sm' => 'h-4 w-4 mt-1',
                                IconSize::Medium, 'md' => 'h-5 w-5 mt-0.5',
                                IconSize::Large, 'lg' => 'h-8 w-8',
                                default => $iconSize,
                            },
                        ]) @style([
                            \Filament\Support\get_color_css_variables($iconColor, shades: [400, 500], alias: 'section.header.icon') => $iconColor !== 'gray',
                        ]) />
                    </div>
                @endif

                <div class="flex flex-1">
                    @if ($hasHeading || $hasDescription)
                        <div class="grid gap-y-1">
                            @if ($hasLabel)
                                <x-advanced-widgets::section.description>
                                    {{ $label }}
                                </x-advanced-widgets::section.description>
                            @endif
                            @if ($hasHeading)
                                <div class="flex gap-1 items-end">
                                    <x-advanced-widgets::section.heading>
                                        {{ $heading }}
                                    </x-advanced-widgets::section.heading>
                                    @if ($hasBadge)
                                        <div>
                                            <x-filament::badge :color="$badgeColor" :size="$badgeSize" :icon="$badgeIcon"
                                                :icon-position="$badgeIconPosition">
                                                {{ $badge }}
                                            </x-filament::badge>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            @if ($hasDescription)
                                <x-advanced-widgets::section.description>
                                    {{ $description }}
                                </x-advanced-widgets::section.description>
                            @endif
                        </div>
                    @endif
                </div>

                @if ($hasHeaderActions)
                    <div class="hidden sm:block">
                        <x-filament::actions :actions="$headerActions" :alignment="\Filament\Support\Enums\Alignment::Start" x-on:click.stop="" />
                    </div>
                @endif

                {{ $headerEnd }}

                @if ($collapsible)
                    <x-filament::icon-button color="gray" icon="heroicon-m-chevron-down"
                        icon-alias="section.collapse-button" x-on:click.stop="isCollapsed = ! isCollapsed"
                        x-bind:class="{ 'rotate-180': !isCollapsed }" />
                @endif
            </div>

            @if ($hasHeaderActions)
                <div class="sm:hidden">
                    <x-filament::actions :actions="$headerActions" :alignment="\Filament\Support\Enums\Alignment::Start" x-on:click.stop="" />
                </div>
            @endif
        </header>
    @endif

    <div @if ($collapsible) x-bind:aria-expanded="(! isCollapsed).toString()"
            @if ($collapsed || $persistCollapsed)
                x-cloak @endif
        x-bind:class="{
            'invisible absolute h-0 overflow-hidden border-none': isCollapsed,
        }"
        @endif
        @class([
            'fi-section-content-ctn',
            'border-t border-gray-200 dark:border-white/10' => $hasHeader && !$aside,
            'rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 md:col-span-2' => $aside,
            'md:order-first' => $contentBefore,
        ])
        >
        <div @class([
            'fi-section-content',
            match ($compact) {
                true => 'p-4',
                false => 'p-6',
            },
        ])>
            {{ $slot }}
        </div>

        @if ($hasFooterActions)
            <footer @class([
                'fi-section-footer border-t border-gray-200 dark:border-white/10',
                'px-6 py-4' => !$compact,
                'px-4 py-2.5' => $compact,
            ])>
                <x-filament::actions :actions="$footerActions" :alignment="$footerActionsAlignment" />
            </footer>
        @endif
    </div>
</section>
