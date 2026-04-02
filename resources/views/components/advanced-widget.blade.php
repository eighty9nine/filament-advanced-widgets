@php
    $columnSpan = $this->getColumnSpan();

    if (! is_array($columnSpan)) {
        $columnSpan = [
            'default' => $columnSpan,
        ];
    }

    $columnStart = $this->getColumnStart();

    if (! is_array($columnStart)) {
        $columnStart = [
            'default' => $columnStart,
        ];
    }

    $spanClasses = 'fi-wi-widget';
    if ($columnSpan['default'] ?? null) $spanClasses .= ' col-span-' . $columnSpan['default'];
    if ($columnSpan['sm'] ?? null) $spanClasses .= ' sm:col-span-' . $columnSpan['sm'];
    if ($columnSpan['md'] ?? null) $spanClasses .= ' md:col-span-' . $columnSpan['md'];
    if ($columnSpan['lg'] ?? null) $spanClasses .= ' lg:col-span-' . $columnSpan['lg'];
    if ($columnSpan['xl'] ?? null) $spanClasses .= ' xl:col-span-' . $columnSpan['xl'];
    if ($columnSpan['2xl'] ?? null) $spanClasses .= ' 2xl:col-span-' . $columnSpan['2xl'];

    if ($columnStart['default'] ?? null) $spanClasses .= ' col-start-' . $columnStart['default'];
    if ($columnStart['sm'] ?? null) $spanClasses .= ' sm:col-start-' . $columnStart['sm'];
    if ($columnStart['md'] ?? null) $spanClasses .= ' md:col-start-' . $columnStart['md'];
    if ($columnStart['lg'] ?? null) $spanClasses .= ' lg:col-start-' . $columnStart['lg'];
    if ($columnStart['xl'] ?? null) $spanClasses .= ' xl:col-start-' . $columnStart['xl'];
    if ($columnStart['2xl'] ?? null) $spanClasses .= ' 2xl:col-start-' . $columnStart['2xl'];
@endphp

<div {{ $attributes->class($spanClasses) }}>
    {{ $slot }}
</div>
