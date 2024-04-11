@extends('layouts.frontend')
@section('content')
<style type="text/css">
	.image-input {
	    margin-right: 10px;
	}
	.image-input .image-input-wrapper {
	    width: 85px;
	    height: 85px;
	}
	.bootstrap-select>.dropdown-toggle.btn-light, .bootstrap-select>.dropdown-toggle.btn-secondary {
	    height: calc(1.5em + 1.65rem + 2px);
	    padding: 0.825rem 1.42rem;
	    font-size: 1.08rem;
	    line-height: 1.5;
	    border-radius: 0.42rem;
        background-color: #f3f6f9 !important;
    	border-color: #f3f6f9 !important;
	}
	.form-control[readonly] {
	  	background-color: #f3f6f9;
	  	border-color: #f3f6f9;
	  	color: #3f4254;
	}
</style>
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container ">
        <!--begin::Education-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            @include('frontend/includes/aside')
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">

                	<form action="{{ route('update.travel_boarding.details') }}" method="POST" enctype="multipart/form-data">
			            <input type="hidden" name="_method" value="PUT">
			            <input type="hidden" name="id" value="{{$row->id}}">
			            {{ csrf_field() }}
	                    <!--Begin::Header-->
	                    <div class="card-header">
			                @include('flash::message')
			                
			                <div class="card-title">
			                    <h3 class="card-label">Ticket Booking Details</h3>
			                </div>

			            </div>
	                    <!--end::Header-->
	                    <!--Begin::Body-->
	                    <div class="card-body">
			                <!-- Ticket Booking -->
			                @include('frontend.ticket_booking_details.forms.ticket_booking_form')

			                <div class="row">
			                	<div class="col-12">
			                        <div class="form-group row validated">
			                            <div class="col-lg-3 col-md-3 col-sm-12">
			                                &nbsp;
			                            </div>
			                            <div class="col-form-label col-lg-9 col-md-9 col-sm-12">
			                            	<div class="checkbox-inline">
										        <label class="checkbox">
										            <input type="checkbox" name="terms" value="1" required="" />
										            <span></span>
										            {{ env('FORM_CONSENT', 'I Accept Terms & Conditions') }}
										        </label>
										    </div>

				                            @error('terms')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
				                        </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
	                    <!--end::Body-->

	                    <div class="card-footer">
			                <div class="row">
			                	@if(\Auth::user()->is_freeze == 0)
			                    <div class="col-lg-4"></div>
			                    <div class="col-lg-4 text-center">
			                        <button type="submit" class="theme-btn mt-0 mb-0">Update</button>
			                    </div>
			                    @else
			                    	<div class="col-lg-12">
			                    		<p class="text-center text-danger small italic">Your account has been freeze by admin hence you are not able to update any of details.</p>
			                    	</div>
			                    @endif
			                </div>
			            </div>
		            </form>

                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Education-->
    </div>
    <!--end::Container-->
</div>
@endsection

@push('scripts')
<script type="text/javascript">

	function roomNightCalc(){

		var check_in_date  = document.getElementById('check_in_date').value;
		var check_out_date  = document.getElementById('check_out_date').value;
		
		if(!check_in_date && check_out_date){

			$("#total_room_nights").val('');
			return;
		}

		if(check_in_date && check_out_date){

			const date1 = moment(check_in_date, 'DD/MM/YYY').toDate();
			const date2 = moment(check_out_date, 'DD/MM/YYY').toDate();

			var diff = Math.abs(date2.getTime() - date1.getTime());
			var dayDiff = Math.ceil(diff / (1000 * 3600 * 24));  

			if (date1 > date2){ 

				$("#total_room_nights").val('');
				$("#check_out_date").parent().after('<div class="invalid-feedback">Check-out date must be after check-in date!</div>');

			} else {
				
				$("#total_room_nights").val(dayDiff);
				$("#check_out_date").parent().parent().find('.invalid-feedback').remove();
				return;
			}

		} else {
			
			$("#total_room_nights").val('');
		}
	}

	function checkOtherCity(_this, selector = ''){

		if($(_this).val() == '16'){
			$("." + selector).show();
		} else {

			$("." + selector).hide();
		}
	}


</script>
@endpush