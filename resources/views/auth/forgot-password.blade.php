@extends('layouts.auth')

@section('title', 'Reset Password - Vayu Clinic')

@section('content')
    <h3 class="text-center mb-3">{{ __('Forgot Password?') }}</h3>
    <p class="text-center text-muted mb-4">{{ __('Enter your email and we will send you a reset link.') }}</p>

    @if(session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-envelope"></i></span>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary py-2">{{ __('Send Reset Link') }}</button>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none small">{{ __('Back to Login') }}</a>
        </div>
    </form>
@endsection
