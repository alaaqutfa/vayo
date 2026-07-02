<!-- Featured Services Section -->
<section id="featured-services" class="featured-services section dark-background">

    <div class="container section-title" data-aos="fade-up">
        <h2>{{ __t('featured_services_title') }}</h2>
        <p>{{ __t('featured_departments_subtitle') }}</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        @php
            $displayServices = $dentistryServices->isNotEmpty() ? $dentistryServices : $services;
            $featuredService = $displayServices->first();
            $sidebarServices = $displayServices->skip(1)->take(3);
            $specialties = $displayServices->skip(4)->take(4);
            if ($specialties->isEmpty()) {
                $specialties = $displayServices->skip(1)->take(4);
            }
            $mainImage = $featuredService && $featuredService->image
                ? (\Illuminate\Support\Str::startsWith($featuredService->image, 'assets/') ? public_asset($featuredService->image) : storage_asset($featuredService->image))
                : public_asset('assets/img/health/default.webp');
        @endphp

        <div class="row g-0">

            <div class="col-lg-8" data-aos="fade-right" data-aos-delay="200">
                <div class="featured-service-main">
                    <div class="service-image-wrapper">
                        <img src="{{ $mainImage }}"
                            alt="{{ $featuredService->name ?? __t('featured_services_title') }}" class="img-fluid" loading="lazy">
                        <div class="service-overlay">
                            <div class="service-badge">
                                <i class="bi bi-heart-pulse"></i>
                                <span>{{ $featuredService?->category?->name ?? $featuredService?->name ?? __t('featured_services_title') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-details">
                        <h2>{{ $featuredService->name ?? __t('featured_services_title') }}</h2>
                        <p>{{ $featuredService->description ?? __t('comprehensive_care_description') }}</p>
                        <a href="{{ $featuredService ? route('services.show', $featuredService->slug) : url('services') }}" class="main-cta">{{ __t('explore_services') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
                <div class="services-sidebar">
                    @forelse($sidebarServices as $service)
                        <div class="service-item" data-aos="fade-up" data-aos-delay="{{ 400 + $loop->index * 100 }}">
                            <div class="service-icon-wrapper">
                                <i class="{{ $service->icon ?? 'bi bi-activity' }}"></i>
                            </div>
                            <div class="service-info">
                                <h4>{{ $service->name }}</h4>
                                <p>{{ \Illuminate\Support\Str::limit($service->description, 100) }}</p>
                                <a href="{{ route('services.show', $service->slug) }}" class="service-link">{{ __t('learn_more') }}</a>
                            </div>
                        </div>
                    @empty
                        <p>{{ __t('no_services_found') }}</p>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="specialties-grid" data-aos="fade-up" data-aos-delay="300">
            <div class="row align-items-center">
                @foreach($specialties as $service)
                    <div class="col-lg-3 col-md-6">
                        <div class="specialty-card">
                            <div class="specialty-image">
                                <img src="{{ $service->image ? (Str::startsWith($service->image, 'assets/') ? public_asset($service->image) : storage_asset($service->image)) : public_asset('assets/img/health/default.webp') }}"
                                    alt="{{ $service->name }}" class="img-fluid" loading="lazy">
                            </div>
                            <div class="specialty-content">
                                <h5>{{ $service->name }}</h5>
                                <span>{{ \Illuminate\Support\Str::limit($service->description, 85) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</section>

