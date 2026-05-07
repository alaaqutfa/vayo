@extends('layouts.app')
@section('title', __t('departments'))
@section('content')

    @foreach($categories as $category)
        <h2>{{ $category->name }}</h2>
        @foreach($category->services as $service)
            <a href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a>
        @endforeach
    @endforeach

@endsection
