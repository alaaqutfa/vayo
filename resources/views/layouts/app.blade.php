<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $rtl ?? false ? 'rtl' : 'ltr' }}" class="{{ $darkMode ?? false ? 'dark' : '' }}>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', '')">
    <meta name="keywords" content="@yield('keywords', '')">

    <title>@yield('title', $settings['site_name'] ?? 'Vayo Clinic')</title>

    <!-- Favicons -->
    @if(isset($settings['favicon']))
        <link href="{{ asset($settings['favicon']) }}" rel="icon">
    @else
        <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    @endif
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body class="@yield('body-class', 'index-page')">
    @include('layouts.partials.header')

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @php
        $whatsappNumber = preg_replace('/\D+/', '', $settings['whatsapp_number'] ?? $settings['contact_phone'] ?? '+905550576555');
        $whatsappMessage = rawurlencode('Hello Vayo Clinic, I would like to book an appointment.');
    @endphp
    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappMessage }}" class="whatsapp-float"
        target="_blank" rel="noopener" aria-label="Contact Vayo Clinic on WhatsApp">
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
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
