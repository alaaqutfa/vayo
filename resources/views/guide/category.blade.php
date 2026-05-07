@extends('layouts.app')

@section('title', $category->name . ' - ' . ($settings['site_name'] ?? 'Vayo Clinic'))

@section('content')
<section id="guide-category-page" class="guide-category-page section light-background">
    <div class="guide-category-page py-24">
        <div class="container">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none"><i
                                class="bi bi-house-door me-1"></i>{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('guide.index') }}"
                            class="text-decoration-none">{{ __('Guide') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                </ol>
            </nav>

            {{-- Category Header --}}
            <div class="row align-items-center mb-5" data-aos="fade-up">
                <div class="col-lg-8">
                    <div class="category-header">
                        <span class="badge bg-primary-soft text-primary mb-3 px-3 py-1 rounded-pill">
                            @if($category->parent_id) {{ $category->parent->name ?? 'Subcategory' }} @else
                            {{ __('Main Category') }} @endif
                        </span>
                        <h1 class="display-4 fw-bold mb-3">{{ $category->name }}</h1>
                        @if($category->description)
                            <p class="lead text-muted">{{ $category->description }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="header-stats d-flex justify-content-lg-end gap-4">
                        <div class="stat-item text-center">
                            <span
                                class="stat-number">{{ $services->count() + $category->children->sum(fn($c) => $c->services->count()) }}</span>
                            <span class="stat-label">{{ __('Treatments') }}</span>
                        </div>
                        <div class="stat-item text-center">
                            <span class="stat-number">{{ $category->children->count() }}</span>
                            <span class="stat-label">{{ __('Subcategories') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Subcategories Section --}}
            @if($category->children->count())
                <div class="mb-5" data-aos="fade-up">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="flex-grow-1 border-bottom border-2 border-primary" style="max-width: 60px;"></div>
                        <h3 class="h4 mb-0 text-uppercase fw-light">{{ __('Specialties') }}</h3>
                        <div class="flex-grow-1 border-bottom"></div>
                    </div>
                    <div class="row g-4">
                        @foreach($category->children->sortBy('order') as $child)
                            <div class="col-md-4 col-sm-6">
                                <div class="subcategory-card h-100">
                                    <div class="subcategory-icon mb-3">
                                        @php
                                            $subIcons = [
                                                'Dental Veneers' => 'bi bi-eyeglasses',
                                                'Teeth Whitening' => 'bi bi-brightness-alt-high',
                                                'Invisalign' => 'bi bi-align-start',
                                                'Dental Implants' => 'bi bi-gear',
                                                'Root Canal' => 'bi bi-bandaid',
                                                'Gum Surgery' => 'bi bi-scissors',
                                            ];
                                            $iconFallback = 'bi bi-grid-1x2';
                                            $icon = $subIcons[$child->name] ?? $iconFallback;
                                        @endphp
                                        <i class="{{ $icon }}"></i>
                                    </div>
                                    <h4 class="h6 fw-bold">{{ $child->name }}</h4>
                                    @php $childServices = $child->services->take(4); @endphp
                                    @if($childServices->count())
                                        <ul class="list-unstyled small mt-2">
                                            @foreach($childServices as $service)
                                                <li><a href="{{ route('services.show', $service->slug) }}"
                                                        class="service-item-link">{{ $service->name }}</a></li>
                                            @endforeach
                                        </ul>
                                        @if($child->services->count() > 4)
                                            <a href="{{ route('guide.category', $child->slug) }}" class="btn-link mt-2 d-inline-block">
                                                {{ __('See all') }} <i class="bi bi-arrow-right-short"></i>
                                            </a>
                                        @endif
                                    @else
                                        <p class="text-muted small mt-2">{{ __('No services yet') }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Direct Services belonging to this category (if any) --}}
            @if($services->count())
                <div data-aos="fade-up">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="flex-grow-1 border-bottom border-2 border-primary" style="max-width: 60px;"></div>
                        <h3 class="h4 mb-0 text-uppercase fw-light">{{ __('Treatments & Procedures') }}</h3>
                        <div class="flex-grow-1 border-bottom"></div>
                    </div>
                    <div class="row g-4">
                        @foreach($services as $service)
                            <div class="col-md-4 col-sm-6">
                                <div class="service-card h-100">
                                    <div class="service-card-body">
                                        <div class="service-icon mb-3">
                                            <i class="{{ $service->icon ?? 'bi bi-heart-pulse' }}"></i>
                                        </div>
                                        <h5 class="card-title fw-semibold">{{ $service->name }}</h5>
                                        <p class="card-text small text-muted">{{ Str::limit($service->description, 90) }}</p>
                                        <a href="{{ route('services.show', $service->slug) }}"
                                            class="btn btn-sm btn-outline-primary rounded-pill mt-2">
                                            {{ __('Learn More') }} <i class="bi bi-arrow-right-short"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($category->children->isEmpty() && $services->isEmpty())
                <div class="alert alert-info text-center py-5" data-aos="fade-up">
                    <i class="bi bi-info-circle display-6"></i>
                    <p class="mt-3">{{ __('No content available in this category yet. Check back soon.') }}</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('styles')
    <style>
        /* Stats */
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-color, #012119);
            display: block;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--default-color, #6c757d);
        }

        /* Subcategory Card */
        .subcategory-card {
            background: var(--surface-color, #ffffff);
            border-radius: 1.25rem;
            padding: 1.5rem;
            transition: 0.25s ease;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 92%);
        }

        .subcategory-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05);
            border-color: color-mix(in srgb, var(--accent-color), transparent 80%);
        }

        .subcategory-icon i {
            font-size: 2rem;
            color: var(--accent-color);
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            padding: 12px;
            border-radius: 16px;
        }

        .service-item-link {
            text-decoration: none;
            color: var(--default-color);
            font-size: 0.8rem;
            transition: 0.2s;
            display: inline-block;
            margin-bottom: 0.25rem;
        }

        .service-item-link:hover {
            color: var(--accent-color);
            transform: translateX(4px);
        }

        /* Service Card */
        .service-card {
            background: var(--surface-color, #ffffff);
            border-radius: 1.25rem;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 92%);
            transition: 0.3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.1);
            border-color: color-mix(in srgb, var(--accent-color), transparent 70%);
        }

        .service-card-body {
            padding: 1.5rem;
        }

        .service-icon i {
            font-size: 2rem;
            color: var(--accent-color);
        }

        .btn-outline-primary {
            border-color: color-mix(in srgb, var(--accent-color), transparent 70%);
            color: var(--accent-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--contrast-color);
        }

        /* Dark mode support */
        .dark .subcategory-card,
        .dark .service-card {
            background: #1e293b;
            border-color: #334155;
        }

        .dark .subcategory-icon i {
            background: color-mix(in srgb, #33ff99, transparent 85%);
            color: #33ff99;
        }

        .dark .service-item-link,
        .dark .stat-label {
            color: #94a3b8;
        }
    </style>
@endpush
