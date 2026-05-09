<!-- Hero Section -->
<section id="hero" class="hero section">
    <div class="hero-rhythm" aria-hidden="true"></div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <div class="hero-kicker" data-aos="fade-right" data-aos-delay="150">
                        <i class="bi bi-activity"></i>
                        <span>Advanced Dental & Medical Care</span>
                    </div>

                    <div class="trust-badges mb-4" data-aos="fade-right" data-aos-delay="200">
                        <div class="badge-item">
                            <i class="bi bi-shield-check"></i>
                            <span>Accredited</span>
                        </div>
                        <div class="badge-item">
                            <i class="bi bi-clock"></i>
                            <span>24/7 Emergency</span>
                        </div>
                        <div class="badge-item">
                            <i class="bi bi-star-fill"></i>
                            <span>4.9/5 Rating</span>
                        </div>
                    </div>

                    <h1 data-aos="fade-right" data-aos-delay="300">
                        {!! __t('hero_title') !!}
                    </h1>

                    <p class="hero-description" data-aos="fade-right" data-aos-delay="400">
                        {{ __t('hero_description') }}
                    </p>

                    <div class="hero-actions" data-aos="fade-right" data-aos-delay="500">
                        <a href="{{ url('appointment') }}" class="btn btn-primary">
                            <span>Book Appointment</span>
                            <i class="bi bi-arrow-right-short"></i>
                        </a>
                        <a href="#" class="btn btn-outline glightbox">
                            <i class="bi bi-play-circle me-2"></i>
                            Watch About Vayo
                        </a>
                    </div>

                    <div class="hero-stats mb-4" data-aos="fade-right" data-aos-delay="500">
                        <div class="stat-item">
                            <h3><span class="purecounter" data-purecounter-start="0"
                                    data-purecounter-end="{{ $settings['hero_years_experience'] ?? 15 }}"
                                    data-purecounter-duration="2"></span>+</h3>
                            <p>{{ __t('hero_years_experience') }}</p>
                        </div>
                        <div class="stat-item">
                            <h3><span class="purecounter" data-purecounter-start="0"
                                    data-purecounter-end="{{ $settings['hero_patients_treated'] ?? 5000 }}"
                                    data-purecounter-duration="2"></span>+</h3>
                            <p>{{ __t('hero_patients_treated') }}</p>
                        </div>
                        <div class="stat-item">
                            <h3><span class="purecounter" data-purecounter-start="0"
                                    data-purecounter-end="{{ $settings['hero_medical_experts'] ?? 50 }}"
                                    data-purecounter-duration="2"></span>+</h3>
                            <p>{{ __t('hero_medical_experts') }}</p>
                        </div>
                    </div>

                    <div class="emergency-contact" data-aos="fade-right" data-aos-delay="700">
                        <div class="emergency-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div class="emergency-info">
                            <small>Emergency Hotline</small>
                            <strong><a href="https://wa.me/905550576555" target="_blank">+90 555 057 65 55</a></strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                    <div class="hero-visual-frame" aria-hidden="true"></div>
                    <div class="hero-logo-mark">
                        <span>Powered by</span>
                        <img src="{{ isset($settings['site_logo']) && $settings['site_logo'] ? asset($settings['site_logo']) : asset('assets/img/logo.png') }}"
                            alt="{{ $settings['site_name'] ?? 'Vayo Clinic' }}">
                    </div>
                    <div class="main-image">
                        @if(isset($doctors) && $doctors->count())
                            <div class="swiper hero-doctors-swiper">
                                <div class="swiper-wrapper">
                                    @foreach($doctors as $doctor)
                                        <div class="swiper-slide">
                                            <img src="{{ $doctor->image_url }}" alt="{{ $doctor->name }}" class="img-fluid">
                                            <div class="hero-doctor-caption">
                                                <span>{{ $doctor->specialty }}</span>
                                                <strong>{{ $doctor->name }}</strong>
                                                <small>{{ $doctor->years_experience }} years experience</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <img src="{{ asset('assets/img/health/staff-10.webp') }}" alt="Vayo Clinic medical team"
                                class="img-fluid">
                        @endif
                        <div class="image-shine" aria-hidden="true"></div>
                        <div class="floating-card appointment-card">
                            <div class="card-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="card-content">
                                <h6>Next Available</h6>
                                <p>Today 2:30 PM</p>
                                <small>{{ isset($doctors) && $doctors->count() ? $doctors->first()->name : 'Vayo Clinic' }}</small>
                            </div>
                        </div>
                        <div class="floating-card care-card">
                            <div class="care-pulse">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                            <div>
                                <span>Smile Design</span>
                                <strong>98% Satisfaction</strong>
                            </div>
                        </div>
                        <div class="floating-card rating-card">
                            <div class="card-content">
                                <div class="rating-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <h6>4.9/5</h6>
                                <small>1,234 Reviews</small>
                            </div>
                        </div>
                    </div>
                    <div class="hero-service-strip" aria-label="Featured treatments">
                        <span><i class="bi bi-check2-circle"></i> Implants</span>
                        <span><i class="bi bi-check2-circle"></i> Veneers</span>
                        <span><i class="bi bi-check2-circle"></i> Emergency</span>
                    </div>
                    <div class="background-elements">
                        <div class="element element-1"></div>
                        <div class="element element-2"></div>
                        <div class="element element-3"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section><!-- /Hero Section -->

@push('scripts')
    <script>
        window.addEventListener('load', function () {
            const heroDoctors = document.querySelector('.hero-doctors-swiper');
            if (heroDoctors && typeof Swiper !== 'undefined') {
                new Swiper(heroDoctors, {
                    loop: true,
                    effect: 'fade',
                    speed: 900,
                    autoplay: {
                        delay: 3600,
                        disableOnInteraction: false
                    },
                    allowTouchMove: false
                });
            }
        });
    </script>
@endpush
