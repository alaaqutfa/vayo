@if($galleryItems->count())
    @php
        $videos = $galleryItems->where('type', 'video');
        $beforeAfter = $galleryItems->filter(fn($item) => $item->type === 'image' && $item->before_image && $item->after_image);
        $singleImages = $galleryItems->filter(fn($item) => $item->type === 'image' && !$item->before_image && !$item->after_image);
    @endphp

    <section id="gallery" class="gallery section vayo-gallery">
        <div class="container section-title" data-aos="fade-up">
            <span class="section-kicker">Visual results</span>
            <h2>{{ __t('gallery_title') }}</h2>
            <p>{{ __t('gallery_subtitle') }}</p>
        </div>

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
                                        <iframe src="{{ $item->embed_url }}" title="{{ $item->title ?: 'Vayo Clinic video' }}"
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
                                    <h4>{{ $item->title ?: 'Vayo Clinic Video' }}</h4>
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
                                    <a href="{{ asset('storage/'.$item->before_image) }}" class="result-image glightbox"
                                        data-gallery="before-after-{{ $item->id }}">
                                        <img src="{{ asset('storage/'.$item->before_image) }}" alt="{{ $item->title }} before" loading="lazy">
                                        <span>Before</span>
                                    </a>
                                    <a href="{{ asset('storage/'.$item->after_image) }}" class="result-image glightbox"
                                        data-gallery="before-after-{{ $item->id }}">
                                        <img src="{{ asset('storage/'.$item->after_image) }}" alt="{{ $item->title }} after" loading="lazy">
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
                            <a href="{{ asset('storage/'.$item->image) }}" class="single-gallery-card glightbox" data-gallery="single-gallery">
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title ?: 'Vayo Clinic gallery image' }}"
                                    loading="lazy">
                                <span>
                                    <strong>{{ $item->title ?: 'Vayo Clinic' }}</strong>
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
    </section>
@endif
