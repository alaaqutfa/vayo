@extends('layouts.auth')

@section('title', 'Register - Vayu Clinic')

@section('content')
    <h3 class="text-center mb-3">{{ __t('Create Account') }}</h3>
    <p class="text-center text-muted mb-4">{{ __t('Join Vayu Clinic today') }}</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __t('Full Name') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-person"></i></span>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __t('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-envelope"></i></span>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __t('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-lock"></i></span>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">{{ __t('Confirm Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-shield-lock"></i></span>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    required>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary py-2">{{ __t('Register') }}</button>
        </div>

        <hr class="my-4">

        <div class="text-center">
            <span class="text-muted">{{ __t('Already have an account?') }}</span>
            <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">{{ __t('Login') }}</a>
        </div>
    </form>
@endsection
