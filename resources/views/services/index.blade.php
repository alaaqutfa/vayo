@extends('layouts.app')

@section('title', __t('services'))

@section('body-class', 'services-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ __t('services') }}</h1>
                        <p class="mb-0">{{ __t('hero_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __t('home') }}</a></li>
                    <li class="current">{{ __t('services') }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Services Section (dynamic) -->
    <section id="services" class="services section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                @forelse($services as $service)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 + $loop->index * 50 }}">
                        <div class="service-item">
                            <div class="service-image">
                                <img src="{{ $service->image ? asset('public/storage'.$service->image) : asset('public/assets/img/health/default.jpg') }}"
                                    alt="{{ $service->name }}" class="img-fluid">
                                <div class="service-overlay">
                                    <i class="{{ $service->icon ?? 'fas fa-heartbeat' }}"></i>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3>{{ $service->name }}</h3>
                                <p>{{ Str::limit($service->description, 100) }}</p>
                                <div class="service-features">
                                    @foreach(array_slice($service->features ?? [], 0, 2) as $feature)
                                        <span class="feature-item"><i class="fas fa-check"></i> {{ $feature }}</span>
                                    @endforeach
                                </div>
                                <a href="{{ route('services.show', $service->slug) }}" class="service-btn">
                                    <span>{{ __t('learn_more') }}</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>{{ __t('no_services_found') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
