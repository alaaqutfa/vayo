<?php
namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // جلب اللغة من الجلسة أو من الطلب أو استخدام الافتراضية
        $locale = Session::get('locale');

        if (! $locale) {
            // جلب اللغة الافتراضية من قاعدة البيانات
            $defaultLanguage = Language::where('is_default', true)->first();
            $locale          = $defaultLanguage ? $defaultLanguage->code : 'en';
            Session::put('locale', $locale);
        }

        // التحقق من وجود اللغة في قاعدة البيانات
        $language = Language::where('code', $locale)->where('is_active', true)->first();
        if (! $language) {
            $defaultLanguage = Language::where('is_default', true)->first();
            $locale          = $defaultLanguage ? $defaultLanguage->code : 'en';
            Session::put('locale', $locale);
        }

        App::setLocale($locale);

        // إتاحة اللغة الحالية لجميع الـ Views
        view()->share('currentLocale', $locale);
        view()->share('currentLanguage', $language ?? null);
        view()->share('rtl', $locale === 'ar'); // العربية RTL

        return $next($request);
    }
}
