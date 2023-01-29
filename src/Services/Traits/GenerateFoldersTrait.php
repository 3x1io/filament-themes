<?php

namespace io3x1\FilamentThemes\Services\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait GenerateFoldersTrait
{

    /**
     * @var string|null
     */
    private string|null $themePath = null;

    /**
     * @return void
     */
    private function generateFolders(): void
    {
        $this->themePath = 'resources/views/themes/';
        $themePath = base_path($this->themePath);
        if(!File::exists($themePath)){
            File::makeDirectory($themePath);
        }
        if(!File::exists($themePath  .Str::camel($this->themeName))){
            File::makeDirectory($themePath  . Str::camel($this->themeName));
        }
        $this->themePath = $themePath . Str::camel($this->themeName);
        if(!File::exists(public_path('themes'))){
            File::makeDirectory(public_path('themes'));
        }
        if(!File::exists(public_path('themes') . '/'.Str::camel($this->themeName))){
            File::makeDirectory(public_path('themes'). '/'.Str::camel($this->themeName));
        }

        //Get Folder List
        $foldersList = collect([
            'public/img',
            'public/img/.gitkeep',
            'public/css',
            'public/css/app.css',
            'public/css/.gitkeep',
            'public/js',
            'public/js/app.js',
            'public/js/.gitkeep',
            'controllers',
            'controllers/.gitkeep',
            'routes',
            'routes/.gitkeep',
            'layouts',
            'layouts/.gitkeep',
            'pages',
            'pages/.gitkeep',
        ]);

        //Generate Folders if not exists
        $foldersList->each(function($folder){
            if(Str::contains($folder, 'public')){
                $path = public_path('themes') . '/'. Str::camel($this->themeName) . '/' . Str::replace('public/', '', $folder);
            }
            else {
                $path = $this->themePath . '/' . $folder;
            }

            if(!File::exists($path)){
                if(Str::contains($path, '.')){
                    File::put($path, " ");
                }
                else {
                    File::makeDirectory($path);
                }
            }
        });
    }
}
