@extends('layouts.app')
@section('title', __t('gallery'))
@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ __t('gallery_title') }}</h1>
                        <p class="mb-0">{{ __t('gallery_subtitle') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __t('home') }}</a></li>
                    <li class="current">{{ __t('gallery_title') }}</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->
    @include('gallery.full-gallery')
@endsection
