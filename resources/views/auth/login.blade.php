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
			            <!-- <h1 class="main-title">Login</h1> -->
		            	<form class="loginfrm" method="POST" action="{{ route('login') }}">
		                    @csrf
			                <div class="form-group">
			                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Username" value="{{ old('email') }}" required autocomplete="email">
			                    @error('email')
			                        <span class="invalid-feedback" role="alert">
			                            <strong>{{ $message }}</strong>
			                        </span>
			                    @enderror
			                </div>
			              
			                <div class="form-group">
			                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="new-password">

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
	            <!-- <div class="social-link">
	                <p>or sign up using</p>
                    <div class="social-icon">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div> 
	            </div> -->

	            <div class="rgtr-link">
	                <p>don't have account? <a href="{{ route('home') }}">Register now</a></p>
	            </div>
	        </div>
	    </div>
	</div>
</section>

@endsection
