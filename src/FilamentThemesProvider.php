<?php

namespace io3x1\FilamentThemes;

use Illuminate\Support\ServiceProvider;
use Filament\PluginServiceProvider;
use io3x1\FilamentThemes\Commands\GenerateTheme;
use io3x1\FilamentThemes\Commands\GenerateThemeController;

include 'helpers.php';

class FilamentThemesProvider extends PluginServiceProvider
{
    public static string $name = 'filament-themes';

    protected array $pages = [
        Pages\Themes::class,
    ];

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateThemeController::class,
                GenerateTheme::class,
            ]);
        }

        //Register Config
        $this->mergeConfigFrom(__DIR__ . '/../config/filament-themes.php', 'filament-themes');

        //Publish Config
        $this->publishes([
            __DIR__ . '/../config/filament-themes.php' => config_path('filament-themes.php'),
        ], 'filament-themes-config');

        //Register Assets
        $this->publishes([
            __DIR__ . '/../publish' => public_path(),
        ], 'filament-themes-assets');

        //Register Translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'filament-themes');

        //Register Routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        //Register Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-themes');

        //Publish Migrations
        if (!class_exists('ThemesSettings')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/themes_settings.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_themes_settings.php'),
            ], 'filament-themes-migrations');
        }
    }
}
