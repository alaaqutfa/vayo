@extends('layouts.app')

@section('title', 'Vayo Clinic - Trusted Medical Care')
@section('body-class', 'index-page')

@section('content')
    @include('home.sections.hero')
    @include('home.sections.home-about')

    {{-- فيديو فاصل رقم 1 --}}
    @include('home.sections.video-divider-1')

    @include('home.sections.featured-departments')
    @include('home.sections.featured-services')

    @include('home.sections.gallery')
    @include('home.sections.find-a-doctor', ['doctors' => $doctors])
    @include('home.sections.call-to-action')
@endsection
