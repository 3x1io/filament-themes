<?php

namespace io3x1\FilamentThemes\Services\Traits;

use Illuminate\Support\Str;

trait GenerateControllerTrait
{


    /**
     * @var string|null
     */
    private string|null $controllerName = null;


    /**
     * @return void
     */
    private function generateController(): void
    {
        $themeClassName = Str::ucfirst(Str::camel($this->themeName));
        $this->controllerName = Str::ucfirst(Str::camel($this->controllerName)) ?: $themeClassName;


        $this->generateStubs(
            $this->stubPath . 'controller.stub',
            $this->themePath . '/controllers/'.$this->controllerName.'Controller.php',
            [
                "namespace" => "Themes\\".Str::camel($this->themeName)."\\controllers",
                "name" => $this->controllerName.'Controller',
            ]
        );
    }
}
