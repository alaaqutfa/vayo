<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $rtl ?? false ? 'rtl' : 'ltr' }}"
    class="{{ $darkMode ?? false ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Authentication') | {{ $settings['site_name'] ?? 'Vayu Clinic' }}</title>

    <!-- Favicons -->
    @if(isset($settings['favicon']))
        <link href="{{ asset('public/storage/'.$settings['favicon']) }}" rel="icon">
    @else
        <link href="{{ asset('public/assets/img/favicon.png') }}" rel="icon">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Tailwind + Flowbite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Main CSS -->
    <link href="{{ asset('public/assets/css/main.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="auth-page">
    <div class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
        <div class="row justify-content-center w-100">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card p-4 p-md-5">
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}" class="flex justify-center items-center">
                            @if(isset($settings['site_logo']) && $settings['site_logo'])
                                <img src="{{ asset('public/storage/'.$settings['site_logo']) }}"
                                    alt="{{ $settings['site_name'] ?? 'Vayu Clinic' }}" class="auth-logo mb-3"
                                    style="max-height: 60px;">
                            @else
                                {{-- <h2 class="text-primary fw-bold">{{ $settings['site_name'] ?? 'Vayu Clinic' }}</h2>
                                --}}
                                <img src="{{ asset('public/assets/img/logo.png') }}" class="h-16 w-auto" alt="Logo">
                            @endif
                        </a>
                    </div>
                    @yield('content')
                </div>
                <div class="text-center mt-4 text-muted small">
                    &copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Vayu Clinic' }}.
                    {{ __t('all_rights_reserved') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/aos/aos.js') }}"></script>
    @stack('scripts')
</body>

</html>
