<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $rtl ?? false ? 'rtl' : 'ltr' }}"
    class="{{ $darkMode ?? false ? 'dark' : '' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', '')">
    <meta name="keywords" content="@yield('keywords', '')">
    <title>@yield('title', 'Admin Dashboard') | {{ $settings['site_name'] ?? 'Vayo Clinic' }}</title>

    <!-- Favicons -->
    @if(isset($settings['favicon']))
        <link href="{{ asset($settings['favicon']) }}" rel="icon">
    @else
        <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    @endif
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Bootstrap Icons (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">

    <!-- Tailwind + Flowbite (compiled) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        /* Force primary color overrides for Flowbite and Tailwind default blue */
        .bg-primary {
            background-color: #012119 !important;
        }

        .bg-primary-600 {
            background-color: #012119 !important;
        }

        .hover\:bg-primary-600:hover {
            background-color: #012119 !important;
        }

        .text-primary {
            color: #012119 !important;
        }

        .border-primary {
            border-color: #012119 !important;
        }

        .ring-primary {
            --tw-ring-color: #012119 !important;
        }

        .focus\:ring-primary:focus {
            --tw-ring-color: #012119 !important;
        }

        .focus\:border-primary:focus {
            border-color: #012119 !important;
        }

        /* Override Flowbite's blue button classes */
        .btn-primary,
        .bg-blue-600,
        .bg-blue-700,
        [class*="bg-blue-"],
        .hover\:bg-blue-600:hover,
        .hover\:bg-blue-700:hover {
            background-color: #012119 !important;
        }

        .text-blue-600,
        .text-blue-700,
        [class*="text-blue-"] {
            color: #012119 !important;
        }

        /* Sidebar active link */
        .sidebar-active {
            background-color: rgba(1, 33, 25, 0.1);
            color: #012119;
            border-right: 3px solid #012119;
        }

        .dark .sidebar-active {
            background-color: rgba(1, 33, 25, 0.3);
            color: #33FF99;
            border-right-color: #33FF99;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 antialiased font-sans">

    <div class="relative">
        <!-- Topbar -->
        @include('admin.partials.topbar')

        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <main class="pt-16 sm:ml-64 transition-all duration-300">
            <div class="min-h-screen px-4 py-6 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>
