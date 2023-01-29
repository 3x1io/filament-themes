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

Route::middleware('web')->name('admin.themes.')->prefix('admin/themes')->group(static function(){
    Route::get('active', [ThemeController::class, 'active'])->name('active');
    Route::post('{theme}/delete', [ThemeController::class, 'destroy'])->name('destroy');
});


