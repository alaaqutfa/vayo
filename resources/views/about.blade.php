@extends('layouts.app')

@section('title', $page->title ?? __t('about'))

@section('body-class', 'about-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ $page->title ?? __t('about') }}</h1>
                        <p class="mb-0">{{ Str::limit($page->meta_description ?? __t('hero_description'), 160) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">{{ __t('home') }}</a></li>
                    <li class="current">{{ $page->title ?? __t('about') }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- About Section (محتوى الصفحة) -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-content">
                        {!! $page->content !!}
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="image-wrapper">
                        <img src="{{ $page->featured_image ? asset($page->featured_image) : asset('assets/img/health/facilities-6.webp') }}"
                            class="img-fluid main-image" alt="{{ $page->title }}">
                        <div class="floating-image" data-aos="zoom-in" data-aos-delay="400">
                            <img src="{{ asset('assets/img/health/staff-8.webp') }}" class="img-fluid" alt="Medical team">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
