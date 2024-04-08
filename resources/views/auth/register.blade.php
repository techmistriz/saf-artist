@extends('layouts.app')

@section('content')


<section class="saf-registerpage">
	<div class="container">
	    <div class="row">
	        <div class="col-md-8">
	            <h1 class="main-title">Registration Form</h1>
	            <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt consectetur adipiscing.</p>
	            <form class="registerfrm" action="{{ route('register') }}" method="POST" autocomplete="off" onsubmit="return submitRegistrationForm(this)">
	            	@csrf
	                <div class="form-group">
	                    <label for="name">full name</label>
	                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" >

	                    @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

	                </div>

	                <div class="form-group">
	                    <label for="country">country</label>
	                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country') }}" required>
	                    @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

	                </div>
	                <div class="form-group">
	                    <label for="city">city</label>
	                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
	                    @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

	                </div>
	                <div class="form-group">
	                    <label for="contact">contact number</label>
	                    <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact') }}" required>
	                    @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

	                </div>
	                <div class="form-group">
	                    <label for="email">email id</label>
	                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
	                    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

	                </div>

	                <div class="form-group">
	                	<label for="email">Interests</label>
	                    <div class="chks checkbox-inline">
	                    	
	                    	@if($disciplines->count())
                                @foreach($disciplines as $discipline)
                                   	<div class="chk-item">
				                        <input type="checkbox" id="interest_{{$discipline->id}}" name="interest[]" class="interest" value="{{ $discipline->id }}" {{ old('interest') && in_array($discipline->id, old('interest')) ? 'checked' : '' }}>
				                        <label for="interest_{{$discipline->id}}" >{{$discipline->name}}</label><br>
				                    </div>
                                @endforeach
                            @endif

                            <div class="chk-item">
		                        <input type="checkbox" onchange="allCheckClick(this)">
		                        <label for="all" >All</label><br>
		                    </div>
	                    
	                        <!-- <input type="checkbox" id="music" name="interest[]" class="interest" value="2">
	                        <label for="music" >Music</label><br>

	                        <input type="checkbox" id="dance" name="interest[]" class="interest" value="3">
	                        <label for="dance" >Dance</label><br>

	                        <input type="checkbox" id="theatre" name="interest[]" class="interest" value="4">
	                        <label for="theatre" >Theatre</label><br>

	                        <input type="checkbox" id="photography" name="interest[]" class="interest" value="5">
	                        <label for="photography" >Photography</label><br> -->
	                    
	                    </div>

	                    @error('interest')
	                    	<input type="hidden" class="@error('interest') is-invalid @enderror">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

	                    <!-- <div class="chks">

		                    <div class="chk-item">
		                        <input type="checkbox" id="visualarts" name="interest[]" class="interest" value="6">
		                        <label for="visualarts" >Visual Arts</label><br>
		                    </div>

		                    <div class="chk-item">
		                        <input type="checkbox" id="culinaryarts" name="interest[]" class="interest" value="7">
		                        <label for="culinaryarts" >Culinary Arts</label><br>
		                    </div>
		                    
		                </div> -->

	                </div>

	                <div class="form-group acpt">
	                    <input type="checkbox" id="terms" name="terms" value="1" required="">
	                    <label for="terms" class="cpt"> I have read and understood the agreement.<br/> I accept and agree to all its <a href="{{url('terms-conditions')}}" class="tc-btn">Terms and Conditions</a></label><br>

	                    @error('terms')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

	                </div>
	           
	                <div class="form-group">
	                    <input type="submit" value="Submit &LongRightArrow;">
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
</section>

@endsection
@push('scripts')
<script type="text/javascript">
    
    function allCheckClick(_this){
    	
    	if($(_this).is(':checked')){
    		$(".interest").prop('checked', true);
    	} else {

    		$(".interest").prop('checked', false);
    	}
    }

    function submitRegistrationForm(_this){
    	
    	if($("#terms").is(':checked')){
    		$(_this).submit();
    	}

    	alert("Please accpet terms & conditions");
    	return false;
    }

</script>
@endpush