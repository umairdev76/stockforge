@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Email Verification</h4>
                </div>

                <div class="card-body">

                    <!-- Description -->
                    <p class="mb-4 text-muted">
                        Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you.
                        If you didn't receive the email, we can send another.
                    </p>

                    <!-- Status -->
                    @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                    @endif

                    <div class="d-flex justify-content-between">

                        <!-- Resend Verification Email -->
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Resend Verification Email
                            </button>
                        </form>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link text-decoration-none">
                                Log Out
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection