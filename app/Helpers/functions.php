<?php

use App\Helpers\TranslationHelper;

if (! function_exists('__t')) {
    function __t($key, $replace = [], $locale = null)
    {
        return TranslationHelper::trans($key, $replace, $locale);
    }
}
