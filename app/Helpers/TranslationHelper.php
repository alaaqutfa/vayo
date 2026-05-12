<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Facades\Cache;

class TranslationHelper
{
    protected static $translations = [];
    protected static $loaded       = false;

    /**
     * تحميل جميع الترجمات من قاعدة البيانات وتخزينها في Cache
     */
    public static function loadTranslations($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        // استخدام Cache لتجنب الاستعلامات المتكررة
        $cacheKey = "translations_{$locale}";

        if (Cache::has($cacheKey)) {
            self::$translations[$locale] = Cache::get($cacheKey);
            self::$loaded                = true;
            return;
        }

        $translations = Translation::where('lang', $locale)->get();
        $items        = [];

        foreach ($translations as $trans) {
            $items[$trans->key] = $trans->value;
        }

        Cache::put($cacheKey, $items, 60 * 24); // تخزين ليوم كامل
        self::$translations[$locale] = $items;
        self::$loaded                = true;
    }

    /**
     * ترجمة مفتاح معين
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @return string
     */
    public static function trans($key, $replace = [], $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        if (! isset(self::$translations[$locale]) || ! self::$loaded) {
            self::loadTranslations($locale);
        }

        if (! isset(self::$translations[$locale][$key])) {
            // إنشاء الترجمة بقاعدة البيانات
            Translation::create([
                'lang'     => $locale,
                'key'        => $key,
                'value'      => $key,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // إضافتها للكاش المحلي
            self::$translations[$locale][$key] = $key;
        }

        $text = self::$translations[$locale][$key] ?? $key;

        // استبدال المتغيرات مثل :name
        foreach ($replace as $search => $replaceText) {
            $text = str_replace(':' . $search, $replaceText, $text);
        }

        return $text;
    }

    /**
     * مساعدة سريعة كـ function __t()
     */
    public static function __t($key, $replace = [], $locale = null)
    {
        return self::trans($key, $replace, $locale);
    }

    /**
     * مسح Cache الترجمات
     */
    public static function clearCache($locale = null)
    {
        if ($locale) {
            Cache::forget("translations_{$locale}");
        } else {
            $languages = \App\Models\Language::all();
            foreach ($languages as $lang) {
                Cache::forget("translations_{$lang->code}");
            }
        }
        self::$loaded = false;
    }
}
