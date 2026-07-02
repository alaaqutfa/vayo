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

if (! function_exists('public_asset_uses_project_public_prefix')) {
    function public_asset_uses_project_public_prefix(): bool
    {
        if (app()->runningInConsole()) {
            return false;
        }

        $baseUrl = trim((string) request()->getBaseUrl());

        return $baseUrl === '/public' || str_ends_with($baseUrl, '/public');
    }
}

if (! function_exists('public_asset')) {
    function public_asset(?string $path): string
    {
        $path = ltrim((string) $path, '/');
        $path = preg_replace('#^public/#', '', $path) ?? $path;

        if ($path === '' || preg_match('#^(https?:)?//#i', $path)) {
            return $path;
        }

        $resolvedPath = public_asset_uses_project_public_prefix() ? $path : 'public/' . $path;

        return asset($resolvedPath);
    }
}

if (! function_exists('storage_asset')) {
    function storage_asset(?string $path): string
    {
        $path = ltrim((string) $path, '/');
        if ($path === '' || preg_match('#^(https?:)?//#i', $path)) {
            return $path;
        }

        if (str_starts_with($path, 'assets/') || str_starts_with($path, 'public/assets/')) {
            return public_asset($path);
        }

        $path = preg_replace('#^public/storage/#', '', $path) ?? $path;
        $path = preg_replace('#^storage/#', '', $path) ?? $path;
        $resolvedPath = public_asset_uses_project_public_prefix()
            ? 'storage/' . $path
            : 'public/storage/' . $path;

        return asset($resolvedPath);
    }
}
