<?php

namespace io3x1\FilamentThemes\Http\Controllers;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use io3x1\FilamentThemes\Settings\ThemesSettings;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ThemeController extends Controller
{
    /**
     * @param Request $request
     * @param ThemesSettings $settings
     * @return RedirectResponse
     */
    public function active(Request $request, ThemesSettings $settings): RedirectResponse
    {

        $request->validate([
            'theme' => 'required',
            'name' => 'required'
        ]);

        $settings->theme_path = $request->theme;
        $settings->theme_name = $request->name;
        $settings->save();

        Notification::make()
            ->title( _("Theme Updated"))
            ->icon('heroicon-o-check-circle')
            ->iconColor('success')
            ->send();

        return back();
    }

    /**
     * @return RedirectResponse
     */
    public function language(): RedirectResponse
    {
        $user = User::find(auth()->user()->id);

        if ($user->lang === 'ar') {
            $user->lang = 'en';
            $user->save();
        } else if ($user->lang === 'en') {
            $user->lang = 'ar';
            $user->save();
        }

        Notification::make()
            ->title(__("Language Updated To " . $user->lang))
            ->icon('heroicon-o-check-circle')
            ->iconColor('success')
            ->send();

        return back();
    }

    /**
     * @param $theme
     * @return RedirectResponse
     */
    public function destroy($theme): RedirectResponse
    {
        $themes =  File::directories(base_path() . (string) str('/resources/views/themes')->replace('/', DIRECTORY_SEPARATOR));
        if ($themes) {
            foreach ($themes as $key => $item) {
                if(Str::contains($item, $theme)){
                    File::deleteDirectory($item);
                }
            }

            $themes =  File::directories(base_path() . (string) str('/resources/views/themes')->replace('/', DIRECTORY_SEPARATOR));

            if(count($themes)){
                $getName = json_decode(File::get($themes[0] . DIRECTORY_SEPARATOR . 'info.json'));
                $settings = new ThemesSettings();
                $settings->theme_path = 'themes.'.$getName->aliases;
                $settings->theme_name = $getName->aliases;
                $settings->save();
            }
        }

        Notification::make()
            ->title( __("Your Theme Has Been Deleted"))
            ->icon('heroicon-o-check-circle')
            ->iconColor('success')
            ->send();

        return back();
    }
}
