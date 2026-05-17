<!-- Featured Services Section -->
<section id="featured-services" class="featured-services section dark-background">

    <div class="container section-title" data-aos="fade-up">
        <h2>{{ __t('featured_services_title') }}</h2>
        <p>{{ __t('featured_departments_subtitle') }}</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">

            <div class="col-lg-8" data-aos="fade-right" data-aos-delay="200">
                <div class="featured-service-main">
                    <div class="service-image-wrapper">
                        <img src="{{ asset('public/assets/img/health/consultation-4.webp') }}"
                            alt="{{ __t('comprehensive_care_title') }}" class="img-fluid" loading="lazy">
                        <div class="service-overlay">
                            <div class="service-badge">
                                <i class="bi bi-heart-pulse"></i>
                                <span>{{ __t('emergency_care') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-details">
                        <h2>{{ __t('comprehensive_care_title') }}</h2>
                        <p>{{ __t('comprehensive_care_description') }}</p>
                        <a href="{{ url('services') }}" class="main-cta">{{ __t('explore_services') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
                <div class="services-sidebar">
                    @php $sidebarServices = ['dermatology_clinic', 'surgery_center', 'diagnostics_lab']; @endphp
                    @foreach($sidebarServices as $index => $key)
                        <div class="service-item" data-aos="fade-up" data-aos-delay="{{ 400 + $index * 100 }}">
                            <div class="service-icon-wrapper">
                                <i
                                    class="bi {{ $index == 0 ? 'bi-capsule' : ($index == 1 ? 'bi-bandaid' : 'bi-activity') }}"></i>
                            </div>
                            <div class="service-info">
                                <h4>{{ __t($key) }}</h4>
                                <p>{{ __t($key . '_desc') }}</p>
                                <a href="{{ url('services') }}" class="service-link">{{ __t('learn_more') }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="specialties-grid" data-aos="fade-up" data-aos-delay="300">
            <div class="row align-items-center">
                @php $specialties = ['maternal_care', 'vaccination', 'emergency_care', 'advanced_tech']; @endphp
                @foreach($specialties as $index => $spec)
                    <div class="col-lg-3 col-md-6">
                        <div class="specialty-card">
                            <div class="specialty-image">
                                <img src="{{ asset('public/assets/img/health/' . ['maternal-2', 'vaccination-3', 'emergency-1', 'facilities-6'][$index] . '.webp') }}"
                                    alt="{{ __t($spec) }}" class="img-fluid" loading="lazy">
                            </div>
                            <div class="specialty-content">
                                <h5>{{ __t($spec) }}</h5>
                                <span>{{ __t($spec . '_desc') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</section>
