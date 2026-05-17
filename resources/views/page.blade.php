@extends('layouts.app')

@section('title', $page->title ?? 'Page')

@section('body-class', 'page-details-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ $page->title }}</h1>
                        <p class="mb-0">
                            {{ Str::limit($page->meta_description ?? $page->excerpt ?? __t('hero_description'), 160) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __t('home') }}</a></li>
                    <li class="current">{{ $page->title }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <!-- Page Content -->
    <section class="page-content section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12">
                    @if($page->featured_image)
                        <div class="featured-image mb-5 text-center">
                            <img src="src="{{ asset('public/storage'.$page->featured_image) }}" alt="{{ $page->title }}"
                                class="img-fluid rounded shadow-sm">
                        </div>
                    @endif
                    <div class="page-body">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
