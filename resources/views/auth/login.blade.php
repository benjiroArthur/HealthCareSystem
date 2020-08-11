@extends('layouts.app')

@section('content')
    <div class="container-fluid m-0 p-0" style="background-image: url('assets/images/gem.jpg'); background-size: cover; min-height: 550px">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="login-box">
                    <div class="login-logo">
                        <img src="{{asset('assets/images/user.png')}}" width="100" height="auto">
                    </div>
                    <!-- /.login-logo -->
                    <div>
                        <div class="card-body login-card-body by-bg-transparent">
                            <h6 class="text-center text-dark text-bold h6">Sign in to start your session</h6>

                            <form action="{{route('login')}}" method="post" class="main-login-form">
                                @csrf

                                <div class="input-group mb-3">
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text bg-light">
                                            <span class="fas fa-envelope text-health"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <div class="input-group-append">
                                        <div class="input-group-text bg-light">
                                            <span class="fas fa-lock text-health"></span>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember" name="remember">
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary bg-health btn-block">Sign In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>



                            <p class="mb-1">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </p>
                            <p class="mb-0">
                                <a href="{{route('register')}}" class="text-center">Register a new membership</a>
                            </p>
                        </div>
                        <!-- /.login-card-body -->
                    </div>
                </div>
                <!-- /.login-box -->
            </div>
        </div>
    </div>
@endsection

