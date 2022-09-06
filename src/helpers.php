<?php

use io3x1\FilamentThemes\Settings\ThemesSettings;


if (!function_exists('setting')) {
    function setting($key)
    {
        return app(ThemesSettings::class)->{$key};
    }
}
//Themes Functions
if (!function_exists('theme_assets')) {
    function theme_assets($path)
    {
        $theme_name = str_replace('themes.', '', setting('theme_path'));
        return url('themes/' . $theme_name . '/' . $path);
    }
}
if (!function_exists('theme_namespace')) {
    function theme_namespace()
    {
        $theme_name = str_replace('themes.', '', setting('theme_path'));
        return 'Themes\\' . $theme_name . '\\controllers';
    }
}
if (!function_exists('dollar')) {
    function dollar($total)
    {
        $getDollar = setting('site_currency');
        if ($getDollar) {
            return "<b>" . number_format($total, 2) . "</b><small>$getDollar</small>";
        } else {
            return false;
        }
    }
}
