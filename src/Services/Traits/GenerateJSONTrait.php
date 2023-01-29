<?php

namespace io3x1\FilamentThemes\Services\Traits;

use Illuminate\Support\Str;

trait GenerateJSONTrait
{
    /**
     * @return void
     */
    private function generateJSON(): void
    {
        $name = Str::ucfirst(Str::replace('-', ' ', Str::replace('_', ' ', $this->themeName)));

        $this->generateStubs(
            $this->stubPath . 'json.stub',
            $this->themePath . '/info.json',
            [
                "name" => $name,
                "description" => $this->themeDescription ?? Str::ucfirst(Str::replace('-', ' ', $this->themeName)),
                "aliases" => Str::camel($this->themeName),
            ]
        );
    }
}
