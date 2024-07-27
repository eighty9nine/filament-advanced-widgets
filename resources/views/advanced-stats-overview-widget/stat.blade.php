@php
    use Filament\Support\Enums\IconPosition;
    use Filament\Support\Facades\FilamentView;

    $chartColor = $getChartColor() ?? 'gray';
    $descriptionColor = $getDescriptionColor() ?? 'gray';
    $descriptionIcon = $getDescriptionIcon();
    $descriptionIconPosition = $getDescriptionIconPosition();
    $url = $getUrl();
    $tag = $url ? 'a' : 'div';
    $dataChecksum = $generateDataChecksum();
    $iconPosition = $getIconPosition();

    $icon = $getIcon();
    $iconClasses = "fi-wi-stats-overview-stat-icon h-8 w-8 {$getIconColor()}";
    $backgroundColor = $iconHasBackgroundColor() ? $getIconBackgroundColor() : '';
    $iconContainerClasses = "{$backgroundColor} h-fit p-1 rounded-lg";

    $progress = $getProgress();
    $progressBarColor = $getProgressBarColor();
    $progressBarClasses = "fi-wi-stats-overview-stat-progress-bar h-full w-full rounded-lg {$progressBarColor}";

    $backgroundColor = $getBackgroundColor();
    $labelColor = $getLabelColor();
    $valueColor = $getValueColor();
    $descriptionColor = $getDescriptionColor();

    $chartBorderColor = $getChartBorderColor();
    $chartBackgroundColor = $getChartBackgroundColor();

    $descriptionIconClasses = "fi-wi-stats-overview-stat-description-icon h-5 w-5 {$descriptionColor}";

    $descriptionIconStyles = \Illuminate\Support\Arr::toCssStyles([
        \Filament\Support\get_color_css_variables(
            $descriptionColor,
            shades: [500],
            alias: 'widgets::stats-overview-widget.stat.description.icon',
        ) => $descriptionColor !== 'gray',
    ]);
@endphp

<{!! $tag !!}
    @if ($url) {{ \Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab()) }} @endif
    {{ $getExtraAttributeBag()->class([
        'fi-wi-stats-overview-stat relative rounded-xl p-6 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 ' .
        $backgroundColor,
    ]) }}>
    <div class="flex gap-y-2 gap-x-3">
        @if ($icon && $iconPosition === 'start')
            <div class="{{ $iconContainerClasses }}">
                <x-filament::icon :icon="$icon" class="{{ $iconClasses }}" />
            </div>
        @endif
        <div class="flex-grow">
            <div class="flex items-center gap-x-2">
                <span class="fi-wi-stats-overview-stat-label text-sm font-medium {{ $labelColor }}">
                    {{ $getLabel() }}
                </span>
            </div>

            <div
                class="fi-wi-stats-overview-stat-value text-3xl font-semibold tracking-tight {{ $valueColor }}">
                {{ $getValue() }}
            </div>

            @if ($description = $getDescription())
                <div class="flex items-center gap-x-1">
                    @if ($descriptionIcon && in_array($descriptionIconPosition, [IconPosition::Before, 'before']))
                        <x-filament::icon :icon="$descriptionIcon" :class="$descriptionIconClasses" :style="$descriptionIconStyles" />
                    @endif

                    <span @class([
                        'fi-wi-stats-overview-stat-description text-sm',
                        $descriptionColor
                    ]) @style([
                        \Filament\Support\get_color_css_variables($descriptionColor, shades: [400, 600], alias: 'widgets::stats-overview-widget.stat.description') => $descriptionColor !== 'gray',
                    ])>
                        {{ $description }}
                    </span>

                    @if ($descriptionIcon && in_array($descriptionIconPosition, [IconPosition::After, 'after']))
                        <x-filament::icon :icon="$descriptionIcon" :class="$descriptionIconClasses" :style="$descriptionIconStyles" />
                    @endif
                </div>
            @endif
        </div>
        @if ($icon && $iconPosition === 'end')
            <div class="{{ $iconContainerClasses }}">
                <x-filament::icon :icon="$icon" class="{{ $iconClasses }}" />
            </div>
        @endif
    </div>

    @if (filled($progress))
        <div class="w=full h-1 mt-3 bg-gray-200 dark:bg-gray-800 rounded-lg">
            <div class="{{ $progressBarClasses }}" style="width: {{ $progress }}%"></div>
        </div>
    @endif

    @if ($chart = $getChart())
        {{-- An empty function to initialize the Alpine component with until it's loaded with `ax-load`. This removes the need for `x-ignore`, allowing the chart to be updated via Livewire polling. --}}
        <div x-data="{ statsOverviewStatChart: function() {} }">
            <div @if (FilamentView::hasSpaMode()) ax-load="visible"
                @else
                    ax-load @endif
                ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('stats-overview/stat/chart', 'filament/widgets') }}"
                x-data="statsOverviewStatChart({
                    dataChecksum: @js($dataChecksum),
                    labels: @js(array_keys($chart)),
                    values: @js(array_values($chart)),
                })" @class([
                    'fi-wi-stats-overview-stat-chart absolute inset-x-0 bottom-0 overflow-hidden rounded-b-xl',
                ])
                @style([
                    \Filament\Support\get_color_css_variables(
                        $chartColor,
                        shades: [50, 400, 500],
                        alias: 'widgets::stats-overview-widget.stat.chart',
                    ) => $chartColor !== 'gray',
                ])>
                <canvas x-ref="canvas" height="60"></canvas>

                <span x-ref="backgroundColorElement" @class([
                    $chartBackgroundColor,
                ])></span>

                <span x-ref="borderColorElement" @class([
                    $chartBorderColor,
                ])></span>
            </div>
        </div>
    @endif
    </{!! $tag !!}>
