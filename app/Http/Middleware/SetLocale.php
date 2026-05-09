<?php
namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale');
        $language = null;

        if (Schema::hasTable('languages')) {
            if (!$locale) {
                $defaultLanguage = Language::where('is_default', true)->first();
                $locale = $defaultLanguage ? $defaultLanguage->code : 'en';
                Session::put('locale', $locale);
            }

            $language = Language::where('code', $locale)->where('is_active', true)->first();
            if (!$language) {
                $defaultLanguage = Language::where('is_default', true)->first();
                $locale = $defaultLanguage ? $defaultLanguage->code : 'en';
                Session::put('locale', $locale);
            }
        } else {
            $locale = $locale ?: 'en';
        }

        App::setLocale($locale);

        view()->share('currentLocale', $locale);
        view()->share('currentLanguage', $language);
        view()->share('rtl', $locale === 'ar');

        return $next($request);
    }
}
