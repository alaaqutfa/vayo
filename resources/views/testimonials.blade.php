@extends('layouts.app')

@section('title', __t('patient_stories'))

@section('body-class', 'testimonials-page')

@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">{{ __t('patient_stories') }}</h1>
                        <p class="mb-0">{{ __t('hero_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">{{ __t('home') }}</a></li>
                    <li class="current">{{ __t('patient_stories') }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                @forelse($testimonials as $testimonial)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item h-100">
                            <div class="service-content">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    @if($testimonial->image)
                                        <img src="{{ asset('public/storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}"
                                            class="rounded-circle" width="64" height="64" style="object-fit: cover;">
                                    @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 64px; height: 64px; background: rgba(193, 143, 95, 0.12); color: #c18f5f;">
                                            <i class="bi bi-person fs-4"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="mb-1">{{ $testimonial->name }}</h3>
                                        @if($testimonial->position)
                                            <p class="mb-0 text-muted">{{ $testimonial->position }}</p>
                                        @endif
                                    </div>
                                </div>

                                @if($testimonial->rating)
                                    <div class="mb-3" aria-label="Rating: {{ $testimonial->rating }} out of 5">
                                        @for($i = 0; $i < 5; $i++)
                                            <i class="bi {{ $i < $testimonial->rating ? 'bi-star-fill' : 'bi-star' }}"
                                                style="color: #c18f5f;"></i>
                                        @endfor
                                    </div>
                                @endif

                                <p class="mb-0">{{ $testimonial->content }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h3 class="mb-3">{{ __t('patient_stories') }}</h3>
                            <p class="mb-0">{{ __t('No testimonials are available right now.') }}</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if(method_exists($testimonials, 'links'))
                <div class="mt-5 d-flex justify-content-center">
                    {{ $testimonials->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
