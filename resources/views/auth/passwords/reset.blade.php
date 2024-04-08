@extends('layouts.app')
@section('content')
<section class="saf-loginpage">
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-6">

	        	<div class="card card-custom gutter-bs theme-bg">
		        	<div class="card-body">
		        		<div class="card-title">
							<h3 class="card-label text-center theme-text-color">Reset Password</h3>
						</div>

						<form class="loginfrm" method="POST" action="{{ route('password.update') }}">
            		
				            @if (session('status'))
			                    <div class="alert alert-success" role="alert">
			                        {{ session('status') }}
			                    </div>
			                @endif
			                
		                    @csrf
		                    <input type="hidden" name="token" value="{{ $token }}">
		                    
			                <div class="form-group">
			                    <label for="email" class="theme-text-color">E-Mail Address</label>
			                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

			                    @error('email')
			                        <span class="invalid-feedback" role="alert">
			                            <strong>{{ $message }}</strong>
			                        </span>
			                    @enderror
			                </div>

			                <div class="form-group">
			                    <label for="password" class="theme-text-color">password</label>
			                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password" required autocomplete="new-password">

			                    @error('password')
			                        <span class="invalid-feedback" role="alert">
			                            <strong>{{ $message }}</strong>
			                        </span>
			                    @enderror

			                </div>

			                <div class="form-group">
			                    <label for="confirm-password" class="theme-text-color">Confirm password</label>
			                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="confirm-password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">

			                    @error('password_confirmation')
			                        <span class="invalid-feedback" role="alert">
			                            <strong>{{ $message }}</strong>
			                        </span>
			                    @enderror
			                </div>
			           
			                <div class="form-group cntr">
			                    <input type="submit" class="theme-btn" value="Reset Password &LongRightArrow;">
			                </div>
			            </form>
		        	</div>
	        	</div>
	        </div>
	    </div>
	</div>
</section>

@endsection
