@extends('admin.layouts.login')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card shadow shadow-lg my-5">
                <div class="card-header bg-dark"><h1 class="col-form-label h4 text-white mb-1">The SchoolFAQs Shop | Administrator Panel</h1></div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block"><img src="{{ asset('admin_logo.png') }}" alt="Admin Login"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf

                                    <div class="form-group">
                                        <div class="form-group">
                                            <input id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus><i class="fa fa-sign-in text-white"></i>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <input placeholder="Password" id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"><i class="fa fa-key text-white"></i>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-check custom-control custom-checkbox small">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-dark btn-user btn-block">
                                                {{ __('Login') }}
                                                <i class="fa fa-sign-in text-white"></i>
                                            </button>

                                            @if (Route::has('password.request'))
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
