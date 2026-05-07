@extends('layouts.app')
@section('title', __t('faqs'))
@section('content')
    <div class="page-title">...</div>
    <section id="faq" class="faq section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="faq-wrapper">
                        @foreach($faqs as $faq)
                            <div class="faq-item">
                                <div class="faq-header">
                                    <span class="faq-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <h4>{{ $faq->question }}</h4>
                                    <div class="faq-toggle"><i class="bi bi-plus"></i><i class="bi bi-dash"></i></div>
                                </div>
                                <div class="faq-content">
                                    <div class="content-inner">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
