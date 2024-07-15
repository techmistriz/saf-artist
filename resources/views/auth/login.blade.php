@extends('layouts.app')
@section('content')
<section class="saf-loginpage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="logo-sa">
                    <a href="{{URL::to('/')}}"><img src="{{url('/image/Logo-SVG.svg')}}" alt="Image"/></a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                @include('flash::message')

                <div class="card card-custom gutter-bs theme-bg">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="card-label text-center theme-text-color">LOGIN</h3>
                        </div>
                        <form class="loginfrm" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <div class="form-group position-relative">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="new-password">
                                <span class="fa fa-fw fa-eye field-icon show-login-password" style="color: #FA9917;"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <a href="{{route('password.request')}}" class="frg-btn">Forgot password?</a>
                            </div>
                       
                            <div class="form-group cntr">
                                <input type="submit" class="theme-btn" value="login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-5 justify-content-center">
            <div class="col-md-6">
                <div class="rgtr-link">
                    <p>don't have account? <a href="{{ route('home') }}">Register now</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- Add JavaScript to toggle password visibility -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('.show-login-password');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection
