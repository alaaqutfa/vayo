@if($testimonials->count())
    <section class="testimonials section">
        <!-- محتوى الشهادات كما هو موجود (لم يتغير) -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ __t('testimonials_title') }}</h2>
            <p>{{ __t('testimonials_subtitle') }}</p>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper testimonials-swiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="stars mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill {{ $i <= $testimonial->rating ? 'text-warning' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                                <p class="testimonial-text">{{ $testimonial->content }}</p>
                                <div class="d-flex align-items-center mt-4 gap-3">
                                    <div class="avatar-wrapper">
                                        <img src="{{ $testimonial->image ? asset($testimonial->image) : asset('public/assets/img/avatar.jpg') }}"
                                            class="testimonial-avatar" alt="{{ $testimonial->name }}">
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $testimonial->name }} <i class="bi bi-patch-check-fill text-primary"></i></h5>
                                        <span class="text-muted small">{{ $testimonial->position }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
@endif

<!-- Find A Doctor Section (ديناميكي من قاعدة البيانات) -->
<section id="find-a-doctor" class="find-a-doctor section dark-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>{{ __t('find_doctor_title') }}</h2>
        <p>{{ __t('featured_departments_subtitle') }}</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        {{-- نموذج البحث - يُرسل إلى صفحة الأطباء --}}
        <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-8 text-center">
                <div class="search-section">
                    <h3 class="search-title">{{ __t('find_doctor_search_title') }}</h3>
                    <p class="search-subtitle">{{ __t('find_doctor_search_subtitle') }}</p>
                    <form class="search-form" action="{{ route('doctors') }}" method="GET">
                        <div class="search-input-group">
                            <div class="input-wrapper">
                                <i class="bi bi-person"></i>
                                <input type="text" class="form-control" name="name" value="{{ request('name') }}"
                                    placeholder="{{ __t('doctor_name_placeholder') }}">
                            </div>
                            <div class="select-wrapper">
                                <i class="bi bi-heart-pulse"></i>
                                <select class="form-select" name="specialty">
                                    <option value="">{{ __t('all_specialties') }}</option>
                                    @php
                                        $uniqueSpecialties = isset($doctors) ? $doctors->pluck('specialty')->filter()->unique()->values() : collect();
                                    @endphp
                                    @foreach($uniqueSpecialties as $spec)
                                        <option value="{{ $spec }}" {{ request('specialty') == $spec ? 'selected' : '' }}>{{ $spec }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="search-btn">
                                <i class="bi bi-search"></i>
                                {{ __t('find_doctors') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- عرض الأطباء (حد أقصى 6 في الصفحة الرئيسية) --}}
        @if(isset($doctors) && $doctors->count())
            <div class="doctors-grid" data-aos="fade-up" data-aos-delay="300">
                @foreach($doctors->take(6) as $doctor)
                    <div class="doctor-profile" data-aos="zoom-in" data-aos-delay="{{ 100 + $loop->index * 100 }}">
                        <div class="profile-header">
                            <div class="doctor-avatar">
                                <img src="{{ $doctor->image_url }}" alt="{{ $doctor->name }}" class="img-fluid">
                                <div class="status-indicator {{ $doctor->status }}"></div>
                            </div>
                            <div class="doctor-details">
                                <h4>{{ $doctor->name }}</h4>
                                <span class="specialty-tag">{{ $doctor->specialty }}</span>
                                <div class="experience-info">
                                    <i class="bi bi-award"></i>
                                    <span>{{ $doctor->years_experience }} {{ __t('years experience') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="rating-section">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($doctor->rating))
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @elseif($i == ceil($doctor->rating) && $doctor->rating != floor($doctor->rating))
                                        <i class="bi bi-star-half text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-gray-300"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="rating-score">{{ number_format($doctor->rating, 1) }}</span>
                            <span class="review-count">({{ $doctor->reviews_count }} {{ __t('reviews') }})</span>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ route('doctors.show', $doctor->id) }}" class="btn-secondary">{{ __t('view_details') }}</a>
                            <a href="{{ route('appointment') }}?doctor_id={{ $doctor->id }}" class="btn-primary">{{ __t('book_now') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($doctors->count() > 6)
                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="700">
                    <a href="{{ route('doctors') }}" class="btn-view-all">
                        {{ __t('view_all_doctors') }}
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endif
        @else
            <div class="alert alert-info text-center">
                {{ __t('no_doctors_found') }}
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    /* نفس الـ styles السابقة مع إضافة تحسينات بسيطة */
    .testimonials-swiper { padding: 20px 40px; }
    .testimonial-card {
        background: var(--surface-color, #fff);
        border-radius: 24px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
        border: 1px solid color-mix(in srgb, var(--accent-color), transparent 90%);
    }
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 45px rgba(0,0,0,0.1);
        border-color: color-mix(in srgb, var(--accent-color), transparent 60%);
    }
    .testimonial-text {
        font-size: 1rem;
        line-height: 1.7;
        color: var(--default-color);
        font-style: normal;
    }
    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--accent-color);
        box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }
    .swiper-button-prev, .swiper-button-next {
        color: var(--accent-color) !important;
        background: var(--surface-color);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .swiper-button-prev:after, .swiper-button-next:after { font-size: 1.2rem; font-weight: bold; }
    .swiper-pagination-bullet-active { background: var(--accent-color) !important; }
    @media (max-width: 768px) {
        .testimonials-swiper { padding: 10px 20px; }
        .testimonial-card { padding: 1.5rem; }
        .swiper-button-prev, .swiper-button-next { display: none; }
    }

    /* أنماط الأطباء – تبقى كما هي أو يمكن تحسينها */
    .doctors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    .doctor-profile {
        background: var(--surface-color);
        border-radius: 1.5rem;
        padding: 1.5rem;
        transition: all 0.3s;
        border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
    }
    .doctor-profile:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px -12px rgba(0,0,0,0.1);
        border-color: var(--accent-color);
    }
    .profile-header { display: flex; gap: 1rem; margin-bottom: 1rem; }
    .doctor-avatar { position: relative; width: 80px; height: 80px; flex-shrink: 0; }
    .doctor-avatar img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
    .status-indicator {
        position: absolute; bottom: 0; right: 0;
        width: 18px; height: 18px; border-radius: 50%;
        border: 2px solid var(--surface-color);
    }
    .status-indicator.available { background: #10b981; }
    .status-indicator.busy { background: #f59e0b; }
    .status-indicator.offline { background: #6b7280; }
    .doctor-details h4 { margin: 0 0 6px; font-size: 1.2rem; font-weight: 600; }
    .specialty-tag {
        display: inline-block;
        background: color-mix(in srgb, var(--accent-color), transparent 85%);
        color: var(--accent-color);
        font-size: 0.7rem;
        padding: 0.2rem 0.6rem;
        border-radius: 30px;
        margin-bottom: 8px;
    }
    .experience-info { font-size: 0.75rem; color: var(--default-color); }
    .rating-section { display: flex; align-items: center; gap: 8px; margin-bottom: 1rem; flex-wrap: wrap; }
    .stars { color: #fbbf24; }
    .rating-score { font-weight: 600; }
    .review-count { font-size: 0.75rem; color: var(--default-color); }
    .action-buttons { display: flex; gap: 0.75rem; }
    .btn-secondary, .btn-primary {
        text-align: center; padding: 0.5rem 0; border-radius: 40px;
        font-size: 0.8rem; font-weight: 500; text-decoration: none;
        transition: 0.2s;
    }
    .btn-primary {
        background: var(--accent-color);
        color: var(--contrast-color);
    }
    .btn-primary:hover {
        background: color-mix(in srgb, var(--accent-color), black 10%);
    }
    .btn-secondary {
        background: transparent;
        color: var(--accent-color);
        border: 1px solid var(--accent-color);
    }
    .btn-secondary:hover {
        background: var(--accent-color);
        color: var(--contrast-color);
    }
    .btn-view-all {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        background: transparent;
        border: 2px solid var(--accent-color);
        color: var(--accent-color);
        font-weight: 500;
        text-decoration: none;
        transition: 0.2s;
    }
    .btn-view-all:hover {
        background: var(--accent-color);
        color: var(--contrast-color);
        gap: 0.75rem;
    }
    .search-input-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        background: var(--surface-color);
        border-radius: 60px;
        padding: 0.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .input-wrapper, .select-wrapper {
        position: relative;
        flex: 1;
    }
    .input-wrapper i, .select-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--default-color);
        z-index: 2;
    }
    .input-wrapper .form-control, .select-wrapper .form-select {
        padding-left: 2.5rem;
        border-radius: 40px;
        border: 1px solid color-mix(in srgb, var(--default-color), transparent 80%);
        background: var(--surface-color);
    }
    .search-btn {
        background: var(--accent-color);
        border: none;
        border-radius: 40px;
        padding: 0 1.5rem;
        color: var(--contrast-color);
        font-weight: 500;
        transition: 0.2s;
    }
    .search-btn:hover { background: color-mix(in srgb, var(--accent-color), black 10%); }
    @media (max-width: 768px) {
        .search-input-group { flex-direction: column; border-radius: 20px; }
        .search-btn { border-radius: 40px; padding: 0.6rem; width: 100%; }
        .doctors-grid { grid-template-columns: 1fr; }
    }
    .dark .doctor-profile { background: #1e293b; border-color: #334155; color: #e2e8f0; }
    .dark .specialty-tag { background: color-mix(in srgb, #33ff99, transparent 85%); color: #33ff99; }
    .dark .btn-secondary { border-color: #33ff99; color: #33ff99; }
    .dark .btn-secondary:hover { background: #33ff99; color: #012119; }
    .dark .btn-view-all { border-color: #33ff99; color: #33ff99; }
    .dark .btn-view-all:hover { background: #33ff99; color: #012119; }
</style>
@endpush

@push('scripts')
    <script>
        new Swiper('.testimonials-swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: { delay: 5000 },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            breakpoints: { 768: { slidesPerView: 2 }, 1200: { slidesPerView: 3 } }
        });
    </script>
@endpush
