@extends('layouts.auth')

@section('title', 'Login - Vayo Clinic')

@section('content')
    <h3 class="text-center mb-3">{{ __('Welcome Back') }}</h3>
    <p class="text-center text-muted mb-4">{{ __('Please login to your account') }}</p>

    @if(session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-envelope"></i></span>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-lock"></i></span>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary py-2">{{ __('Log In') }}</button>
        </div>

        {{-- <div class="text-center mt-3">
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none small">{{ __('Forgot Your Password?') }}</a>
            @endif
        </div>

        <hr class="my-4">

        <div class="text-center">
            <span class="text-muted">{{ __("Don't have an account?") }}</span>
            <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">{{ __('Register Now') }}</a>
        </div> --}}
    </form>
@endsection

@push('styles')
<style>
    .auth-card {
        background: var(--surface-color, #fff);
        border-radius: 32px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        backdrop-filter: blur(2px);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .auth-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 50px rgba(0,0,0,0.12);
    }
    .form-control, .input-group-text {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 0.6rem 1rem;
    }
    .form-control:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.2rem rgba(1,33,25,0.25);
    }
    .btn-primary {
        background: var(--color-primary);
        border: none;
        border-radius: 40px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: 0.2s;
    }
    .btn-primary:hover {
        background: #01332a;
        transform: scale(1.01);
    }
    .dark .auth-card {
        background: #1e293b;
        border-color: #334155;
        color: #e2e8f0;
    }
    .dark .form-control, .dark .input-group-text {
        background: #0f172a;
        border-color: #334155;
        color: #f1f5f9;
    }
</style>
@endpush
