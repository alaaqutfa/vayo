@extends('layouts.app')

@section('title', __t('Treatment Guide') . ' - ' . ($settings['site_name'] ?? 'Vayu Clinic'))

@push('styles')
    <style>
        /* Section title style */

        .section-title-border {
            font-size: 2rem;
            font-weight: 500;
            position: relative;
            display: inline-block;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .section-title-border:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--accent-color, #012119);
            border-radius: 3px;
        }

        /* Category Card (old design) */
        .category-card {
            background: var(--surface-color, #ffffff);
            border-radius: 1.5rem;
            padding: 1.8rem 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid color-mix(in srgb, var(--default-color, #3c4049), transparent 92%);
            position: relative;
            overflow: hidden;
        }
        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: color-mix(in srgb, var(--accent-color, #012119), transparent 70%);
        }
        .card-icon {
            width: 60px;
            height: 60px;
            background: color-mix(in srgb, var(--accent-color, #012119), transparent 90%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--accent-color, #012119);
            transition: 0.3s;
        }
        .category-card:hover .card-icon {
            background: var(--accent-color, #012119);
            color: var(--contrast-color, #33ff99);
            transform: scale(1.05);
        }
        .services-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .service-link {
            font-size: 0.85rem;
            color: var(--default-color, #3c4049);
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .service-link i {
            font-size: 0.75rem;
            transition: transform 0.2s;
        }
        .service-link:hover {
            color: var(--accent-color, #012119);
            transform: translateX(4px);
        }
        .service-link.view-all {
            margin-top: 0.3rem;
            font-weight: 500;
            color: var(--accent-color, #012119);
            border-top: 1px dashed color-mix(in srgb, var(--default-color), transparent 85%);
            padding-top: 0.5rem;
        }

        /* Department card inside tabs */
        .department-card {
            background: var(--surface-color, #ffffff);
            border-radius: 1.2rem;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .department-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }
        .department-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 50px;
            height: 50px;
            background: var(--accent-color, #012119);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--contrast-color, #33ff99);
            font-size: 1.5rem;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .department-image {
            height: 200px;
            overflow: hidden;
        }
        .department-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .department-card:hover .department-image img {
            transform: scale(1.03);
        }
        .department-content {
            padding: 1.5rem;
            flex: 1;
        }
        .department-content h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        .department-content p {
            color: var(--default-color);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        .learn-more {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            color: var(--accent-color);
            transition: 0.2s;
        }
        .learn-more i {
            transition: transform 0.2s;
        }
        .learn-more:hover {
            color: color-mix(in srgb, var(--accent-color), black 15%);
        }
        .learn-more:hover i {
            transform: translateX(4px);
        }

        /* Tabs styling */
        .specialty-navigation {
            margin-bottom: 2rem;
        }
        .nav-pills .nav-link {
            border-radius: 50px;
            padding: 0.7rem 1.8rem;
            margin: 0 0.3rem;
            font-weight: 500;
            background: transparent;
            color: var(--default-color);
            border: 1px solid #dee2e6;
        }
        .nav-pills .nav-link.active {
            background: var(--accent-color);
            color: var(--contrast-color);
            border-color: var(--accent-color);
        }

        /* Dark mode */
        .dark .category-card,
        .dark .department-card {
            background: #1e293b;
            border-color: #334155;
        }
        .dark .service-link {
            color: #cbd5e1;
        }
        .dark .service-link:hover {
            color: #33ff99;
        }
        .dark .nav-pills .nav-link {
            border-color: #475569;
            color: #e2e8f0;
        }
        .dark .nav-pills .nav-link.active {
            background: #33ff99;
            color: #012119;
            border-color: #33ff99;
        }
    </style>
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ __t('Treatment Guide') }}</h1>
                        <p>{{ __t('Your guide to a healthier smile.') }}</p>
                        <p class="mb-0">{{ __t('Explore our patient resources, learn about procedures, and make informed decisions about your dental care.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __t('home') }}</a></li>
                    <li class="current">{{ __t('Treatment Guide') }}</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Departments Tabs Section (ديناميكي حسب الأقسام الرئيسية) -->
    <section id="departments-tabs" class="departments-tabs section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="medical-specialties">
                <div class="row">
                    <div class="col-12">
                        <div class="specialty-navigation">
                            <div class="nav nav-pills d-flex flex-wrap justify-content-center" id="specialty-tabs" role="tablist">
                                @foreach($categories as $index => $category)
                                    <a class="nav-link department-tab {{ $loop->first ? 'active' : '' }}"
                                       id="tab-{{ $category->slug }}"
                                       data-bs-toggle="pill"
                                       href="#tabcontent-{{ $category->slug }}"
                                       role="tab"
                                       aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                       data-aos="fade-up"
                                       data-aos-delay="{{ 100 + $index * 50 }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="tab-content department-content" id="specialty-content">
                            @foreach($categories as $category)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                     id="tabcontent-{{ $category->slug }}"
                                     role="tabpanel"
                                     aria-labelledby="tab-{{ $category->slug }}">
                                    <div class="row g-5">
                                        @forelse($category->children->sortBy('order') as $child)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="department-card h-100">
                                                    <div class="department-icon">
                                                        @php
                                                            $childIcons = [
                                                                'Dental Veneers' => 'fas fa-tooth',
                                                                'Teeth Whitening' => 'fas fa-star',
                                                                'Invisalign' => 'fas fa-bezier-curve',
                                                                'Dental Implants' => 'fas fa-microscope',
                                                                'Root Canal Treatment' => 'fas fa-tools',
                                                                'Gum Contouring Surgery' => 'fas fa-scissors',
                                                            ];
                                                            $icon = $childIcons[$child->name] ?? 'fas fa-brush';
                                                        @endphp
                                                        <i class="{{ $icon }}"></i>
                                                    </div>
                                                    <div class="department-image">
                                                        <img src="{{ asset('assets/img/health/dental-placeholder.webp') }}"
                                                             alt="{{ $child->name }}"
                                                             class="img-fluid"
                                                             onerror="this.src='https://placehold.co/400x300?text=Dental'">
                                                    </div>
                                                    <div class="department-content">
                                                        <h3>{{ $child->name }}</h3>
                                                        @php
                                                            $servicesCount = $child->services->count();
                                                            $serviceNames = $child->services->take(3)->pluck('name')->implode(' · ');
                                                        @endphp
                                                        <p>{{ $child->description ?? __t('Comprehensive care for') . ' ' . $child->name . '.' }}</p>
                                                        <div class="mt-2 small text-muted">
                                                            @if($servicesCount)
                                                                <i class="bi bi-check-circle-fill text-primary me-1"></i>
                                                                {{ $servicesCount }} {{ __t('treatments') }}
                                                                @if($serviceNames)
                                                                    <span class="d-block small">{{ $serviceNames }}</span>
                                                                @endif
                                                            @else
                                                                {{ __t('No services listed yet') }}
                                                            @endif
                                                        </div>
                                                        <a href="{{ route('guide.category', $child->slug) }}" class="learn-more mt-3">
                                                            <span>{{ __t('Explore services') }}</span>
                                                            <i class="fas fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-5">
                                                <i class="bi bi-folder2-open display-3 text-muted"></i>
                                                <p class="mt-2">{{ __t('No subcategories found in this section.') }}</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Departments Tabs Section -->

    <!-- All Treatments Grid (Category Cards) -->
    <section id="guide-index-page" class="guide-index-page section light-background">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title-border">{{ __t('All Treatments') }}</h2>
                <p class="text-muted">{{ __t('Browse all dental treatments organized by category') }}</p>
            </div>

            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="category-card h-100">
                            <div class="card-icon mb-3">
                                @php
                                    $icons = [
                                        'Cosmetic Dentistry' => 'bi bi-brush',
                                        'Restorative Dentistry' => 'bi bi-tools',
                                        'Dental Implants' => 'bi bi-gear-wide-connected',
                                        'Oral Health' => 'bi bi-heart-pulse',
                                    ];
                                    $icon = $icons[$category->name] ?? 'bi bi-question-circle';
                                @endphp
                                <i class="{{ $icon }}"></i>
                            </div>
                            <h3 class="h5 fw-semibold mb-2">
                                <a href="{{ route('guide.category', $category->slug) }}" class="stretched-link text-decoration-none">
                                    {{ $category->name }}
                                </a>
                            </h3>
                            @if($category->description)
                                <p class="text-muted small mb-3">{{ Str::limit($category->description, 90) }}</p>
                            @endif
                            <div class="services-list mt-auto">
                                @foreach($category->children->sortBy('order')->take(5) as $child)
                                    <a href="{{ route('guide.category', $child->slug) }}" class="service-link">
                                        <i class="bi bi-chevron-right"></i> {{ $child->name }}
                                    </a>
                                @endforeach
                                @if($category->children->count() > 5)
                                    <a href="{{ route('guide.category', $category->slug) }}" class="service-link view-all">
                                        <i class="bi bi-eye"></i> {{ __t('View all') }} ({{ $category->children->count() }})
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
