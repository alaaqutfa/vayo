<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Facades\Cache;
use Throwable;

class TranslationHelper
{
    protected static $translations = [];
    protected static $loaded       = [];
    protected static $autoCreated  = [];

    /**
     * تحميل جميع الترجمات من قاعدة البيانات وتخزينها في Cache
     */
    public static function loadTranslations($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $cacheKey = self::cacheKey($locale);

        try {
            $cachedTranslations = Cache::get($cacheKey);
            if (is_array($cachedTranslations)) {
                self::$translations[$locale] = $cachedTranslations;
                self::$loaded[$locale] = true;
                return;
            }

            $translations = Translation::query()
                ->where('lang', $locale)
                ->get(['key', 'value']);

            $items = [];
            foreach ($translations as $trans) {
                $items[$trans->key] = $trans->value;
            }

            self::$translations[$locale] = $items;
            self::syncCache($locale);
        } catch (Throwable $e) {
            self::$translations[$locale] = self::$translations[$locale] ?? [];
        }

        self::$loaded[$locale] = true;
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

        if (! isset(self::$loaded[$locale])) {
            self::loadTranslations($locale);
        }

        self::$translations[$locale] = self::$translations[$locale] ?? [];

        if (! array_key_exists($key, self::$translations[$locale])) {
            self::$translations[$locale][$key] = self::resolveMissingTranslation($key, $locale);
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
        try {
            if ($locale) {
                Cache::forget(self::cacheKey($locale));
                unset(self::$translations[$locale], self::$loaded[$locale], self::$autoCreated[$locale]);
                return;
            }

            $loadedLocales = array_keys(self::$translations);
            foreach ($loadedLocales as $loadedLocale) {
                Cache::forget(self::cacheKey($loadedLocale));
            }
        } catch (Throwable $e) {
            // تجاهل مشاكل الكاش حتى لا يتعطل الموقع
        }

        self::$translations = [];
        self::$loaded = [];
        self::$autoCreated = [];
    }

    protected static function resolveMissingTranslation(string $key, string $locale): string
    {
        if (isset(self::$autoCreated[$locale][$key])) {
            return self::$autoCreated[$locale][$key];
        }

        if (! self::shouldAutoCreate()) {
            self::$autoCreated[$locale][$key] = $key;
            return $key;
        }

        try {
            $translation = Translation::query()->firstOrCreate(
                ['lang' => $locale, 'key' => $key],
                ['value' => $key]
            );

            $value = $translation->value ?? $key;
            self::$translations[$locale][$key] = $value;
            self::$autoCreated[$locale][$key] = $value;
            self::syncCache($locale);

            return $value;
        } catch (Throwable $e) {
            self::$autoCreated[$locale][$key] = $key;
            return $key;
        }
    }

    protected static function syncCache(string $locale): void
    {
        try {
            Cache::put(self::cacheKey($locale), self::$translations[$locale] ?? [], 60 * 24);
        } catch (Throwable $e) {
            // تجاهل مشاكل الكاش حتى لا يتعطل الموقع
        }
    }

    protected static function cacheKey(string $locale): string
    {
        return "translations_{$locale}";
    }

    protected static function shouldAutoCreate(): bool
    {
        $configured = config('app.translations_auto_create');
        if ($configured !== null) {
            return (bool) $configured;
        }

        $value = $_ENV['TRANSLATIONS_AUTO_CREATE']
            ?? $_SERVER['TRANSLATIONS_AUTO_CREATE']
            ?? true;

        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? true;
    }
}
