<?php

namespace io3x1\FilamentThemes\Services;

use Illuminate\Support\Str;
use io3x1\FilamentThemes\Services\Traits\GenerateControllerTrait;
use io3x1\FilamentThemes\Services\Traits\GenerateFoldersTrait;
use io3x1\FilamentThemes\Services\Traits\GenerateJSONTrait;
use io3x1\FilamentThemes\Services\Traits\GenerateRoutesTrait;
use io3x1\FilamentThemes\Services\Traits\GenerateViewTrait;
use Queents\ConsoleHelpers\Traits\HandleStub;

class GenerateTheme
{
    use HandleStub;
    use GenerateFoldersTrait;
    use GenerateJSONTrait;
    use GenerateControllerTrait;
    use GenerateViewTrait;
    use GenerateRoutesTrait;

    private string $stubPath;


    /**
     * @param string $themeName
     * @param string|null $themeDescription
     */
    public function __construct(
        private string $themeName,
        private string|null $themeDescription,
    )
    {
        $this->stubPath = __DIR__ . '/../../stubs/';
    }

    /**
     * @return void
     */
    public function generate(): void
    {
        $this->generateFolders();
        $this->generateJSON();
        $this->generateView();
        $this->generateController();
        $this->generateRoutes();
    }
}
