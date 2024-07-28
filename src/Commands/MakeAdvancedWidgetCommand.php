<?php

namespace  EightyNine\FilamentAdvancedWidget\Commands;

use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

#[AsCommand(name: 'make:filament-advanced-widget')]
class MakeAdvancedWidgetCommand extends Command
{
    use CanManipulateFiles;

    protected $description = 'Create a new Filament advanced widget class';

    protected $signature = 'make:filament-advanced-widget {name?} {--R|resource=} {--C|advanced-chart} {--T|advanced-table} {--S|advanced-stats-overview} {--panel=} {--F|force}';

    public function handle(): int
    {
        $widget = (string) str($this->argument('name') ?? text(
            label: 'What is the advanced widget name?',
            placeholder: 'BlogPostsChart',
            required: true,
        ))
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');
        $widgetClass = (string) str($widget)->afterLast('\\');
        $widgetNamespace = str($widget)->contains('\\') ?
            (string) str($widget)->beforeLast('\\') :
            '';

        $resource = null;
        $resourceClass = null;

        $type = match (true) {
            $this->option('advanced-chart') => 'Advanced chart',
            $this->option('advanced-stats-overview') => 'Advanced stats overview',
            $this->option('advanced-table') => 'Advanced table',
            default => select(
                label: 'What type of advanced widget do you want to create?',
                options: ['Advanced chart', 'Advanced stats overview', 'Advanced table', 'Custom'],
            ),
        };

        if (class_exists(Resource::class)) {
            $resourceInput = $this->option('resource') ?? text(
                label: 'What is the resource you would like to create this in?',
                placeholder: '[Optional] BlogPostResource',
            );

            if (filled($resourceInput)) {
                $resource = (string) str($resourceInput)
                    ->studly()
                    ->trim('/')
                    ->trim('\\')
                    ->trim(' ')
                    ->replace('/', '\\');

                if (! str($resource)->endsWith('Resource')) {
                    $resource .= 'Resource';
                }

                $resourceClass = (string) str($resource)
                    ->afterLast('\\');
            }
        }

        $panel = null;

        if (class_exists(Panel::class)) {
            $panel = $this->option('panel');

            if ($panel) {
                $panel = Filament::getPanel($panel, isStrict: false);
            }

            if (! $panel) {
                $panels = Filament::getPanels();
                $namespace = config('livewire.class_namespace');

                /** @var ?Panel $panel */
                $panel = $panels[select(
                    label: 'Where would you like to create this?',
                    options: array_unique([
                        ...array_map(
                            fn (Panel $panel): string => "The [{$panel->getId()}] panel",
                            $panels,
                        ),
                        $namespace => "[{$namespace}] alongside other Livewire components",
                    ])
                )] ?? null;
            }
        }

        $path = null;
        $namespace = null;
        $resourcePath = null;
        $resourceNamespace = null;

        if (! $panel) {
            $namespace = config('livewire.class_namespace');
            $path = app_path((string) str($namespace)->after('App\\')->replace('\\', '/'));
        } elseif ($resource === null) {
            $widgetDirectories = $panel->getWidgetDirectories();
            $widgetNamespaces = $panel->getWidgetNamespaces();

            $namespace = (count($widgetNamespaces) > 1) ?
                select(
                    label: 'Which namespace would you like to create this in?',
                    options: $widgetNamespaces,
                ) :
                (Arr::first($widgetNamespaces) ?? 'App\\Filament\\Widgets');
            $path = (count($widgetDirectories) > 1) ?
                $widgetDirectories[array_search($namespace, $widgetNamespaces)] :
                (Arr::first($widgetDirectories) ?? app_path('Filament/Widgets/'));
        } else {
            $resourceDirectories = $panel->getResourceDirectories();
            $resourceNamespaces = $panel->getResourceNamespaces();

            $resourceNamespace = (count($resourceNamespaces) > 1) ?
                select(
                    label: 'Which namespace would you like to create this in?',
                    options: $resourceNamespaces,
                ) :
                (Arr::first($resourceNamespaces) ?? 'App\\Filament\\Resources');
            $resourcePath = (count($resourceDirectories) > 1) ?
                $resourceDirectories[array_search($resourceNamespace, $resourceNamespaces)] :
                (Arr::first($resourceDirectories) ?? app_path('Filament/Resources/'));
        }

        $view = str($widget)->prepend(
            (string) str($resource === null ? ($panel ? "{$namespace}\\" : 'livewire\\') : "{$resourceNamespace}\\{$resource}\\widgets\\")
                ->replaceFirst('App\\', '')
        )
            ->replace('\\', '/')
            ->explode('/')
            ->map(fn ($segment) => Str::lower(Str::kebab($segment)))
            ->implode('.');

        $path = (string) str($widget)
            ->prepend('/')
            ->prepend($resource === null ? $path : "{$resourcePath}\\{$resource}\\Widgets\\")
            ->replace('\\', '/')
            ->replace('//', '/')
            ->append('.php');

        $viewPath = resource_path(
            (string) str($view)
                ->replace('.', '/')
                ->prepend('views/')
                ->append('.blade.php'),
        );

        if (! $this->option('force') && $this->checkForCollision([
            $path,
            ...($this->option('advanced-stats-overview') || $this->option('advanced-chart')) ? [] : [$viewPath],
        ])) {
            return static::INVALID;
        }

        if ($type === 'Advanced chart') {
            $chartType = select(
                label: 'Which type of chart would you like to create?',
                options: [
                    'Advanced Bar chart',
                    'Advanced Bubble chart',
                    'Advanced Doughnut chart',
                    'Advanced Line chart',
                    'Advanced Pie chart',
                    'Advanced Polar area chart',
                    'Advanced Radar chart',
                    'Advanced Scatter chart',
                ],
            );

            $this->copyStubToApp('AdvancedChartWidget', $path, [
                'class' => $widgetClass,
                'namespace' => filled($resource) ? "{$resourceNamespace}\\{$resource}\\Widgets" . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : '') : $namespace . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : ''),
                'type' => match ($chartType) {
                    'Advanced Bar chart' => 'bar',
                    'Advanced Bubble chart' => 'bubble',
                    'Advanced Doughnut chart' => 'doughnut',
                    'Advanced Pie chart' => 'pie',
                    'Advanced Polar area chart' => 'polarArea',
                    'Advanced Radar chart' => 'radar',
                    'Advanced Scatter chart' => 'scatter',
                    default => 'line',
                },
            ]);
        } elseif ($type === 'Advanced stats overview') {
            $this->copyStubToApp('AdvancedStatsOverviewWidget', $path, [
                'class' => $widgetClass,
                'namespace' => filled($resource) ? "{$resourceNamespace}\\{$resource}\\Widgets" . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : '') : $namespace . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : ''),
            ]);
        } elseif ($type === 'Advanced table') {
            $this->copyStubToApp('AdvancedTableWidget', $path, [
                'class' => $widgetClass,
                'namespace' => filled($resource) ? "{$resourceNamespace}\\{$resource}\\Widgets" . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : '') : $namespace . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : ''),
            ]);
        } else {
            $this->copyStubToApp('AdvancedWidget', $path, [
                'class' => $widgetClass,
                'namespace' => filled($resource) ? "{$resourceNamespace}\\{$resource}\\Widgets" . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : '') : $namespace . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : ''),
                'view' => $view,
            ]);

            $this->copyStubToApp('AdvancedWidgetView', $viewPath);
        }

        $this->components->info("Filament advanced widget [{$path}] created successfully.");

        if ($resource !== null) {
            $this->components->info("Make sure to register the advanced widget in `{$resourceClass}::getWidgets()`, and then again in `getHeaderWidgets()` or `getFooterWidgets()` of any `{$resourceClass}` page.");
        }

        return static::SUCCESS;
    }
}
