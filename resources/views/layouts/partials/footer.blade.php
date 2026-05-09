<footer id="footer" class="footer-16 footer position-relative dark-background">
    <div class="container">
        <div class="footer-main" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-start">
                <div class="col-lg-5">
                    <div class="brand-section">
                        <a href="{{ route('home') }}" class="logo d-flex align-items-center mb-4">
                            @if(isset($settings['site_logo']) && $settings['site_logo'])
                                <img src="{{ asset($settings['site_logo']) }}"
                                    alt="{{ $settings['site_name'] ?? 'Vayo Clinic' }}">
                            @else
                                <img src="{{ asset('assets/img/logo-dark.png') }}" class="h-16 w-auto" alt="Logo">
                                {{-- <span class="sitename">{{ $settings['site_name'] ?? 'Vayo Clinic' }}</span> --}}
                            @endif
                        </a>
                        <p class="brand-description">
                            {{ $settings['footer_text'] ?? 'Providing modern, patient-centered healthcare through trusted specialists, clear communication, and coordinated care for every stage of life.' }}
                        </p>
                        <div class="contact-info mt-5">
                            <div class="contact-item"><i
                                    class="bi bi-geo-alt"></i><span>{{ $settings['contact_address'] ?? 'Vayo Clinic Medical Center, Beirut, Lebanon' }}</span>
                            </div>
                            <div class="contact-item"><i
                                    class="bi bi-telephone"></i><span>{{ $settings['contact_phone'] ?? '+90 555 057 65 55' }}</span>
                            </div>
                            <div class="contact-item"><i class="bi bi-envelope"></i><span>{{ $settings['contact_email']
                                    ?? 'info@vayoclinic.com' }}</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="footer-nav-wrapper">
                        <div class="row">
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>{{ __t('clinic') }}</h6>
                                    <nav class="footer-nav">
                                        <a href="{{ route('page.show', 'about') }}">{{ __t('about_vayo') }}</a>
                                        <a href="{{ route('departments') }}">{{ __t('departments_menu') }}</a>
                                        <a href="{{ route('doctors') }}">{{ __t('our_doctors') }}</a>
                                        <a href="{{ route('testimonials') }}">{{ __t('patient_stories') }}</a>
                                        <a href="{{ route('gallery') }}">{{ __t('gallery') }}</a>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>{{ __t('services_menu') }}</h6>
                                    <nav class="footer-nav">
                                        <a href="{{ route('services.index') }}">{{ __t('all_services') }}</a>
                                        <a href="{{ route('services.index') }}">{{ __t('primary_care') }}</a>
                                        <a href="{{ route('services.index') }}">{{ __t('specialist_care') }}</a>
                                        <a href="{{ route('services.index') }}">{{ __t('diagnostics') }}</a>
                                        <a href="{{ route('services.index') }}">{{ __t('consultations') }}</a>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>{{ __t('resources_menu') }}</h6>
                                    <nav class="footer-nav">
                                        <a href="{{ route('faq') }}">{{ __t('faqs') }}</a>
                                        <a href="{{ route('guide.index') }}">{{ __t('patient_guide') }}</a>
                                        <a href="#">{{ __t('health_articles') }}</a>
                                        <a href="#">{{ __t('visit_preparation') }}</a>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <div class="nav-column">
                                    <h6>{{ __t('connect') }}</h6>
                                    <nav class="footer-nav">
                                        <a href="{{ route('appointment') }}">{{ __t('book_appointment') }}</a>
                                        <a href="{{ route('contact') }}">{{ __t('contact_us') }}</a>
                                        <a
                                            href="tel:{{ $settings['contact_phone'] ?? '+905550576555' }}">{{ __t('call_vayo') }}</a>
                                        <a href="#">{{ __t('newsletter') }}</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        {{-- Dynamic Pages Row (optional) --}}
                        {{-- @if(isset($dynamicPages) && $dynamicPages->count())
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="nav-column">
                                        <h6>{{ __t('more_pages') }}</h6>
                                        <nav class="footer-nav d-flex flex-wrap gap-3">
                                            @foreach($dynamicPages as $page)
                                                <a href="{{ route('page.show', $page->slug) }}">{{ $page->title }}</a>
                                            @endforeach
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="bottom-content" data-aos="fade-up" data-aos-delay="300">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="copyright">
                            <p>&copy; {{ date('Y') }} <span
                                    class="sitename">{{ $settings['site_name'] ?? 'Vayo Clinic' }}</span>.
                                {{ __t('all_rights_reserved') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="legal-links">
                            <a href="{{ route('page.show', 'privacy') }}">{{ __t('privacy_policy') }}</a>
                            <a href="{{ route('page.show', 'terms') }}">{{ __t('terms_of_service') }}</a>
                            <a href="#">{{ __t('cookie_policy') }}</a>
                            {{-- <div class="credits">{{ __t('designed_by') }} <a href="https://alaaqutfa.tech/">Eng.Alaa
                                    Qutfa</a>.</div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
