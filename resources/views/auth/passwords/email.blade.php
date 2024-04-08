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
			<div class="card card-custom gutter-bs theme-bg">
				<div class="card-body">
				<div class="card-title">
					<h3 class="card-label text-center theme-text-color">Forgot Password</h3>
					<p class="text-muted font-weight-bold font-size-h4 frgtp">Enter your email to reset your password</span>
				</div>


            	<form class="loginfrm" method="POST" action="{{ route('password.email') }}">
            		
		            @if (session('status'))
	                    <div class="alert alert-success" role="alert">
	                        {{ session('status') }}
	                    </div>
	                @endif
                    @csrf
	                <div class="form-group">
	
	                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

	                    @error('email')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
	                </div>
	           
	                <div class="form-group cntr">
	                    <input type="submit" class="theme-btn" value="Submit">
	                </div>
	            </form>
			</div>
			</div>
	    </div>
	</div>
</section>

@endsection
