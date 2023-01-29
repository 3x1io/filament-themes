<?php

namespace io3x1\FilamentThemes\Services\Traits;

use Illuminate\Support\Str;

trait GenerateRoutesTrait
{
    /**
     * @return void
     */
    private function generateRoutes(): void
    {

        $this->generateStubs(
            $this->stubPath . 'routes.stub',
            $this->themePath . '/Routes/web.php',
            [
                "name" => Str::camel($this->themeName),
                "controller" => $this->controllerName.'Controller',
            ]
        );

    }
}
