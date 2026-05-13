<!-- Call To Action Section -->
<section id="call-to-action" class="call-to-action section light-background">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="hero-content">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <div class="content-wrapper" data-aos="fade-up" data-aos-delay="200">
                        <h1>{{ __t('cta_title') }}</h1>
                        <p>{{ __t('cta_description') }}</p>

                        <div class="cta-wrapper">
                            <a href="{{ url('appointment') }}" class="primary-cta">
                                <span>{{ __t('schedule_consultation') }}</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            <a href="{{ url('services') }}" class="secondary-cta">
                                <span>{{ __t('explore_services_btn') }}</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="relative w-full">
                        <video class="bg-video" autoplay muted loop playsinline preload="none"
                            poster="{{ asset('assets/videos/vayu-2.jpg') ?? '' }}">
                            <source src="{{ asset('assets/videos/vayu-2.mp4') }}" type="video/mp4">
                        </video>
                        <div class="video-overlay-light"></div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="image-container" data-aos="fade-left" data-aos-delay="300">
                        <img src="{{ asset('assets/img/health/facilities-9.webp') }}" alt="{{ __t('cta_title') }}"
                            class="img-fluid">
                    </div>
                </div>

            </div>
        </div>

        <div class="features-section">

            <div class="row">

                <div class="col-lg-4">
                    <div class="feature-block" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3>{{ __t('advanced_tech_title') }}</h3>
                        <p>{{ __t('advanced_tech_description') }}</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-block" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <h3>{{ __t('availability_title') }}</h3>
                        <p>{{ __t('availability_description') }}</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-block" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>{{ __t('expert_team_title') }}</h3>
                        <p>{{ __t('expert_team_description') }}</p>
                    </div>
                </div>

            </div>

        </div>

        <div class="contact-block">
            <div class="row">

                <div class="col-lg-8">
                    <div class="contact-content" data-aos="fade-up" data-aos-delay="200">
                        <h2>{{ __t('emergency_assistance_title') }}</h2>
                        <p>{{ __t('emergency_assistance_desc') }}</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="contact-actions" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ $settings['social_whatsapp'] ?? 'tel:' . $settings['emergency_phone'] ?? 'tel:+905550576555' }}"
                            class="emergency-call" target="_blank">
                            <i class="bi bi-{{ $settings['social_whatsapp'] ? 'whatsapp' : $settings['emergency_phone'] ?? 'telephone' }}"></i>
                            <span>{{ $settings['emergency_phone'] ?? '+90 555 057 65 55' }}</span>
                        </a>
                        <a href="{{ url('contact') }}" class="contact-link">{{ __t('find_location') }}</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

</section><!-- /Call To Action Section -->

@push('styles')
    <style>
        .bg-video {
            max-height: 200px;
            position: absolute;
            top: 10%;
            left: 0;
        }
    </style>
@endpush
