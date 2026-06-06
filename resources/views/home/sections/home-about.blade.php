<!-- Home About Section -->
<section id="home-about" class="home-about section dark-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                <div class="about-content">
                    <h2 class="section-heading">{!! __t('Modern Dentistry, Beautiful Smiles') !!}</h2>
                    <p class="lead-text">{{ __t('about_lead') }}</p>
                    <p>{{ __t('about_description') }}</p>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="5000"
                                data-purecounter-duration="1"></div>
                            <div class="stat-label">{{ __t('about_patients_served') }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="15"
                                data-purecounter-duration="1"></div>
                            <div class="stat-label">{{ __t('about_years_excellence') }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="20000"
                                data-purecounter-duration="1"></div>
                            <div class="stat-label">{{ __t('about_medical_specialists') }}</div>
                        </div>
                    </div>
                    <div class="cta-section">
                        <a href="{{ url('about') }}" class="btn-primary">{{ __t('about_learn_more') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="about-visual">
                    <div class="main-image">
                        <img src="{{ asset('public/assets/img/health/facilities-6.webp') }}" alt="{{ __t('Modern medical facility') }}"
                            loading="lazy"
                            class="img-fluid">
                    </div>
                    <div class="floating-card">
                        <div class="card-content">
                            <div class="icon">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                            <div class="card-text">
                                <h4>24/7 {{ __t('Patient Support') }}</h4>
                                <p>{{ __t('Here When Your Smile Needs Care') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="experience-badge">
                        <div class="badge-content">
                            <span class="years">15+</span>
                            <span class="text">{{ __t('Years of Trusted Care') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
