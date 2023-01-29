<?php

namespace io3x1\FilamentThemes\Services\Traits;

use Illuminate\Support\Str;

trait GenerateViewTrait
{
    /**
     * @return void
     */
    private function generateView(): void
    {
        $this->generateStubs(
            $this->stubPath . 'layout.stub',
            $this->themePath . '/layouts/app.blade.php',
            []
        );

        $name = Str::ucfirst(Str::replace('-', ' ', Str::replace('_', ' ', $this->themeName)));
        $this->generateStubs(
            $this->stubPath . 'home.stub',
            $this->themePath . '/pages/home.blade.php',
            [
                "name" => $name,
                "description" => $this->themeDescription ?? $name,
                "path" => $this->themeName,
            ]
        );
    }
}
