@props([
      'columns' => [
          'lg' => 2,
      ],
      'data' => [],
      'widgets' => [],
  ])

@php
    $cols = is_array($columns) ? $columns : ['default' => $columns];
    $gridClasses = 'fi-wi grid gap-6';
    $gridClasses .= ' grid-cols-' . ($cols['default'] ?? 1);
    if ($cols['sm'] ?? null) $gridClasses .= ' sm:grid-cols-' . $cols['sm'];
    if ($cols['md'] ?? null) $gridClasses .= ' md:grid-cols-' . $cols['md'];
    if ($cols['lg'] ?? null) $gridClasses .= ' lg:grid-cols-' . ($cols['lg'] ?? 2);
    if ($cols['xl'] ?? null) $gridClasses .= ' xl:grid-cols-' . $cols['xl'];
    if ($cols['2xl'] ?? null) $gridClasses .= ' 2xl:grid-cols-' . $cols['2xl'];
@endphp

<div {{ $attributes->class($gridClasses) }}>
    @php
        $normalizeWidgetClass = function (string | Filament\Widgets\WidgetConfiguration $widget): string {
            if ($widget instanceof \Filament\Widgets\WidgetConfiguration) {
                return $widget->widget;
            }

            return $widget;
        };
    @endphp

    @foreach ($widgets as $widgetKey => $widget)
        @php
            $widgetClass = $normalizeWidgetClass($widget);
        @endphp

        @livewire(
            $widgetClass,
            [...(($widget instanceof \Filament\Widgets\WidgetConfiguration) ? [...$widget->widget::getDefaultProperties(), ...$widget->getProperties()] : $widget::getDefaultProperties()),
...$data],
            key("{$widgetClass}-{$widgetKey}"),
        )
    @endforeach
</div>
