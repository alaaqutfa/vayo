@extends('layouts.app')
@section('title', __t('gallery'))


@php
    $videos = $galleryItems->where('type', 'video');
    $beforeAfter = $galleryItems->filter(fn($item) => $item->type === 'image' && $item->before_image && $item->after_image);
    $singleImages = $galleryItems->filter(fn($item) => $item->type === 'image' && !$item->before_image && !$item->after_image);
@endphp

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

    <div class="container">
        @if($videos->count())
            <div class="gallery-block gallery-videos" data-aos="fade-up" data-aos-delay="100">
                <div class="gallery-block-head">
                    <div>
                        <span>Reels & videos</span>
                        <h3>Clinic stories in motion</h3>
                    </div>
                    <a href="{{ route('gallery') }}">View all <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="reels-grid">
                    @foreach($videos->take(4) as $item)
                        <article class="reel-card">
                            <div class="reel-frame">
                                @if($item->embed_html)
                                    {!! $item->embed_html !!}
                                @elseif($item->youtube_id || $item->embed_url)
                                    <iframe src="{{ $item->embed_url }}" title="{{ $item->title ?: 'Vayu Clinic video' }}"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen loading="lazy"></iframe>
                                @elseif($item->is_direct_video)
                                    <video controls playsinline preload="metadata">
                                        <source src="{{ $item->video_url }}">
                                    </video>
                                @else
                                    <a href="{{ $item->video_url }}" target="_blank" rel="noopener" class="video-link-card">
                                        <i class="bi bi-play-circle"></i>
                                        <span>Open video</span>
                                    </a>
                                @endif
                            </div>
                            <div class="gallery-card-copy">
                                <h4>{{ $item->title ?: 'Vayu Clinic Video' }}</h4>
                                @if($item->description)
                                    <p>{{ Str::limit($item->description, 90) }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        @if($beforeAfter->count())
            <div class="gallery-block gallery-before-after" data-aos="fade-up" data-aos-delay="150">
                <div class="gallery-block-head">
                    <div>
                        <span>Before & after</span>
                        <h3>Real transformations, clearly shown</h3>
                    </div>
                </div>

                <div class="before-after-grid">
                    @foreach($beforeAfter->take(6) as $item)
                        <article class="result-card">
                            <div class="result-images">
                                <a href="{{ asset('storage/' . $item->before_image) }}" class="result-image glightbox"
                                    data-gallery="before-after-{{ $item->id }}">
                                    <img src="{{ asset('storage/' . $item->before_image) }}" alt="{{ $item->title }} before"
                                        loading="lazy">
                                    <span>Before</span>
                                </a>
                                <a href="{{ asset('storage/' . $item->after_image) }}" class="result-image glightbox"
                                    data-gallery="before-after-{{ $item->id }}">
                                    <img src="{{ asset('storage/' . $item->after_image) }}" alt="{{ $item->title }} after"
                                        loading="lazy">
                                    <span>After</span>
                                </a>
                            </div>
                            <div class="gallery-card-copy">
                                <h4>{{ $item->title ?: 'Treatment Result' }}</h4>
                                @if($item->description)
                                    <p>{{ Str::limit($item->description, 100) }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        @if($singleImages->count())
            <div class="gallery-block gallery-singles" data-aos="fade-up" data-aos-delay="200">
                <div class="gallery-block-head">
                    <div>
                        <span>Photo gallery</span>
                        <h3>Moments, spaces, and patient care</h3>
                    </div>
                </div>

                <div class="single-gallery-grid">
                    @foreach($singleImages->take(8) as $item)
                        <a href="{{ asset('storage/' . $item->image) }}" class="single-gallery-card glightbox"
                            data-gallery="single-gallery">
                            <img src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->title ?: 'Vayu Clinic gallery image' }}" loading="lazy">
                            <span>
                                <strong>{{ $item->title ?: 'Vayu Clinic' }}</strong>
                                @if($item->description)
                                    <small>{{ Str::limit($item->description, 70) }}</small>
                                @endif
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
