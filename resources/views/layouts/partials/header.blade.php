<header id="header" class="header fixed-top">
    <div class="topbar d-flex align-items-center dark-background">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <div class="contact-info d-flex align-items-center flex-wrap">
                <i class="bi bi-envelope d-flex align-items-center">
                    <a href="mailto:{{ $settings['contact_email'] ?? 'info@vayuclinic.com' }}">
                        {{ $settings['contact_email'] ?? 'info@vayuclinic.com' }}
                    </a>
                </i>
                <i class="bi bi-phone d-flex align-items-center ms-4">
                    <span>{{ $settings['contact_phone'] ?? '+90 555 057 65 55' }}</span>
                </i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                @if(!empty($settings['social_twitter']))
                    <a href="{{ $settings['social_twitter'] }}" class="twitter" aria-label="X" target="_blank" rel="noopener"><i class="bi bi-twitter-x"></i></a>
                @endif
                @if(!empty($settings['social_facebook']))
                    <a href="{{ $settings['social_facebook'] }}" class="facebook" aria-label="Facebook" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                @endif
                @if(!empty($settings['social_instagram']))
                    <a href="{{ $settings['social_instagram'] }}" class="instagram" aria-label="Instagram" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>
                @endif
                @if(!empty($settings['social_linkedin']))
                    <a href="{{ $settings['social_linkedin'] }}" class="linkedin" aria-label="LinkedIn" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                @endif
                @if(!empty($settings['social_youtube']))
                    <a href="{{ $settings['social_youtube'] }}" class="youtube" aria-label="YouTube" target="_blank" rel="noopener"><i class="bi bi-youtube"></i></a>
                @endif
                @if(!empty($settings['social_tiktok']))
                    <a href="{{ $settings['social_tiktok'] }}" class="tiktok" aria-label="TikTok" target="_blank" rel="noopener"><i class="bi bi-tiktok"></i></a>
                @endif
            </div>
        </div>
    </div>

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center" aria-label="{{ $settings['site_name'] ?? 'Vayu Clinic' }}">
                @if(isset($settings['site_logo']) && $settings['site_logo'])
                    <img src="{{ asset($settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Vayu Clinic' }}">
                @else
                    <img src="{{ asset('assets/img/logo.png') }}" alt="{{ $settings['site_name'] ?? 'Vayu Clinic' }}">
                @endif
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">{{ __t('dashboard') }}</a></li>
                    @endauth
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __t('home') }}</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">{{ __t('about') }}</a></li>
                    <li><a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">{{ __t('services') }}</a></li>

                    <li class="dropdown guide-mega">
                        <a href="{{ route('guide.index') }}" class="{{ request()->routeIs('guide.*') ? 'active' : '' }}">
                            <span>{{ __t('guide_menu') }}</span>
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="guide-panel">
                            <div class="guide-panel-intro">
                                <span>{{ __t('patient_guide') }}</span>
                                <h3>{{ __t('guide_intro_title') }}</h3>
                                <p>{{ __t('guide_intro_description') }}</p>
                                <a href="{{ route('guide.index') }}">{{ __t('open_full_guide') }} <i class="bi bi-arrow-right"></i></a>
                            </div>
                            <div class="guide-panel-grid">
                                @foreach($guideCategories->take(6) as $parent)
                                    <a class="guide-panel-item" href="{{ route('guide.category', $parent->slug) }}">
                                        <i class="{{ $parent->icon ?: 'bi bi-journal-medical' }}"></i>
                                        <span>
                                            <strong>{{ $parent->name }}</strong>
                                            @if($parent->children->count())
                                                <small>{{ $parent->children->take(2)->pluck('name')->join(' / ') }}</small>
                                            @else
                                                <small>{{ Str::limit($parent->description, 42) }}</small>
                                            @endif
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">{{ __t('gallery') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">{{ __t('contact') }}</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <div class="header-actions">
                <a href="{{ route('appointment') }}" class="header-appointment">
                    <i class="bi bi-calendar2-check"></i>
                    <span>Book</span>
                </a>
                <div class="language-switcher-modern">
                    <button class="lang-current" type="button" aria-label="Change language">
                        <span class="lang-orbit" aria-hidden="true"></span>
                        <span class="lang-code">{{ strtoupper($currentLocale ?? app()->getLocale()) }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="lang-dropdown">
                        <li>
                            <a href="{{ route('lang.switch', 'en') }}" class="{{ ($currentLocale ?? app()->getLocale()) == 'en' ? 'active' : '' }}">
                                <img src="{{ asset('assets/img/flags/uk.png') }}" alt="English" class="lang-flag" />
                                <span>English</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lang.switch', 'ar') }}" class="{{ ($currentLocale ?? app()->getLocale()) == 'ar' ? 'active' : '' }}">
                                <img src="{{ asset('assets/img/flags/sa.png') }}" alt="Arabic" class="lang-flag" />
                                <span>العربية</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lang.switch', 'fr') }}" class="{{ ($currentLocale ?? app()->getLocale()) == 'fr' ? 'active' : '' }}">
                                <img src="{{ asset('assets/img/flags/fr.png') }}" alt="French" class="lang-flag" />
                                <span>Français</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
