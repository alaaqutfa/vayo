<?php
namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request, $locale)
    {
        $language = Language::where('code', $locale)->where('is_active', true)->first();

        if (! $language) {
            $defaultLanguage = Language::where('is_default', true)->first();
            $locale = $defaultLanguage ? $defaultLanguage->code : 'en';
        }

        Session::put('locale', $locale);
        App::setLocale($locale);

        $redirectTarget = $this->resolveRedirectTarget($request);

        return redirect()->to($redirectTarget);
    }

    private function resolveRedirectTarget(Request $request): string
    {
        $candidates = [
            $request->query('redirect'),
            url()->previous(),
        ];

        foreach ($candidates as $candidate) {
            if (! is_string($candidate) || trim($candidate) === '') {
                continue;
            }

            $normalized = $this->normalizeRedirectTarget($candidate);

            if ($normalized !== null) {
                return $normalized;
            }
        }

        return route('home');
    }

    private function normalizeRedirectTarget(string $candidate): ?string
    {
        $candidate = trim($candidate);
        $appUrl = rtrim(config('app.url') ?? '', '/');
        $appHost = parse_url($appUrl, PHP_URL_HOST);
        $requestHost = request()->getHost();

        if (preg_match('#^(https?:)?//#i', $candidate)) {
            $candidateHost = parse_url($candidate, PHP_URL_HOST);

            $isAllowedHost = ! $candidateHost
                || ($appHost && strcasecmp($candidateHost, $appHost) === 0)
                || ($requestHost && strcasecmp($candidateHost, $requestHost) === 0);

            if (! $isAllowedHost) {
                return null;
            }

            $path = parse_url($candidate, PHP_URL_PATH) ?? '/';
            $query = parse_url($candidate, PHP_URL_QUERY);

            if ($this->isAssetLikePath($path)) {
                return null;
            }

            return preg_replace('/#.*$/', '', $candidate);
        }

        if ($this->isAssetLikePath($candidate)) {
            return null;
        }

        $normalizedPath = str_starts_with($candidate, '/') ? $candidate : '/' . ltrim($candidate, '/');

        return url($normalizedPath);
    }

    private function isAssetLikePath(string $path): bool
    {
        $path = strtolower(parse_url($path, PHP_URL_PATH) ?? $path);

        if (str_contains($path, '/assets/') || str_contains($path, '/storage/') || str_contains($path, '/build/')) {
            return true;
        }

        return (bool) preg_match('/\.(css|js|png|jpe?g|gif|webp|svg|ico|mp4|webm|woff2?|ttf|map)$/', $path);
    }
}
