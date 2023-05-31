<?php

namespace io3x1\FilamentThemes\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use io3x1\FilamentThemes\Services\GenerateController;
use Queents\ConsoleHelpers\Traits\HandleStub;

class GenerateThemeController extends Command
{
    use HandleStub;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament-themes:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller inside selected theme';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Get Controller Name
        $controllerName = $this->ask('Please input your controller name');
        while(!$controllerName){
            $this->info('Sorry you must input your controller name');
            $controllerName = $this->ask('Please input your controller name');
        }

        //Get Theme Name
        $themeName = $this->ask('Please input your theme name');
        while(!$themeName){
            $this->info('Sorry you must input your theme name');
            $themeName =  $this->ask('Please input your theme name');
            $getFilePath = base_path('resources/views/themes/' . $themeName . '/controllers');
            if (!File::exists($getFilePath)) {
                $this->error('Sorry this theme name is not exits!');
                $themeName = null;
            }
        }

        $generator = new GenerateController(
            controllerName: $controllerName,
            themeName: $themeName
        );
        $generator->generate();

        $this->info('The Controller Has Been Generated');
        return Command::SUCCESS;
    }
}
