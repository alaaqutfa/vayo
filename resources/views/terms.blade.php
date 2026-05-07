@extends('layouts.app')

@section('title', $page->title ?? __t('terms'))

@section('body-class', 'terms-page')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ $page->title ?? __t('terms') }}</h1>
                        <p class="mb-0">{{ Str::limit($page->meta_description ?? __t('hero_description'), 160) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">{{ __t('home') }}</a></li>
                    <li class="current">{{ $page->title ?? __t('terms') }}</li>
                </ol>
            </div>
        </nav>
    </div>
    <section id="terms-of-service" class="terms-of-service section">
        <div class="container">{!! $page->content !!}</div>
    </section>
@endsection
