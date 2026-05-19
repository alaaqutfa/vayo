<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $rtl ?? false ? 'rtl' : 'ltr' }}" class="{{ $darkMode ?? false ? 'dark' : '' }}">

<head>
    @php
        $siteName = $settings['site_name'] ?? 'Vayu Clinic';
        $configuredUrl = rtrim(config('app.url'), '/');
        $siteUrl = in_array($configuredUrl, ['http://localhost', 'https://localhost'], true)
            ? 'https://vayuclinic.com'
            : $configuredUrl;
        $currentPath = request()->getPathInfo();
        $canonicalUrl = $siteUrl . ($currentPath === '/' ? '' : $currentPath);
        $metaTitle = trim($__env->yieldContent('title', $siteName));
        $metaDescription = trim($__env->yieldContent('description', $settings['footer_text'] ?? 'Vayu Clinic provides modern, patient-centered medical and dental care in Istanbul, Turkiye with trusted specialists and coordinated treatment services.'));
        $metaKeywords = trim($__env->yieldContent('keywords', 'Vayu Clinic, medical clinic Istanbul, dental clinic Istanbul, healthcare Istanbul, doctors in Istanbul, dental implants Turkey, cosmetic dentistry Turkey'));
        $metaImage = trim($__env->yieldContent('image', $siteUrl . '/public/assets/img/social-card.png'));
        $metaImage = str_starts_with($metaImage, 'http') ? $metaImage : $siteUrl . '/' . ltrim($metaImage, '/');
        $favicon48 = $siteUrl . '/public/assets/img/favicon-48.png';
        $favicon192 = $siteUrl . '/public/assets/img/favicon-192.png';
        $favicon512 = $siteUrl . '/public/assets/img/favicon-512.png';
        $faviconIco = $siteUrl . '/favicon.ico';
        $appleTouchIcon = $siteUrl . '/public/assets/img/apple-touch-icon.png';
        $manifestUrl = $siteUrl . '/public/site.webmanifest';
        $favicon = isset($settings['favicon'])
            ? asset('public/storage/' . $settings['favicon'])
            : $favicon48;
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'MedicalClinic',
            'name' => $siteName,
            'url' => $siteUrl,
            'logo' => $favicon512,
            'image' => $metaImage,
            'description' => $metaDescription,
            'telephone' => $settings['contact_phone'] ?? '+90 555 057 65 55',
            'email' => $settings['contact_email'] ?? 'info@vayuclinic.com',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $settings['contact_address'] ?? 'Istanbul, Turkiye',
                'addressLocality' => 'Istanbul',
                'addressCountry' => 'TR',
            ],
            'medicalSpecialty' => [
                'Dentistry',
                'GeneralPractice',
            ],
        ];
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="author" content="{{ $siteName }}">
    <meta name="application-name" content="{{ $siteName }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="{{ $settings['secondary_color'] ?? '#012119' }}">
    <meta name="format-detection" content="telephone=no">

    <link rel="canonical" href="{{ $canonicalUrl }}">

    <meta property="og:locale" content="{{ str_replace('-', '_', app()->getLocale()) }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $metaImage }}">
    <meta property="og:image:secure_url" content="{{ $metaImage }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $siteName }} - modern medical and dental care in Istanbul">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $canonicalUrl }}">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImage }}">
    <meta name="twitter:image:alt" content="{{ $siteName }} - modern medical and dental care in Istanbul">
    <script type="application/ld+json">@json($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>

    <title>{{ $metaTitle }}</title>

    <!-- Favicons -->
    <link href="{{ $favicon }}" rel="icon" type="image/png" sizes="48x48">
    <link href="{{ $favicon192 }}" rel="icon" type="image/png" sizes="192x192">
    <link href="{{ $faviconIco }}" rel="shortcut icon" sizes="48x48">
    <link href="{{ $appleTouchIcon }}" rel="apple-touch-icon" sizes="180x180">
    <link href="{{ $manifestUrl }}" rel="manifest">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Main CSS File -->
    <link href="{{ asset('public/assets/css/main.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body class="@yield('body-class', 'index-page')">
    @include('layouts.partials.header')

    <!-- Page Content -->
    <main class="main">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @php
        $whatsappNumber = preg_replace('/\D+/', '', $settings['whatsapp_number'] ?? $settings['contact_phone'] ?? '+905550576555');
        $whatsappMessage = rawurlencode('Hello Vayu Clinic, I would like to book an appointment.');
    @endphp
    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappMessage }}" class="whatsapp-float"
        target="_blank" rel="noopener" aria-label="Contact Vayu Clinic on WhatsApp">
        <span class="whatsapp-float-pulse"></span>
        <i class="bi bi-whatsapp"></i>
        <span class="whatsapp-float-text">WhatsApp</span>
    </a>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('public/assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
