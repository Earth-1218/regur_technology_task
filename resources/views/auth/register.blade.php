@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="registerForm" method="POST" action="{{ route('auth.register') }}">
                        @csrf

                        <!-- Name Field -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your name">
                                <span class="invalid-feedback" id="name-error" role="alert"></span>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email address">
                                <span class="invalid-feedback" id="email-error" role="alert"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter your password">
                                <span class="invalid-feedback" id="password-error" role="alert"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" id="registerSubmitButton" class="bg-primary btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
    document.getElementById('registerSubmitButton').addEventListener('click', function() {
        var form = document.getElementById('registerForm');
        var isValid = true;

        // Custom validation for Name
        var name = document.getElementById('name');
        var nameError = document.getElementById('name-error');
        if (name.value.trim() === '') {
            isValid = false;
            name.classList.add('is-invalid');
            nameError.textContent = 'Name is required.';
        } else {
            name.classList.remove('is-invalid');
            nameError.textContent = '';
        }

        // Custom validation for Email
        var email = document.getElementById('email');
        var emailError = document.getElementById('email-error');
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(email.value)) {
            isValid = false;
            email.classList.add('is-invalid');
            emailError.textContent = 'Please enter a valid email address.';
        } else {
            email.classList.remove('is-invalid');
            emailError.textContent = '';
        }

        // Custom validation for Password
        var password = document.getElementById('password');
        var passwordError = document.getElementById('password-error');
        if (password.value.length < 6) {
            isValid = false;
            password.classList.add('is-invalid');
            passwordError.textContent = 'Password must be at least 6 characters.';
        } else {
            password.classList.remove('is-invalid');
            passwordError.textContent = '';
        }

        // Custom validation for Password Confirmation
        var passwordConfirm = document.getElementById('password-confirm');
        if (password.value !== passwordConfirm.value) {
            isValid = false;
            passwordConfirm.classList.add('is-invalid');
            passwordError.textContent = 'Passwords do not match.';
        } else {
            passwordConfirm.classList.remove('is-invalid');
        }

        // Submit form if everything is valid
        if (isValid) {
            form.submit();
        }
    });
    </script>
@endpush
