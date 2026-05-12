@extends('layouts.app')

@section('title', __t('book_appointment') . ' - ' . ($settings['site_name'] ?? 'Vayu Clinic'))

@section('content')
    <section id="appointment-page" class="appointment-page section">
        <div class="container py-24">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="appointment-card" data-aos="fade-up">
                        <div class="appointment-header text-center">
                            <h1 class="display-5 fw-bold gradient-text">{{ __t('schedule_your_appointment') }}</h1>
                            <p class="text-muted">
                                {{ __t('appointment_description') }}
                            </p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center mt-4" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('appointment.store') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">{{ __t('full_name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __t('email_address') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                        required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __t('phone_number') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __t('preferred_date') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                        value="{{ old('date') }}" required>
                                    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __t('department_service') }}</label>
                                    <select name="department" class="form-select">
                                        <option value="">{{ __t('select_a_service') }}</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ old('department') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __t('preferred_doctor') }}</label>
                                    <select name="doctor_id" class="form-select">
                                        <option value="">{{ __t('select_a_doctor') }}</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }} - {{ $doctor->specialty }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ __t('additional_notes') }}</label>
                                    <textarea name="message" rows="4"
                                        class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-lg w-100">{{ __t('confirm_appointment') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .appointment-card {
            background: var(--surface-color, #fff);
            border-radius: 2rem;
            padding: 2rem;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.05);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent-color, #012119) 0%, #33ff99 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .form-label {
            font-weight: 500;
            color: var(--heading-color);
        }

        .form-control,
        .form-select {
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 80%);
            border-radius: 0.75rem;
            padding: 0.6rem 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem color-mix(in srgb, var(--accent-color), transparent 80%);
        }

        .btn-primary {
            background: var(--accent-color);
            border: none;
            padding: 0.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-primary:hover {
            background: color-mix(in srgb, var(--accent-color), black 10%);
            transform: translateY(-2px);
        }

        .dark .appointment-card {
            background: #1e293b;
        }

        .dark .form-control,
        .dark .form-select {
            background: #0f172a;
            border-color: #334155;
            color: #e2e8f0;
        }
    </style>
@endpush
