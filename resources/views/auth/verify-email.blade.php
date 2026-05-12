@extends('layouts.auth')

@section('title', 'Verify Email - Vayu Clinic')

@section('content')
    <h3 class="text-center mb-3">{{ __t('Verify Your Email') }}</h3>
    <div class="alert alert-info text-center">
        {{ __t('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success text-center">
            {{ __t('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="d-grid gap-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary py-2 w-100">{{ __t('Resend Verification Email') }}</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary py-2 w-100">{{ __t('Log Out') }}</button>
        </form>
    </div>
@endsection
