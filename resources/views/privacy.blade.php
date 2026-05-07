@extends('layouts.app')

@section('title', $page->title ?? __t('privacy'))

@section('body-class', 'privacy-page')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ $page->title ?? __t('privacy') }}</h1>
                        <p class="mb-0">{{ Str::limit($page->meta_description ?? __t('hero_description'), 160) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">{{ __t('home') }}</a></li>
                    <li class="current">{{ $page->title ?? __t('privacy') }}</li>
                </ol>
            </div>
        </nav>
    </div>
    <section id="privacy" class="privacy section">
        <div class="container">{!! $page->content !!}</div>
    </section>
@endsection
