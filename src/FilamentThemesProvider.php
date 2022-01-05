<?php

namespace io3x1\FilamentThemes;

use Illuminate\Support\ServiceProvider;
use Filament\PluginServiceProvider;
use io3x1\FilamentThemes\Commands\MakeThemesController;

include 'helpers.php';

class FilamentThemesProvider extends PluginServiceProvider
{
    public static string $name = 'filament-themes';


    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeThemesController::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/'),
            __DIR__ . '/../database/migrations' => base_path('database/settings'),
            __DIR__ . '/../publish' => public_path(),
        ], 'filament-themes');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'filament-themes');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../templates', 'filament-themes-templates');
    }

    protected function getPages(): array
    {
        return [
            Pages\Themes::class,
        ];
    }
}
