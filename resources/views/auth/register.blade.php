@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="card-body">
            <div class="text-center">
                <h4 class="javascript:;">{{ config('app.name', 'Laravel') }} - Sign up</h4>
                <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </div>
            <div class="d-grid">
                <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> 
                    <span class="d-flex justify-content-center align-items-center">
                        <img class="me-2" src="{{ asset('assets/images/icons/search.svg') }}" width="16" alt="Image Description">
                        <span>Sign up with Google</span>
                    </span>
                </a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign up with Facebook</a>
            </div>
            <div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
                <hr/>
            </div>
            <div class="form-body">
                <form class="row g-3" method="POST" action="{{ route('register') }}">
                @csrf
                    <div class="col-col-12">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" required autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="password" class="form-label">New Password</label>
                        <div class="input-group" id="show_hide_password">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off required>

                            <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="password" class="form-label">Confirm Password</label>
                        <div class="input-group" id="show_hide_password">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off>

                            <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success"><i class='bx bx-user'></i>Sign up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
