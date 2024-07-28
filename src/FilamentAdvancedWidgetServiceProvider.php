<?php

namespace EightyNine\FilamentAdvancedWidget;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use EightyNine\FilamentAdvancedWidget\Commands\FilamentAdvancedWidgetCommand;
use EightyNine\FilamentAdvancedWidget\Commands\MakeAdvancedWidgetCommand;
use EightyNine\FilamentAdvancedWidget\Testing\TestsFilamentAdvancedWidget;
use Illuminate\Support\Facades\Blade;

class FilamentAdvancedWidgetServiceProvider extends PackageServiceProvider
{
    public static string $name = 'advanced-widgets';

    public static string $viewNamespace = 'advanced-widgets';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasViews(static::$viewNamespace)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('eightynine/filament-advanced-widgets');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-advanced-widgets/{$file->getFilename()}"),
                ], 'filament-advanced-widgets-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentAdvancedWidget);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'eightynine/filament-advanced-widgets';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-advanced-widgets', __DIR__ . '/../resources/dist/components/filament-advanced-widgets.js'),
            Css::make('filament-advanced-widgets-styles', __DIR__ . '/../resources/dist/filament-advanced-widgets.css'),
            Js::make('filament-advanced-widgets-scripts', __DIR__ . '/../resources/dist/filament-advanced-widgets.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            MakeAdvancedWidgetCommand::class
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
        ];
    }
}
