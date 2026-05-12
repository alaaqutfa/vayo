@extends('layouts.auth')

@section('title', 'Verify Email - Vayu Clinic')

@section('content')
    <h3 class="text-center mb-3">{{ __('Verify Your Email') }}</h3>
    <div class="alert alert-info text-center">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success text-center">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="d-grid gap-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary py-2 w-100">{{ __('Resend Verification Email') }}</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary py-2 w-100">{{ __('Log Out') }}</button>
        </form>
    </div>
@endsection
