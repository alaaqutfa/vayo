@if($galleryItems->count())
    <section id="gallery" class="gallery section">
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ __t('gallery_title') }}</h2>
            <p>{{ __t('gallery_subtitle') }}</p>
        </div>

        {{-- Filter Buttons --}}
        <div class="container text-center mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="btn-group flex-wrap gap-2 justify-content-center">
                <button type="button" class="filter-btn btn btn-outline-primary active" data-filter="all">
                    {{ __t('all') ?? 'All' }}
                </button>
                <button type="button" class="filter-btn btn btn-outline-primary" data-filter="image">
                    {{ __t('images') ?? 'Images' }}
                </button>
                <button type="button" class="filter-btn btn btn-outline-primary" data-filter="before-after">
                    {{ __t('before_after') ?? 'Before & After' }}
                </button>
                <button type="button" class="filter-btn btn btn-outline-primary" data-filter="video">
                    {{ __t('videos') ?? 'Videos' }}
                </button>
            </div>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="200">
            <div class="row g-4" id="gallery-grid">
                @foreach($galleryItems as $item)
                    @php
                        $itemType = $item->type;
                        // تحديد فئة إضافية لعرض قبل/بعد
                        $subType = ($item->type == 'image' && $item->before_image && $item->after_image) ? 'before-after' : $item->type;
                    @endphp
                    <div class="gallery-card col-xl-3 col-lg-4 col-md-6" data-type="{{ $subType }}">
                        <div class="gallery-item h-100">
                            @if($item->type == 'image')
                                @if($item->before_image && $item->after_image)
                                    {{-- Before / After Card --}}
                                    <div class="before-after-card">
                                        <div class="ba-images">
                                            <div class="ba-image ba-before">
                                                <img src="{{ asset($item->before_image) }}" class="img-fluid" alt="{{ $item->title }} - Before">
                                                <span class="ba-label">{{ __t('before') ?? 'Before' }}</span>
                                            </div>
                                            <div class="ba-arrow">
                                                <i class="bi bi-arrow-right-short"></i>
                                            </div>
                                            <div class="ba-image ba-after">
                                                <img src="{{ asset($item->after_image) }}" class="img-fluid" alt="{{ $item->title }} - After">
                                                <span class="ba-label">{{ __t('after') ?? 'After' }}</span>
                                            </div>
                                        </div>
                                        @if($item->title || $item->description)
                                            <div class="gallery-caption mt-3 text-center">
                                                <h5 class="mb-1">{{ $item->title }}</h5>
                                                <p class="small text-muted">{{ $item->description }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    {{-- Single Image Card --}}
                                    <div class="single-image-card">
                                        <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->title }}">
                                        @if($item->title || $item->description)
                                            <div class="gallery-caption mt-2 text-center">
                                                <h5 class="mb-0">{{ $item->title }}</h5>
                                                <p class="small text-muted">{{ $item->description }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @else
                                {{-- Video Card --}}
                                <div class="video-card">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="https://www.youtube.com/embed/{{ $item->youtube_id }}"
                                                title="{{ $item->title }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    </div>
                                    @if($item->title || $item->description)
                                        <div class="gallery-caption mt-2 text-center">
                                            <h5 class="mb-0">{{ $item->title }}</h5>
                                            <p class="small text-muted">{{ $item->description }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- Overlay Icons (glightbox) --}}
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                @if($item->type == 'image')
                                    @if($item->before_image && $item->after_image)
                                        <a href="{{ asset($item->after_image) }}" class="glightbox preview-link" data-gallery="gallery-{{ $item->id }}">
                                            <i class="bi bi-arrows-angle-expand"></i>
                                        </a>
                                    @else
                                        <a href="{{ asset($item->image) }}" class="glightbox preview-link" data-gallery="gallery-{{ $item->id }}">
                                            <i class="bi bi-arrows-angle-expand"></i>
                                        </a>
                                    @endif
                                @else
                                    <a href="https://www.youtube.com/watch?v={{ $item->youtube_id }}" class="glightbox preview-link" data-gallery="gallery-{{ $item->id }}">
                                        <i class="bi bi-play-circle"></i>
                                    </a>
                                @endif
                                <a href="#" class="details-link" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $item->id }}">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Modal for details (optional) --}}
                    <div class="modal fade" id="galleryModal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">{{ $item->title }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    @if($item->type == 'image')
                                        <img src="{{ asset($item->image ?: $item->after_image) }}" class="img-fluid rounded">
                                    @else
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/{{ $item->youtube_id }}" allowfullscreen></iframe>
                                        </div>
                                    @endif
                                    <p class="mt-3">{{ $item->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('styles')
    <style>
        /* Gallery filter buttons */
        .filter-btn {
            border-radius: 40px !important;
            padding: 0.5rem 1.5rem;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
            border-width: 1px;
            background-color: var(--surface-color, #fff);
            color: var(--heading-color, #012119);
            border-color: color-mix(in srgb, var(--accent-color, #012119), transparent 70%);
        }
        .filter-btn.active,
        .filter-btn:hover {
            background-color: var(--accent-color, #012119) !important;
            color: var(--contrast-color, #33ff99) !important;
            border-color: var(--accent-color, #012119) !important;
        }
        /* Before/After card styling */
        .before-after-card .ba-images {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            background: var(--surface-color, #fff);
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
        }
        .ba-image {
            flex: 1;
            position: relative;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .ba-image img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .ba-label {
            position: absolute;
            bottom: 8px;
            left: 8px;
            background: rgba(0,0,0,0.6);
            color: white;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 500;
        }
        .ba-arrow i {
            font-size: 2rem;
            color: var(--accent-color);
        }
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            background: var(--surface-color);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px rgba(0,0,0,0.1);
        }
        .gallery-links {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(1,33,25,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            opacity: 0;
            transition: 0.3s;
            border-radius: 1rem;
        }
        .gallery-item:hover .gallery-links {
            opacity: 1;
        }
        .gallery-links a {
            color: white;
            font-size: 1.5rem;
            background: rgba(255,255,255,0.2);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }
        .gallery-links a:hover {
            background: var(--contrast-color, #33ff99);
            color: var(--accent-color, #012119);
            transform: scale(1.1);
        }
        /* Hide items based on filter */
        .gallery-card[data-type] {
            display: block;
        }
        .gallery-card.filtered-out {
            display: none !important;
        }
        @media (max-width: 768px) {
            .ba-images {
                flex-direction: column;
            }
            .ba-arrow {
                transform: rotate(90deg);
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const filter = this.dataset.filter;
                    // update active state
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    galleryItems.forEach(item => {
                        const type = item.dataset.type;
                        if (filter === 'all' || filter === type) {
                            item.classList.remove('filtered-out');
                        } else {
                            item.classList.add('filtered-out');
                        }
                    });
                });
            });
            // Reinitialize glightbox after filters? Already existing.
        });
    </script>
    @endpush
@endif
