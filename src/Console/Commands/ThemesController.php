<?php

namespace io3x1\FilamentThemes\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ThemesController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'themes:controller {controller} {theme_name}';

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
        $controllerName = $this->argument('controller');
        $themeName = $this->argument('theme_name');
        $getFilePath = base_path('resources/views/themes/' . $themeName . '/controllers');

        if (File::exists($getFilePath)) {
            //Handel The File Generator
            $setNameSpace = 'Themes\\' . $themeName . '\\controllers';
            $setFileName = $controllerName . '.php';


            $getFileContent = view('templates.controller', [
                "controllerNameSpace" => $setNameSpace,
                "controllerName" => $controllerName
            ]);

            if (File::exists($getFilePath . '/' . $setFileName)) {
                $this->error('Sorry This Controller Is Exist!');
            } else {
                File::put($getFilePath . '/' . $setFileName, $getFileContent);
                $this->info('The Controller Has Been Generated');
            }
        } else {
            $this->error('Sorry this theme name is not exits!');
        }



        return Command::SUCCESS;
    }
}
