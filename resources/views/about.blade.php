@extends('layouts.app')

@section('title', $page->title ?? __('Vayu Dental Clinic - About Us'))

@section('body-class', 'about-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ $page->title ?? __('About Vayu Dental Clinic') }}</h1>
                        <p class="mb-0">{{ Str::limit($page->meta_description ?? __('Your smile is our passion. Advanced cosmetic dentistry, gentle care, and exceptional results at Vayu Clinic.'), 160) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li class="current">{{ $page->title ?? __('About Us') }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- About Section (Main Content) -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-content">
                        @if(empty($page->content))
                            {!! $page->content !!}
                        @else
                            <h2>{{ __('Modern Dentistry, Beautiful Smiles') }}</h2>
                            <p class="lead">{{ __('At Vayu Clinic, we combine state-of-the-art technology with a gentle, patient‑first approach to transform your dental experience.') }}</p>
                            <p>{{ __('Whether you need a Hollywood smile makeover, dental implants, Invisalign, or routine preventive care, our team of specialist dentists and hygienists works closely with you to achieve natural, long‑lasting results.') }}</p>
                            <p>{{ __('We believe that a healthy, confident smile changes lives – and we’re here to make that journey comfortable, transparent, and tailored to you.') }}</p>
                            <div class="stats-grid mt-4">
                                <div class="stat-item"><div class="stat-number">5000+</div><div class="stat-label">{{ __('Smiles Transformed') }}</div></div>
                                <div class="stat-item"><div class="stat-number">15+</div><div class="stat-label">{{ __('Years of Excellence') }}</div></div>
                                <div class="stat-item"><div class="stat-number">8</div><div class="stat-label">{{ __('Specialist Dentists') }}</div></div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="image-wrapper">
                        <img src="{{ $page->featured_image ? asset($page->featured_image) : asset('assets/img/health/facilities-6.webp') }}"
                            class="img-fluid main-image" alt="Vayu Clinic modern dental facility"
                            onerror="this.src='https://placehold.co/600x400?text=Vayu+Dental'">
                        <div class="floating-image" data-aos="zoom-in" data-aos-delay="400">
                            <img src="{{ asset('assets/img/health/staff-8.webp') }}" class="img-fluid" alt="Smile transformation"
                                onerror="this.src='https://placehold.co/150x150?text=Smile'">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Core Values (adjusted for dental clinic) -->
            <div class="values-section" data-aos="fade-up" data-aos-delay="300">
                <div class="row section-title" data-aos="fade-up">
                    <h2>{{ __t('Our Core Values') }}</h2>
                    <p>{{ __t('The principles that define every smile we create and every patient we serve.') }}</p>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="value-item">
                            <div class="value-icon"><i class="bi bi-heart-pulse"></i></div>
                            <h4>{{ __('Gentle Compassion') }}</h4>
                            <p>{{ __('We listen, explain, and treat you like family – anxiety‑free dentistry with genuine empathy.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="value-item">
                            <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                            <h4>{{ __('Clinical Excellence') }}</h4>
                            <p>{{ __('Continuous training, modern equipment, and evidence‑based protocols for predictable, superior outcomes.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="value-item">
                            <div class="value-icon"><i class="bi bi-brush"></i></div>
                            <h4>{{ __('Aesthetic Artistry') }}</h4>
                            <p>{{ __('We combine science with art to deliver natural, symmetrical smiles that suit your unique face.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="value-item">
                            <div class="value-icon"><i class="bi bi-lightbulb"></i></div>
                            <h4>{{ __('Advanced Innovation') }}</h4>
                            <p>{{ __('Digital scanning, 3D imaging, laser dentistry, and pain‑free techniques for a modern experience.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accreditations & Certifications (dental‑specific) -->
            <div class="certifications-section" data-aos="fade-up" data-aos-delay="400">
                <div class="row section-title" data-aos="fade-up">
                    <h2>{{ __t('Accreditations & Memberships') }}</h2>
                    <p>{{ __t('Recognised by leading dental and healthcare organisations worldwide.') }}</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="certification-item"><img src="{{ asset('assets/img/clients/clients-1.webp') }}" alt="ADA Member"></div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="certification-item"><img src="{{ asset('assets/img/clients/clients-2.webp') }}" alt="ISO Certified"></div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="certification-item"><img src="{{ asset('assets/img/clients/clients-3.webp') }}" alt="EAO Partner"></div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="certification-item"><img src="{{ asset('assets/img/clients/clients-4.webp') }}" alt="ITI Member"></div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="500">
                        <div class="certification-item"><img src="{{ asset('assets/img/clients/clients-5.webp') }}" alt="BDA Accredited"></div>
                    </div>
                </div>
                <div class="row mt-4 text-center">
                    <div class="col-12"><small class="text-muted">{{ __('American Dental Association · International Team for Implantology · British Dental Association') }}</small></div>
                </div>
            </div>
        </div>
    </section>
@endsection
