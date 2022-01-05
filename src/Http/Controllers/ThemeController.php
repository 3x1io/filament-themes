<?php

namespace io3x1\FilamentThemes\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use io3x1\FilamentThemes\Settings\ThemesSettings;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ThemeController extends Controller
{
    public function active(Request $request, ThemesSettings $settings)
    {

        $request->validate([
            'theme' => 'required',
            'name' => 'required'
        ]);

        $settings->theme_path = $request->theme;
        $settings->theme_name = $request->name;
        $settings->save();

        session()->flash('notification', [
            'message' => __("Theme Updated"),
            'status' => "success",
        ]);

        return back();
    }

    public function language()
    {
        $user = User::find(auth()->user()->id);

        if ($user->lang === 'ar') {
            $user->lang = 'en';
            $user->save();
        } else if ($user->lang === 'en') {
            $user->lang = 'ar';
            $user->save();
        }

        session()->flash('notification', [
            'message' => __("Language Updated To " . $user->lang),
            'status' => "success",
        ]);

        return back();
    }
}
