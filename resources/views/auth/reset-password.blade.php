@extends('layouts.auth')

@section('title', 'Reset Password - Vayu Clinic')

@section('content')
    <h3 class="text-center mb-3">{{ __t('Set New Password') }}</h3>
    <p class="text-center text-muted mb-4">{{ __t('Please choose a strong password.') }}</p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label for="email" class="form-label">{{ __t('Email Address') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-envelope"></i></span>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $request->email) }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __t('New Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-key"></i></span>
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
            <button type="submit" class="btn btn-primary py-2">{{ __t('Reset Password') }}</button>
        </div>
    </form>
@endsection
