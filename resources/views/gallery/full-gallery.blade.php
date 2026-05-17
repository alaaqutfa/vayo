@if($galleryItems->count())
    @php
        $videos = $galleryItems->where('type', 'video');
        $beforeAfter = $galleryItems->filter(fn($item) => $item->type === 'image' && $item->before_image && $item->after_image);
        $singleImages = $galleryItems->filter(fn($item) => $item->type === 'image' && !$item->before_image && !$item->after_image);
    @endphp

    <section id="gallery" class="gallery vayu-gallery">

        <div class="container">
            {{-- Videos Section --}}
            @if($videos->count())
                <div class="gallery-block gallery-videos" data-aos="fade-up" data-aos-delay="100">
                    <div class="gallery-block-head">
                        <div>
                            <span>{{ __t('Reels & videos') }}</span>
                            <h3>{{ __t('Clinic stories in motion') }}</h3>
                        </div>
                        <a href="{{ route('gallery') }}">{{ __t('View all') }} <i class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="swiper mobile-swiper videos-swiper">
                        <div class="swiper-wrapper">
                            @foreach($videos->take(4) as $item)
                                <div class="swiper-slide">
                                    <div class="reel-card">
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
                                                    <span>{{ __t('Open video') }}</span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="gallery-card-copy">
                                            <h4>{{ $item->title ?: 'Vayu Clinic Video' }}</h4>
                                            @if($item->description)
                                                <p>{{ Str::limit($item->description, 90) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            @endif

            {{-- Before & After Section --}}
            @if($beforeAfter->count())
                <div class="gallery-block gallery-before-after" data-aos="fade-up" data-aos-delay="150">
                    <div class="gallery-block-head">
                        <div>
                            <span>{{ __t('Before & after') }}</span>
                            <h3>{{ __t('Real transformations, clearly shown') }}</h3>
                        </div>
                        <a href="{{ route('gallery') }}">{{ __t('View all') }} <i class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="swiper mobile-swiper beforeafter-swiper">
                        <div class="swiper-wrapper">
                            @foreach($beforeAfter->take(6) as $item)
                                <div class="swiper-slide">
                                    <div class="result-card">
                                        <div class="result-images">
                                            <a href="{{ asset('public/storage/' . $item->before_image) }}" class="result-image glightbox"
                                                data-gallery="before-after-{{ $item->id }}">
                                                <img src="{{ asset('public/storage/' . $item->before_image) }}" alt="{{ $item->title }} before"
                                                    loading="lazy">
                                                <span>{{ __t('Before') }}</span>
                                            </a>
                                            <a href="{{ asset('public/storage/' . $item->after_image) }}" class="result-image glightbox"
                                                data-gallery="before-after-{{ $item->id }}">
                                                <img src="{{ asset('public/storage/' . $item->after_image) }}" alt="{{ $item->title }} after"
                                                    loading="lazy">
                                                <span>{{ __t('After') }}</span>
                                            </a>
                                        </div>
                                        <div class="gallery-card-copy">
                                            <h4>{{ $item->title ?: 'Treatment Result' }}</h4>
                                            @if($item->description)
                                                <p>{{ Str::limit($item->description, 100) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            @endif

            {{-- Single Images Section --}}
            @if($singleImages->count())
                <div class="gallery-block gallery-singles" data-aos="fade-up" data-aos-delay="200">
                    <div class="gallery-block-head">
                        <div>
                            <span>{{ __t('Photo gallery') }}</span>
                            <h3>{{ __t('Moments, spaces, and patient care') }}</h3>
                        </div>
                        <a href="{{ route('gallery') }}">{{ __t('View all') }} <i class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="swiper mobile-swiper singles-swiper">
                        <div class="swiper-wrapper">
                            @foreach($singleImages->take(8) as $item)
                                <div class="swiper-slide">
                                    <a href="{{ asset('public/storage/' . $item->image) }}" class="single-gallery-card glightbox"
                                        data-gallery="single-gallery">
                                        <img src="{{ asset('public/storage/' . $item->image) }}"
                                            alt="{{ $item->title ?: 'Vayu Clinic gallery image' }}" loading="lazy">
                                        <span>
                                            <strong>{{ $item->title ?: 'Vayu Clinic' }}</strong>
                                            @if($item->description)
                                                <small>{{ Str::limit($item->description, 70) }}</small>
                                            @endif
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @push('styles')
        <style>
            /* Basic card styling (kept as is) */
            .gallery-block {
                margin-bottom: 4rem;
            }
            .gallery-block-head {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
                flex-wrap: wrap;
                gap: 1rem;
            }
            .gallery-block-head span {
                font-size: 0.8rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: var(--accent-color);
                font-weight: 500;
            }
            .gallery-block-head h3 {
                margin: 0;
                font-size: 1.6rem;
                font-weight: 500;
            }
            .gallery-block-head a {
                text-decoration: none;
                color: var(--accent-color);
                font-weight: 500;
                transition: 0.2s;
            }
            .gallery-block-head a i {
                transition: transform 0.2s;
            }
            .gallery-block-head a:hover {
                color: color-mix(in srgb, var(--accent-color), black 15%);
            }
            .gallery-block-head a:hover i {
                transform: translateX(4px);
            }

            /* Video card */
            .reel-card {
                background: var(--surface-color);
                border-radius: 1.2rem;
                overflow: hidden;
                box-shadow: 0 8px 20px rgba(0,0,0,0.05);
                height: 100%;
                min-height: 80vh;
                display: flex;
                flex-direction: column;
            }
            .reel-frame {
                min-height: 600px;
                aspect-ratio: 16 / 9;
                background: #000;
            }
            .reel-frame iframe,
            .reel-frame video {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .gallery-card-copy {
                padding: 1rem;
            }
            .gallery-card-copy h4 {
                font-size: 1rem;
                font-weight: 600;
                margin-bottom: 0.25rem;
            }
            .gallery-card-copy p {
                font-size: 0.8rem;
                color: var(--default-color);
                opacity: 0.8;
            }

            /* Before/After card */
            .result-card {
                background: var(--surface-color);
                border-radius: 1.2rem;
                overflow: hidden;
                box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            }
            .result-images {
                display: grid;
                gap: 0.5rem;
                padding: 0.5rem;
            }
            .result-image {
                position: relative;
                flex: 1;
                border-radius: 0.8rem;
                overflow: hidden;
                cursor: zoom-in;
            }
            .result-image img {
                width: 100%;
                aspect-ratio: 1 / 1;
                object-fit: cover;
                transition: transform 0.3s;
            }
            .result-image span {
                position: absolute;
                bottom: 0.5rem;
                left: 0.5rem;
                background: rgba(0,0,0,0.6);
                color: white;
                font-size: 0.7rem;
                padding: 0.2rem 0.6rem;
                border-radius: 30px;
                backdrop-filter: blur(4px);
            }
            .result-image:hover img {
                transform: scale(1.02);
            }

            /* Single image card */
            .single-gallery-card {
                display: block;
                border-radius: 1.2rem;
                overflow: hidden;
                position: relative;
                aspect-ratio: 4 / 3;
                cursor: zoom-in;
            }
            .single-gallery-card img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s;
            }
            .single-gallery-card span {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
                padding: 1rem 0.8rem 0.5rem;
                color: white;
                transform: translateY(100%);
                transition: transform 0.3s;
            }
            .single-gallery-card strong {
                display: block;
                font-size: 0.9rem;
            }
            .single-gallery-card small {
                font-size: 0.7rem;
                opacity: 0.9;
            }
            .single-gallery-card:hover img {
                transform: scale(1.03);
            }
            .single-gallery-card:hover span {
                transform: translateY(0);
            }

            /* ========== RESPONSIVE: GRID on desktop, SWIPER on mobile ========== */
            /* Default: on desktop (>768px) we want grid layout */
            .swiper.mobile-swiper {
                overflow: visible;
            }
            @media (min-width: 769px) {
                .swiper.mobile-swiper .swiper-wrapper {
                    display: grid !important;
                    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                    gap: 1.5rem;
                    transform: none !important;
                    width: 100%;
                }
                .swiper.mobile-swiper .swiper-slide {
                    width: auto !important;
                    margin-right: 0 !important;
                    height: auto !important;
                }
                .swiper.mobile-swiper .swiper-pagination {
                    display: none !important;
                }
                /* Specific for before-after: we want 2 columns on desktop */
                .gallery-before-after .swiper.mobile-swiper .swiper-wrapper {
                    grid-template-columns: repeat(3, 1fr);
                }
            }
            /* Mobile: swiper active */
            @media (max-width: 768px) {
                .swiper.mobile-swiper {
                    padding-bottom: 2rem;
                }
                .swiper.mobile-swiper .swiper-wrapper {
                    display: flex;
                }
                /* .swiper.mobile-swiper .swiper-slide {
                    width: 85% !important;
                    margin-right: 1rem;
                } */
                .swiper.mobile-swiper .swiper-pagination {
                    display: block;
                    position: relative;
                    bottom: -0.5rem;
                    margin-top: 0.5rem;
                    z-index: 10;
                }
            }

            /* Dark mode overrides */
            .dark .reel-card,
            .dark .result-card,
            .dark .single-gallery-card {
                background: #1e293b;
            }
            .dark .gallery-card-copy p {
                color: #cbd5e1;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            let activeSwipers = [];

            function initMobileSwipers() {
                const isMobile = window.innerWidth <= 768;
                const swiperContainers = document.querySelectorAll('.swiper.mobile-swiper');

                // Destroy all existing swipers
                activeSwipers.forEach(swiper => {
                    if (swiper && swiper.destroy) {
                        swiper.destroy(true, true);
                    }
                });
                activeSwipers = [];

                if (isMobile) {
                    swiperContainers.forEach(container => {
                        let autoplayDelay = 3000; // default for videos
                        if (container.classList.contains('beforeafter-swiper') || container.classList.contains('singles-swiper')) {
                            autoplayDelay = 1000; // 1 second for images
                        }
                        const swiper = new Swiper(container, {
                            slidesPerView: 1,
                            spaceBetween: 30,
                            speed: 400,
                            autoplay: {
                                delay: autoplayDelay,
                                disableOnInteraction: false,
                                pauseOnMouseEnter: true,
                            },
                            loop: true,
                            pagination: {
                                el: container.querySelector('.swiper-pagination'),
                                clickable: true,
                            },
                            breakpoints: {
                                480: { slidesPerView: 1, spaceBetween: 16 }
                            }
                        });
                        activeSwipers.push(swiper);
                    });
                } else {
                    // On desktop, we just rely on CSS grid; no swiper needed.
                    // Reset any inline styles that swiper might have left
                    swiperContainers.forEach(container => {
                        const wrapper = container.querySelector('.swiper-wrapper');
                        if (wrapper) {
                            wrapper.style.cssText = '';
                            wrapper.classList.add('reset-grid');
                        }
                        const slides = container.querySelectorAll('.swiper-slide');
                        slides.forEach(slide => {
                            slide.style.cssText = '';
                        });
                    });
                }
            }

            // Run on load
            initMobileSwipers();

            // Run on resize with debounce to avoid performance issues
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    initMobileSwipers();
                }, 250);
            });
        </script>
    @endpush
@endif
