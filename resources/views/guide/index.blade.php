@extends('layouts.app')

@section('title', __('Guide') . ' - ' . ($settings['site_name'] ?? 'Vayo Clinic'))

@section('content')
    <section id="guide-index-page" class="guide-index-page section light-background">
        <div class="guide-index-page py-24">
            <div class="container">
                {{-- Hero Section with gradient --}}
                <div class="row justify-content-center text-center mb-5" data-aos="fade-up">
                    <div class="col-lg-8">
                        <div class="hero-badge mb-3">
                            <span class="badge bg-primary-soft text-primary px-3 py-2 rounded-pill">
                                <i class="bi bi-compass me-1"></i> {{ __('Treatment Guide') }}
                            </span>
                        </div>
                        <h1 class="display-3 fw-bold mb-3 gradient-text">{{ __('Your guide to a healthier smile.') }}</h1>
                        <p class="lead text-muted">
                            {{ __('Explore our patient resources, learn about procedures, and make informed decisions about your dental care.') }}
                        </p>
                    </div>
                </div>

                {{-- Categories Grid --}}
                <div class="row g-4 mt-3">
                    @foreach($categories as $category)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="category-card h-100">
                                {{-- Card Header Icon --}}
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
                                    <a href="{{ route('guide.category', $category->slug) }}"
                                        class="stretched-link text-decoration-none">
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
                                            <i class="bi bi-eye"></i> {{ __('View all') }} ({{ $category->children->count() }})
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, var(--accent-color, #012119) 0%, color-mix(in srgb, var(--accent-color, #012119), #33ff99 50%) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Category Card */
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

        .service-link:hover i {
            transform: translateX(3px);
        }

        .service-link.view-all {
            margin-top: 0.3rem;
            font-weight: 500;
            color: var(--accent-color, #012119);
            border-top: 1px dashed color-mix(in srgb, var(--default-color), transparent 85%);
            padding-top: 0.5rem;
        }

        /* Dark mode overrides (if using class dark) */
        .dark .category-card {
            background: var(--surface-color-dark, #1e293b);
            border-color: #334155;
        }

        .dark .service-link {
            color: #cbd5e1;
        }

        .dark .service-link:hover {
            color: var(--contrast-color, #33ff99);
        }
    </style>
@endpush
