@extends('layouts.auth')

@section('title', 'Confirm Password - Vayu Clinic')

@section('content')
    <h3 class="text-center mb-3">{{ __('Confirm Password') }}</h3>
    <p class="text-center text-muted mb-4">{{ __('Please confirm your password before continuing.') }}</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-lock"></i></span>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary py-2">{{ __('Confirm') }}</button>
        </div>
    </form>
@endsection
