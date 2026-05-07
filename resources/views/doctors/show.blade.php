@extends('layouts.app')

@section('title', $doctor->name . ' - ' . ($settings['site_name'] ?? 'Vayo Clinic'))

@section('content')
    <section id="doctor-details-page" class="doctor-details-page section light-background">
        <div class="container py-24">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('doctors') }}">{{ __('Doctors') }}</a></li>
                    <li class="breadcrumb-item active">{{ $doctor->name }}</li>
                </ol>
            </nav>

            <div class="row g-5">
                {{-- Doctor Profile Card --}}
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="doctor-profile-card text-center">
                        <div class="doctor-avatar">
                            <img src="{{ $doctor->image_url }}" alt="{{ $doctor->name }}" class="img-fluid rounded-circle">
                            <div class="status-badge status-{{ $doctor->status }}">{{ __(ucfirst($doctor->status)) }}</div>
                        </div>
                        <h2 class="mt-3">{{ $doctor->name }}</h2>
                        <p class="specialty-badge">{{ $doctor->specialty }}</p>
                        <div class="rating-info mb-3">
                            <span class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($doctor->rating))
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @elseif($i == ceil($doctor->rating) && $doctor->rating != floor($doctor->rating))
                                        <i class="bi bi-star-half text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-secondary"></i>
                                    @endif
                                @endfor
                            </span>
                            <span class="ms-2">{{ number_format($doctor->rating, 1) }} ({{ $doctor->reviews_count }}
                                {{ __('reviews') }})</span>
                        </div>
                        <div class="doctor-meta-details">
                            <div class="meta-item"><i class="bi bi-briefcase"></i> {{ $doctor->years_experience }}+
                                {{ __('years experience') }}
                            </div>
                            @if($doctor->email)
                                <div class="meta-item"><i class="bi bi-envelope"></i> {{ $doctor->email }}</div>
                            @endif
                            @if($doctor->phone)
                                <div class="meta-item"><i class="bi bi-telephone"></i> {{ $doctor->phone }}</div>
                            @endif
                        </div>
                        <div class="action-buttons mt-4">
                            <a href="{{ route('appointment') }}?doctor_id={{ $doctor->id }}"
                                class="btn btn-primary w-100 mb-2">{{ __('Book Appointment') }}</a>
                            <a href="#contact" class="btn btn-outline-primary w-100">{{ __('Contact Doctor') }}</a>
                        </div>
                    </div>
                </div>

                {{-- Doctor Bio & Services --}}
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="doctor-bio">
                        <h3 class="section-title">{{ __('Biography') }}</h3>
                        <div class="bio-content">
                            {!! nl2br(e($doctor->bio)) !!}
                        </div>
                    </div>

                    @if($doctor->services->count())
                        <div class="doctor-services mt-5">
                            <h3 class="section-title">{{ __('Specialized Services') }}</h3>
                            <div class="row g-3">
                                @foreach($doctor->services as $service)
                                    <div class="col-md-6">
                                        <div class="service-tag">
                                            <i class="bi bi-check-circle-fill"></i> {{ $service->name }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($doctor->education || $doctor->certifications)
                        <div class="doctor-credentials mt-5">
                            <h3 class="section-title">{{ __('Credentials') }}</h3>
                            @if($doctor->education)
                                <div class="credential-item"><i class="bi bi-mortarboard"></i> {{ $doctor->education }}</div>
                            @endif
                            @if($doctor->certifications)
                                <div class="credential-item"><i class="bi bi-award"></i> {{ $doctor->certifications }}</div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .doctor-profile-card {
            background: var(--surface-color, #fff);
            border-radius: 2rem;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            position: relative;
        }

        .doctor-avatar {
            position: relative;
            display: inline-block;
        }

        .doctor-avatar img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border: 5px solid var(--accent-color);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            color: white;
        }

        .specialty-badge {
            display: inline-block;
            background: color-mix(in srgb, var(--accent-color), transparent 90%);
            color: var(--accent-color);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.85rem;
        }

        .meta-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            font-size: 0.9rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1rem;
            border-left: 4px solid var(--accent-color);
            padding-left: 1rem;
        }

        .bio-content {
            line-height: 1.8;
            color: var(--default-color);
        }

        .service-tag {
            background: color-mix(in srgb, var(--accent-color), transparent 92%);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            color: var(--accent-color);
        }

        .service-tag i {
            margin-right: 6px;
        }

        .credential-item {
            padding: 0.5rem 0;
            font-size: 1rem;
        }

        .credential-item i {
            color: var(--accent-color);
            width: 30px;
        }

        .dark .doctor-profile-card {
            background: #1e293b;
            border-color: #334155;
        }

        .dark .meta-item {
            border-bottom-color: #334155;
        }

        .dark .specialty-badge {
            background: color-mix(in srgb, #33ff99, transparent 85%);
            color: #33ff99;
        }

        .dark .service-tag {
            background: color-mix(in srgb, #33ff99, transparent 85%);
            color: #33ff99;
        }
    </style>
@endpush
