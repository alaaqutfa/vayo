<header id="header" class="header fixed-top">
    <div class="topbar d-flex align-items-center dark-background">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <div class="contact-info d-flex align-items-center flex-wrap">
                <i class="bi bi-envelope d-flex align-items-center">
                    <a href="mailto:{{ $settings['contact_email'] ?? 'info@vayoclinic.com' }}">
                        {{ $settings['contact_email'] ?? 'info@vayoclinic.com' }}
                    </a>
                </i>
                <i class="bi bi-phone d-flex align-items-center ms-4">
                    <span>{{ $settings['contact_phone'] ?? '+90 555 057 65 55' }}</span>
                </i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between flex-wrap">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                @if(isset($settings['site_logo']) && $settings['site_logo'])
                    <img src="{{ asset($settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Vayo Clinic' }}">
                @else
                    <img src="{{ asset('assets/img/logo.png') }}" class="h-8 w-auto" alt="Logo">
                    {{-- <h1 class="sitename">{{ $settings['site_name'] ?? 'Vayo Clinic' }}</h1> --}}
                @endif
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    @auth
                        <li><a href="{{ route('dashboard') }}"
                                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">{{ __t('dashboard') }}</a>
                        </li>
                    @endauth
                    <li><a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __t('home') }}</a></li>
                    <li><a href="{{ route('about') }}"
                            class="{{ request()->is('about') ? 'active' : '' }}">{{ __t('about') }}</a></li>
                    <li><a href="{{ route('services.index') }}"
                            class="{{ request()->routeIs('services.*') ? 'active' : '' }}">{{ __t('services') }}</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('guide.index') }}">
                            <span>{{ __('Guide Menu') }}</span>
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>
                            @foreach($guideCategories as $parent)
                                <li class="dropdown">
                                    <a href="{{ route('guide.category', $parent->slug) }}">
                                        {{ $parent->name }}
                                        @if($parent->children->count())
                                            <i class="bi bi-chevron-right"></i>
                                        @endif
                                    </a>
                                    @if($parent->children->count())
                                        <ul>
                                            @foreach($parent->children as $child)
                                                <li><a href="{{ route('guide.category', $child->slug) }}">{{ $child->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    {{-- Dropdown for dynamic pages --}}
                    {{-- @if(isset($dynamicPages) && $dynamicPages->count())
                    <li class="dropdown">
                        <a href="#"><span>{{ __t('pages') }}</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            @foreach($dynamicPages as $page)
                            <li><a href="{{ route('page.show', $page->slug) }}">{{ $page->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endif --}}

                    <li><a href="{{ route('contact') }}"
                            class="{{ request()->is('contact') ? 'active' : '' }}">{{ __t('contact') }}</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <!-- Modern Language Switcher -->
            <div class="language-switcher-modern">
                <div class="lang-current">
                    <span class="lang-code">{{ strtoupper($currentLocale) }}</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <ul class="lang-dropdown">
                    <li>
                        <a href="{{ route('lang.switch', 'en') }}" class="{{ $currentLocale == 'en' ? 'active' : '' }}">
                            <img src="{{ asset('assets/img/flags/uk.png') }}" alt="English"
                                class="lang-flag w-4 h-4 object-contain" />
                            English
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('lang.switch', 'ar') }}" class="{{ $currentLocale == 'ar' ? 'active' : '' }}">
                            <img src="{{ asset('assets/img/flags/sa.png') }}" alt="Arabic"
                                class="lang-flag w-4 h-4 object-contain" />
                            العربية
                        </a>
                    </li>
                    <li><a href="{{ route('lang.switch', 'fr') }}" class="{{ $currentLocale == 'fr' ? 'active' : '' }}">
                            <img src="{{ asset('assets/img/flags/fr.png') }}" alt="French"
                                class="lang-flag w-4 h-4 object-contain" />
                            Français
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
