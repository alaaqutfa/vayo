@extends('layouts.app')

@section('title', __t('Doctors') . ' - ' . ($settings['site_name'] ?? 'Vayu Clinic'))

@section('content')
    <section id="doctors-page" class="doctors-page section">

        <div class="container py-24">
            {{-- Hero Header --}}
            <div class="text-center mb-5" data-aos="fade-up">
                <h1 class="display-4 fw-bold gradient-text">{{ __t('Our Expert Doctors') }}</h1>
                <p class="lead text-muted">
                    {{ __t('Meet our team of specialized medical professionals dedicated to your health.') }}
                </p>
            </div>

            {{-- Search & Filter Form --}}
            <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-8">
                    <form method="GET" action="{{ route('doctors') }}" class="search-form">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0"><i
                                            class="bi bi-search"></i></span>
                                    <input type="text" name="name" class="form-control border-start-0"
                                        placeholder="{{ __t('Search by name...') }}" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <select name="specialty" class="form-select">
                                    <option value="">{{ __t('All Specialties') }}</option>
                                    @foreach($specialties as $spec)
                                        <option value="{{ $spec }}" {{ request('specialty') == $spec ? 'selected' : '' }}>
                                            {{ $spec }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">{{ __t('Filter') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Doctors Grid --}}
            <div class="row g-4" data-aos="fade-up" data-aos-delay="200">
                @forelse($doctors as $doctor)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="doctor-card h-100">
                            <div class="doctor-image">
                                <img src="src="{{ asset('public/storage'.$doctor->image) }}" alt="{{ $doctor->name }}" class="img-fluid">
                                <div class="status-badge status-{{ $doctor->status }}">
                                    {{ __t(ucfirst($doctor->status)) }}
                                </div>
                            </div>
                            <div class="doctor-info">
                                <h3 class="doctor-name">{{ $doctor->name }}</h3>
                                <p class="doctor-specialty">{{ $doctor->specialty }}</p>
                                <div class="doctor-meta">
                                    <span><i class="bi bi-briefcase"></i> {{ $doctor->years_experience }}+
                                        {{ __t('years') }}</span>
                                    <span><i class="bi bi-star-fill text-warning"></i>
                                        {{ number_format($doctor->rating, 1) }}</span>
                                    <span><i class="bi bi-chat"></i> {{ $doctor->reviews_count }} {{ __t('reviews') }}</span>
                                </div>
                                <div class="doctor-actions">
                                    <a href="{{ route('doctors.show', $doctor->id) }}"
                                        class="btn btn-outline-primary btn-sm">{{ __t('View Profile') }}</a>
                                    <a href="{{ route('appointment') }}?doctor_id={{ $doctor->id }}"
                                        class="btn btn-primary btn-sm">{{ __t('Book Now') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-emoji-frown display-1 text-muted"></i>
                        <p class="mt-3">{{ __t('No doctors found.') }}</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $doctors->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .gradient-text {
            background: linear-gradient(135deg, var(--accent-color, #012119) 0%, #33ff99 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .doctor-card {
            background: var(--surface-color, #ffffff);
            border-radius: 1.5rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 92%);
        }

        .doctor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.1);
            border-color: color-mix(in srgb, var(--accent-color), transparent 70%);
        }

        .doctor-image {
            position: relative;
            height: 260px;
            overflow: hidden;
        }

        .doctor-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .doctor-card:hover .doctor-image img {
            transform: scale(1.05);
        }

        .status-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            backdrop-filter: blur(4px);
            background: rgba(0, 0, 0, 0.7);
            color: white;
        }

        .status-available {
            background: #10b981;
        }

        .status-busy {
            background: #f59e0b;
        }

        .status-offline {
            background: #6b7280;
        }

        .doctor-info {
            padding: 1.5rem;
        }

        .doctor-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: var(--heading-color);
        }

        .doctor-specialty {
            color: var(--accent-color);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .doctor-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: var(--default-color);
            margin-bottom: 1.25rem;
            border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
            padding-top: 0.75rem;
        }

        .doctor-meta span i {
            margin-right: 4px;
        }

        .doctor-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-outline-primary {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        .btn-outline-primary:hover {
            background: var(--accent-color);
            color: var(--contrast-color);
            border-color: var(--accent-color);
        }

        .btn-primary {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--contrast-color);
        }

        .btn-primary:hover {
            background: color-mix(in srgb, var(--accent-color), black 10%);
            border-color: color-mix(in srgb, var(--accent-color), black 10%);
            color: var(--contrast-color);
        }

        .dark .doctor-card {
            background: #1e293b;
            border-color: #334155;
        }

        .dark .doctor-meta {
            border-top-color: #334155;
        }

        .dark .btn-outline-primary {
            border-color: #33ff99;
            color: #33ff99;
        }

        .dark .btn-outline-primary:hover {
            background: #33ff99;
            color: #012119;
        }

        .dark .doctor-specialty {
            color: #33ff99;
        }
    </style>
@endpush
