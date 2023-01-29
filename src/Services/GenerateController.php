<?php

namespace io3x1\FilamentThemes\Services;

use io3x1\FilamentThemes\Services\Traits\GenerateControllerTrait;
use io3x1\FilamentThemes\Services\Traits\GenerateFoldersTrait;
use Queents\ConsoleHelpers\Traits\HandleStub;

class GenerateController
{
    use HandleStub;
    use GenerateFoldersTrait;
    use GenerateControllerTrait;

    /**
     * @param string $controllerName
     * @param string $themeName
     */
    public function __construct(
        string $controllerName,
        private string $themeName
    ){
        $this->controllerName = $controllerName;
        $this->stubPath = __DIR__ . '/../../stubs/';
    }

    /**
     * @return void
     */
    public function generate(): void
    {
        $this->generateFolders();
        $this->generateController();
    }
}
