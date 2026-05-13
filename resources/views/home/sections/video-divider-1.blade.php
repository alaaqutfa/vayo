{{-- Video Divider 1 - vayu-1.mp4 (full width, cinematic) --}}
<section class="video-divider video-divider-1" data-aos="fade-up">
    <video class="background-video" autoplay muted loop playsinline preload="none"
        poster="{{ asset('assets/videos/vayu-1.jpg') ?? '' }}">
        <source src="{{ asset('assets/videos/vayu-1.mp4') }}" type="video/mp4">
    </video>
    <div class="video-overlay"></div>
</section>

@push('styles')
    <style>
        .video-divider {
            position: relative;
            width: 100%;
            height: 70vh;
            overflow: hidden;
            background: #000;
            /* fallback */
        }

        .background-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            z-index: 1;
        }

        /* Overlay شفاف اختياري (لتقليل الوهج أو إضافة تأثير) */
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            z-index: 2;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .video-divider {
                height: 50vh;
            }
        }
    </style>
@endpush
