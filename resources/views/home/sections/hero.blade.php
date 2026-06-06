<!-- Hero Section -->
<section id="hero" class="hero section">
    <div class="hero-rhythm" aria-hidden="true"></div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <div class="hero-kicker" data-aos="fade-right" data-aos-delay="150">
                        <i class="bi bi-activity"></i>
                        <span>{{ __t('Advanced Dental & Medical Care') }}</span>
                    </div>

                    <div class="trust-badges mb-4" data-aos="fade-right" data-aos-delay="200">
                        <div class="badge-item">
                            <i class="bi bi-star-fill"></i>
                            <span>{{ __t('5,000+ Happy Patients') }}</span>
                        </div>
                        <div class="badge-item">
                            <i class="bi bi-award"></i>
                            <span>{{ __t('Award-Winning Clinic') }}</span>
                        </div>
                        <div class="badge-item">
                            <i class="bi bi-person-arms-up"></i>
                            <span>{{ __t('International Patients') }}</span>
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
                            <span>{{ __t('Book Appointment') }}</span>
                            <i class="bi bi-arrow-right-short"></i>
                        </a>
                        <a href="#" class="btn btn-outline glightbox">
                            {{ __t('Explore Treatments') }}
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>

                    <div class="hero-stats mb-4" data-aos="fade-right" data-aos-delay="500">
                        <div class="stat-item">
                            <h3>
                                <span class="purecounter" data-purecounter-start="0"
                                    data-purecounter-end="{{ $settings['hero_years_experience'] ?? 15 }}"
                                    data-purecounter-duration="2"></span>+
                            </h3>
                            <p>{{ __t('hero_years_experience') }}</p>
                        </div>
                        <div class="stat-item">
                            <h3>
                                <span class="purecounter" data-purecounter-start="0"
                                    data-purecounter-end="{{ $settings['hero_patients_treated'] ?? 20 }}"
                                    data-purecounter-duration="2"></span>
                                    K+
                                </h3>
                            <p>{{ __t('Procedures Done') }}</p>
                        </div>
                        <div class="stat-item">
                            <h3>
                                <span class="purecounter" data-purecounter-start="0"
                                    data-purecounter-end="{{ $settings['hero_medical_experts'] ?? 99 }}"
                                    data-purecounter-duration="2"></span>%
                            </h3>
                            <p>{{ __t('Success Rate') }}</p>
                        </div>
                        <div class="stat-item">
                            <h3>
                                <span class="purecounter">24/7</span>
                            </h3>
                            <p>{{ __t('Patient Support') }}</p>
                        </div>
                    </div>

                    <div class="emergency-contact" data-aos="fade-right" data-aos-delay="700">
                        <div class="emergency-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div class="emergency-info">
                            <small>{{ __t('Emergency Hotline') }}</small>
                            <strong><a href="{{ $settings['social_whatsapp'] ?? 'tel:' . $settings['emergency_phone'] ?? 'tel:+905550576555' }}" target="_blank">{{ $settings['emergency_phone'] ?? '+90 555 057 65 55' }}</a></strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                    <div class="hero-visual-frame" aria-hidden="true"></div>
                    <div class="hero-logo-mark">
                        <span>{{ __t('Powered by') }}</span>
                        <img src="{{ isset($settings['site_logo']) && $settings['site_logo'] ? asset($settings['site_logo']) : asset('public/assets/img/logo.png') }}"
                            alt="{{ $settings['site_name'] ?? 'Vayu Clinic' }}">
                    </div>
                    <div class="main-image">
                        @if(isset($doctors) && $doctors->count())
                            <div class="swiper hero-doctors-swiper">
                                <div class="swiper-wrapper">
                                    @foreach($doctors as $doctor)
                                        <div class="swiper-slide" data-doctor-name="{{ $doctor->name }}"
                                            data-doctor-specialty="{{ $doctor->specialty }}"
                                            data-doctor-rating="{{ $doctor->rating }}"
                                            data-doctor-reviews="{{ $doctor->reviews_count }}"
                                            data-doctor-years="{{ $doctor->years_experience }}">
                                            <img src="{{ asset('public/storage/'.$doctor->image) }}" alt="{{ $doctor->name }}" class="img-fluid">
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
                            <img src="{{ asset('public/assets/img/health/staff-10.webp') }}" alt="Vayu Clinic medical team"
                                class="img-fluid">
                        @endif

                        <div class="image-shine" aria-hidden="true"></div>

                        {{-- Floating Card: Appointment --}}
                        {{-- <div class="floating-card appointment-card">
                            <div class="card-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="card-content">
                                <h6>Next Available</h6>
                                <p>Today 2:30 PM</p>
                                <small class="doctor-name-placeholder">
                                    {{ isset($doctors) && $doctors->count() ? $doctors->first()->name : 'Vayu Clinic' }}
                                </small>
                            </div>
                        </div> --}}

                        {{-- Floating Card: Care / Satisfaction --}}
                        <div class="floating-card care-card">
                            <div class="care-pulse">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                            <div>
                                <span class="care-specialty-placeholder">
                                    {{ isset($doctors) && $doctors->count() ? $doctors->first()->specialty : 'Smile Design' }}
                                </span>
                                <strong class="care-satisfaction-placeholder">
                                    @php
                                        $firstRating = isset($doctors) && $doctors->count() ? $doctors->first()->rating : 4.9;
                                        $satisfaction = round(($firstRating / 5) * 100);
                                    @endphp
                                    {{ $satisfaction }}% Satisfaction
                                </strong>
                            </div>
                        </div>

                        {{-- Floating Card: Rating --}}
                        <div class="floating-card rating-card">
                            <div class="card-content">
                                <div class="rating-stars">
                                    @php
                                        $firstRating = isset($doctors) && $doctors->count() ? $doctors->first()->rating : 4.9;
                                        $fullStars = floor($firstRating);
                                        $halfStar = ($firstRating - $fullStars) >= 0.5;
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $fullStars)
                                            <i class="bi bi-star-fill"></i>
                                        @elseif($halfStar && $i == $fullStars + 1)
                                            <i class="bi bi-star-half"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <h6 class="rating-value-placeholder">{{ number_format($firstRating, 1) }}/5</h6>
                                <small class="reviews-count-placeholder">
                                    {{ isset($doctors) && $doctors->count() ? number_format($doctors->first()->reviews_count) : '1,234' }}
                                    {{ __t('Reviews') }}
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Service Strip (clinic-wide, can stay static or be dynamic) --}}
                    <div class="hero-service-strip" aria-label="Featured treatments">
                        <span><i class="bi bi-check2-circle"></i> {{ __t('Implants') }}</span>
                        <span><i class="bi bi-check2-circle"></i> {{ __t('Veneers') }}</span>
                        <span><i class="bi bi-check2-circle"></i> {{ __t('Emergency') }}</span>
                        <span><i class="bi bi-check2-circle"></i> {{ __t('Emergency') }}</span>
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
                const swiper = new Swiper(heroDoctors, {
                    loop: true,
                    effect: 'fade',
                    speed: 900,
                    autoplay: {
                        delay: 3600,
                        disableOnInteraction: false
                    },
                    allowTouchMove: false
                });

                // Function to update cards based on active slide data
                function updateCardsFromActiveSlide() {
                    const activeSlide = swiper.slides[swiper.activeIndex];
                    if (!activeSlide) return;

                    const name = activeSlide.dataset.doctorName;
                    const specialty = activeSlide.dataset.doctorSpecialty;
                    const rating = parseFloat(activeSlide.dataset.doctorRating);
                    const reviews = parseInt(activeSlide.dataset.doctorReviews);

                    // Update Appointment card
                    const doctorNameElem = document.querySelector('.appointment-card small.doctor-name-placeholder');
                    if (doctorNameElem && name) doctorNameElem.textContent = name;

                    // Update Care card
                    const careSpecialtyElem = document.querySelector('.care-card .care-specialty-placeholder');
                    if (careSpecialtyElem && specialty) careSpecialtyElem.textContent = specialty;

                    const satisfaction = Math.round((rating / 5) * 100);
                    const careSatisfactionElem = document.querySelector('.care-card .care-satisfaction-placeholder');
                    if (careSatisfactionElem) careSatisfactionElem.textContent = `${satisfaction}% Satisfaction`;

                    // Update Rating card
                    const ratingValueElem = document.querySelector('.rating-card .rating-value-placeholder');
                    const reviewsCountElem = document.querySelector('.rating-card .reviews-count-placeholder');
                    const starsContainer = document.querySelector('.rating-card .rating-stars');

                    if (ratingValueElem && !isNaN(rating)) ratingValueElem.textContent = `${rating.toFixed(1)}/5`;
                    if (reviewsCountElem && !isNaN(reviews)) reviewsCountElem.textContent = reviews.toLocaleString() + ' Reviews';

                    // Update stars dynamically
                    if (starsContainer && !isNaN(rating)) {
                        const fullStars = Math.floor(rating);
                        const hasHalfStar = (rating - fullStars) >= 0.5;
                        starsContainer.innerHTML = '';
                        for (let i = 1; i <= 5; i++) {
                            if (i <= fullStars) {
                                starsContainer.innerHTML += '<i class="bi bi-star-fill"></i>';
                            } else if (hasHalfStar && i === fullStars + 1) {
                                starsContainer.innerHTML += '<i class="bi bi-star-half"></i>';
                            } else {
                                starsContainer.innerHTML += '<i class="bi bi-star"></i>';
                            }
                        }
                    }
                }

                // Update on slide change
                swiper.on('slideChange', function () {
                    updateCardsFromActiveSlide();
                });

                // Initial update
                updateCardsFromActiveSlide();
            }
        });
    </script>
@endpush
