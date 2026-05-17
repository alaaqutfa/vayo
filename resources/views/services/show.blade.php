@extends('layouts.app')

@section('title', $service->name)

@section('body-class', 'service-details-page')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ $service->name }}</h1>
                        <p class="mb-0">{{ Str::limit($service->description, 160) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __t('home') }}</a></li>
                    <li><a href="{{ route('services.index') }}">{{ __t('services') }}</a></li>
                    <li class="current">{{ $service->name }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="service-details-2" class="service-details-2 section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <div class="service-header">
                        <div class="service-category">
                            <span>{{ $service->category ? $service->category->name : __t('specialized_care') }}</span>
                        </div>
                        <h2>{{ $service->name }}</h2>
                        <p class="lead">{{ Str::limit($service->description, 200) }}</p>
                    </div>
                </div>
            </div>

            <div class="row gy-4 align-items-center">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="service-details">
                        @forelse($service->features ?? [] as $feature)
                            <div class="detail-item">
                                <div class="icon-wrapper"><i class="bi bi-check-circle-fill"></i></div>
                                <div class="content">
                                    <h4>{{ $feature }}</h4>
                                </div>
                            </div>
                        @empty
                            <p>{{ __t('no_features') }}</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="service-visual">
                        <img src="{{ $service->image ? asset($service->image) : asset('public/assets/img/health/default-large.jpg') }}"
                            class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <div class="service-overview p-4 bg-light">
                        <h3>{{ __t('services_overview') }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="action-card primary">
                        <div class="card-header"><i class="bi bi-calendar-check"></i>
                            <h4>{{ __t('schedule_consultation') }}</h4>
                        </div>
                        <p>{{ __t('book_your_appointment') }}</p>
                        <div class="card-footer"><a href="{{ url('appointment') }}"
                                class="btn-action">{{ __t('book_now') }}</a><span
                                class="availability">{{ __t('next_available_tomorrow') }}</span></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="action-card secondary">
                        <div class="card-header"><i class="bi bi-telephone"></i>
                            <h4>{{ __t('emergency_consultations') }}</h4>
                        </div>
                        <p>{{ __t('24_7_support') }}</p>
                        <div class="card-footer"><a href="tel:{{ $settings['emergency_phone'] ?? '+905550576555' }}"
                                class="btn-action">{{ __t('call_now') }}</a><span
                                class="availability">{{ $settings['emergency_phone'] ?? '+90 555 057 65 55' }}</span></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="action-card tertiary">
                        <div class="card-header"><i class="bi bi-file-text"></i>
                            <h4>{{ __t('get_second_opinion') }}</h4>
                        </div>
                        <p>{{ __t('expert_review') }}</p>
                        <div class="card-footer"><a href="{{ url('contact') }}"
                                class="btn-action">{{ __t('request_review') }}</a><span
                                class="availability">{{ __t('response_48h') }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
