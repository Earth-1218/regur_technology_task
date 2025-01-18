@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form id="loginForm" method="POST" action="{{ route('auth.login') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email address"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp">
                                    <span class="invalid-feedback" id="email-client-side-error" role="alert"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" placeholder="Enter password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <span class="invalid-feedback" id="password-client-side-error" role="alert"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="button" id="loginSubmitButton" class="bg-primary btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
        var form = document.getElementById('loginForm');
        document.getElementById('loginSubmitButton').addEventListener('click', function() {
            var isValid = true;

            // Custom validation for email
            var email = document.getElementById('email');
            var emailError = document.getElementById('email-client-side-error');
            if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)) {
                isValid = false;
                email.classList.add('is-invalid');
                emailError.classList.remove('d-none');
                emailError.innerHTML = 'Please enter a valid email address.';
            } else {
                email.classList.remove('is-invalid');
                emailError.classList.add('d-none');
            }

            // Custom validation for password
            var password = document.getElementById('password');
            var passwordError = document.getElementById('password-client-side-error');
            if (password.value.length < 6) {
                isValid = false;
                password.classList.add('is-invalid');
                passwordError.classList.remove('d-none');
                passwordError.innerHTML = 'Password must be at least 6 characters.';
            } else {
                password.classList.remove('is-invalid');
                passwordError.classList.add('d-none');
            }

            // If form is valid, submit the form
            if (isValid) {
                form.submit();
            }
        });
        </script>
    @endpush
@endsection
