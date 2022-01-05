<?php

use Illuminate\Support\Facades\Route;
use io3x1\FilamentThemes\Http\Controllers\ThemeController;

try {
    if (setting('theme_name')) {
        $path = base_path('resources/views/themes') . '/' . setting('theme_name') . '/routes/web.php';
        if (\Illuminate\Support\Facades\File::exists($path)) {
            include $path;
        }
    } else {
        Route::get('/', function () {
            return view('welcome');
        });
    }
} catch (Exception $exception) {
}


Route::get('admin/themes/active', [ThemeController::class, 'active'])->middleware('web');
