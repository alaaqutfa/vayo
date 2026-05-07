@extends('layouts.app')

@section('title', '404 - ' . __t('page_not_found'))

@section('body-class', 'page-404')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">404</h1>
                        <p class="mb-0">{{ __t('hero_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">{{ __t('home') }}</a></li>
                    <li class="current">404</li>
                </ol>
            </div>
        </nav>
    </div>
    <section id="error-404" class="error-404 section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="error-number">404</div>
                    <h1 class="error-title">{{ __t('page_not_found') }}</h1>
                    <p class="error-description">{{ __t('404_description') }}</p>
                    <div class="error-actions"><a href="{{ url('/') }}" class="btn-primary"><i class="bi bi-house"></i>
                            {{ __t('back_to_home') }}</a><a href="{{ url('services') }}" class="btn-secondary"><i
                                class="bi bi-search"></i> {{ __t('search_site') }}</a></div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-10">
                    <div class="helpful-links">
                        <h3>{{ __t('you_might_be_looking_for') }}</h3>
                        <div class="links-grid"><a href="{{ url('about') }}" class="link-item"><i
                                    class="bi bi-info-circle"></i><span>{{ __t('about') }}</span></a><a
                                href="{{ url('contact') }}" class="link-item"><i
                                    class="bi bi-telephone"></i><span>{{ __t('contact') }}</span></a><a
                                href="{{ route('services.index') }}" class="link-item"><i
                                    class="bi bi-grid-3x3-gap"></i><span>{{ __t('services') }}</span></a><a
                                href="{{ url('faq') }}" class="link-item"><i
                                    class="bi bi-question-circle"></i><span>{{ __t('faqs') }}</span></a><a
                                href="{{ url('privacy') }}" class="link-item"><i
                                    class="bi bi-shield-check"></i><span>{{ __t('privacy_policy') }}</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
