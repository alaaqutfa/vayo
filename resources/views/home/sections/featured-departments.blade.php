<!-- Featured Departments Section -->
<section id="featured-departments" class="featured-departments section light-background">

    <div class="container section-title" data-aos="fade-up">
        <h2>{{ __t('featured_departments_title') }}</h2>
        <p>{{ __t('featured_departments_subtitle') }}</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        @if($services->count() >= 2)
            <div class="row">
                @foreach($services->take(2) as $service)
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="{{ $loop->index == 0 ? 100 : 200 }}">
                        <div class="specialty-card">
                            <div class="specialty-content">
                                <div class="specialty-meta">
                                    <span class="specialty-label">{{ __t('specialized_care') }}</span>
                                </div>
                                <h3>{{ $service->name }}</h3>
                                <p>{{ Str::limit($service->description, 120) }}</p>
                                <div class="specialty-features">
                                    @foreach(array_slice($service->features ?? [], 0, 2) as $feature)
                                        <span><i class="bi bi-check-circle-fill"></i>{{ $feature }}</span>
                                    @endforeach
                                </div>
                                <a href="{{ url('services/' . $service->slug) }}" class="specialty-link">
                                    {{ __t('learn_more') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="specialty-visual">
                                <img src="{{ asset('public/storage'.$service->image ? asset($service->image) : asset('public/assets/img/health/default.webp') }}"
                                    alt="{{ $service->name }}" class="img-fluid">
                                <div class="visual-overlay">
                                    <i class="{{ $service->icon ?? 'bi bi-heart-pulse' }}"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($services->count() >= 5)
                <div class="row mt-4">
                    @foreach($services->skip(2)->take(3) as $service)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ 100 + $loop->index * 100 }}">
                            <div class="department-highlight">
                                <div class="highlight-icon">
                                    <i class="{{ $service->icon ?? 'bi bi-shield-plus' }}"></i>
                                </div>
                                <h4>{{ $service->name }}</h4>
                                <p>{{ Str::limit($service->description, 90) }}</p>
                                <ul class="highlight-list">
                                    @foreach(array_slice($service->features ?? [], 0, 3) as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ url('services/' . $service->slug) }}" class="highlight-cta">{{ __t('learn_more') }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <!-- Fallback static content if no services exist -->
            <div class="row g-5">
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="specialty-card">...</div>
                </div>
                <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">...</div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">...</div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">...</div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">...</div>
            </div>
        @endif

        <div class="emergency-banner" data-aos="fade-up" data-aos-delay="400">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="emergency-content">
                        <h3>{{ __t('emergency_banner_title') }}</h3>
                        <p>{{ __t('emergency_banner_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="tel:{{ $settings['emergency_phone'] ?? '+905550576555' }}" class="emergency-btn">
                        <i class="bi bi-telephone-fill"></i>
                        {{ __t('call_emergency') }}: {{ $settings['emergency_phone'] ?? '+90 555 057 65 55' }}
                    </a>
                </div>
            </div>
        </div>

    </div>

</section>
