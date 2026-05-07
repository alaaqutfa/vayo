<?php
namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch($locale)
    {
            // التحقق من صحة اللغة
            $language = Language::where('code', $locale)->where('is_active', true)->first();

            if (! $language) {
                $defaultLanguage = Language::where('is_default', true)->first();
                $locale          = $defaultLanguage ? $defaultLanguage->code : 'en';
            }

            Session::put('locale', $locale);
            App::setLocale($locale);

            return redirect()->back();
    }
}
