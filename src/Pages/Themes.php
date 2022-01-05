<?php

namespace io3x1\FilamentThemes\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\File;
use Filament\Pages\Actions\ButtonAction;

class Themes extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.themes';


    protected static ?string $navigationGroup = 'Themes';


    protected function getViewData(): array
    {
        $themes =  File::directories(base_path() . '/resources/views/themes');
        $data = [];
        if ($themes) {
            foreach ($themes as $key => $item) {
                array_push($data, [
                    "id" => $key + 1,
                    "path" => $item,
                    "info" => json_decode(File::get($item . '/info.json'))
                ]);
            }
        }

        return [
            "data" => $data
        ];
    }
}
