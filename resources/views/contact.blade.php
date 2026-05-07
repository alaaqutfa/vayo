@extends('layouts.app')

@section('title', __t('contact'))
@section('body-class', 'contact-page')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ __t('contact') }}</h1>
                        <p class="mb-0">{{ __t('hero_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">{{ __t('home') }}</a></li>
                    <li class="current">{{ __t('contact') }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="contact-info-wrapper">
                        <div class="contact-info-item" data-aos="fade-up">
                            <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                            <div class="info-content">
                                <h3>{{ __t('our_address') }}</h3>
                                <p>{{ $settings['contact_address'] ?? 'Vayo Clinic Medical Center, Beirut, Lebanon' }}</p>
                            </div>
                        </div>
                        <div class="contact-info-item" data-aos="fade-up">
                            <div class="info-icon"><i class="bi bi-envelope"></i></div>
                            <div class="info-content">
                                <h3>{{ __t('email_address') }}</h3>
                                <p>{{ $settings['contact_email'] ?? 'info@vayoclinic.com' }}</p>
                                <p>{{ $settings['contact_email2'] ?? '' }}</p>
                            </div>
                        </div>
                        <div class="contact-info-item" data-aos="fade-up">
                            <div class="info-icon"><i class="bi bi-headset"></i></div>
                            <div class="info-content">
                                <h3>{{ __t('hours_of_operation') }}</h3>
                                <p>{{ __t('sunday_fri') }} 9 AM - 6 PM</p>
                                <p>{{ __t('saturday') }} 9 AM - 4 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="contact-form-card">
                        <h2>{{ __t('send_us_message') }}</h2>
                        <p class="mb-4">{{ __t('contact_form_description') }}</p>
                        <form action="{{ route('contact.submit') }}" method="post" class="php-email-form">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6"><input type="text" class="form-control" name="name"
                                        placeholder="{{ __t('your_name') }}" required></div>
                                <div class="col-md-6"><input type="email" class="form-control" name="email"
                                        placeholder="{{ __t('your_email') }}" required></div>
                                <div class="col-12"><input type="text" class="form-control" name="subject"
                                        placeholder="{{ __t('subject') }}" required></div>
                                <div class="col-12"><textarea class="form-control" name="message" rows="6"
                                        placeholder="{{ __t('your_message') }}" required></textarea></div>
                                <div class="col-12"><button type="submit"
                                        class="btn btn-submit">{{ __t('send_message') }}</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                width="100%" height="500" style="border:0;" allowfullscreen loading="lazy"></iframe>
        </div>
    </section>
@endsection
