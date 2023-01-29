<?php

namespace io3x1\FilamentThemes\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\File;
use Filament\Pages\Actions\ButtonAction;

class Themes extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-color-swatch';

    protected static string $view = 'filament-themes::filament.pages.themes';

    protected static ?string $navigationGroup = 'Settings';


    /**
     * @return string|null
     */
    protected static function getNavigationGroup(): ?string
    {
        return config('filament-themes.group') ?? static::$navigationGroup;
    }

    /**
     * @return array[]
     */
    protected function getViewData(): array
    {
        $themes =  File::directories(base_path() . (string) str('/resources/views/themes')->replace('/', DIRECTORY_SEPARATOR));
        $data = [];
        if ($themes) {
            foreach ($themes as $key => $item) {
                $data[] = [
                    "id" => $key + 1,
                    "path" => $item,
                    "info" => json_decode(File::get($item . DIRECTORY_SEPARATOR . 'info.json'))
                ];
            }
        }

        return compact('data');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('page_Themes');
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->can('page_Themes'), 403);
    }
}
