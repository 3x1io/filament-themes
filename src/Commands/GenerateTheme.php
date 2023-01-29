<?php

namespace io3x1\FilamentThemes\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Queents\ConsoleHelpers\Traits\HandleFiles;
use Queents\ConsoleHelpers\Traits\HandleStub;
use Queents\ConsoleHelpers\Traits\RunCommand;

class GenerateTheme extends Command
{
    use HandleFiles;
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament-themes:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new Theme for Filament';

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
        $themeName = $this->ask('What is the name of the theme?');
        while(!$themeName){
            $this->error('Sorry you must input your theme name');
            $themeName =  $this->ask('Please input your theme name');
            $getFilePath = base_path('resources/views/themes/' . $themeName . '/controllers');
            if (File::exists($getFilePath)) {
                $this->error('Sorry this theme exits!');
                $themeName =  null;
            }
        }

        $themeDescription = $this->ask('What is the description of the theme?');

        $generator = new \io3x1\FilamentThemes\Services\GenerateTheme(
            themeName: $themeName,
            themeDescription: $themeDescription
        );
        $generator->generate();

        $this->info('Theme generated successfully!');
        return Command::SUCCESS;
    }
}
