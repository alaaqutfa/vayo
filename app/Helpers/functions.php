<?php

use App\Helpers\TranslationHelper;

if (! function_exists('__t')) {
    function __t($key, $replace = [], $locale = null)
    {
        return TranslationHelper::trans($key, $replace, $locale);
    }
}

if (! function_exists('display_phone')) {
    function display_phone(?string $phone): string
    {
        $phone = trim((string) $phone);

        return $phone !== '' ? $phone : '';
    }
}

if (! function_exists('phone_href')) {
    function phone_href(?string $phone): string
    {
        $phone = trim((string) $phone);

        if ($phone === '') {
            return 'tel:';
        }

        $normalized = preg_replace('/[^\d+]/', '', $phone) ?? '';

        if (str_starts_with($normalized, '+')) {
            $normalized = '+' . ltrim(substr($normalized, 1), '+');
        } else {
            $normalized = ltrim($normalized, '+');
        }

        return 'tel:' . ($normalized !== '' ? $normalized : $phone);
    }
}
