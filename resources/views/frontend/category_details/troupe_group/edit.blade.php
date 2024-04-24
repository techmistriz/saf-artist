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

            	@includeonce('flash::message')
            	
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">

                    <!--Begin::Header-->
                    <div class="card-header">

                    	

		                <div class="card-title">
		                    <h3 class="card-label">Project Category Details</h3>
		                </div>
		            </div>
                    <!--end::Header-->

                    <!--Begin::Body-->
                    <div class="card-body1">

                    	<!-- include('frontend/category_details/category_form') -->
                    </div>
                    <!--end::Body-->

                	<form action="{{ route('update.category.details') }}" method="POST" enctype="multipart/form-data">
			            <input type="hidden" name="_method" value="PUT">
			            <input type="hidden" name="id" value="{{$row->id}}">
			            {{ csrf_field() }}

	                    <!--Begin::Body-->
	                    <div class="card-body">
			                <div class="row">
			                    
			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Synopsis/ Description of the performance</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <textarea name="synopsis_description_of_the_performance" value="{{ old('synopsis_description_of_the_performance', $row->synopsis_description_of_the_performance ?? '') }}" class="form-control form-control-lg form-control-solid" maxlength="15"  placeholder="Enter Synopsis/ Description of the performance"/></textarea>
											<p class="text-muted small">( This information will be filled by Project Lead )</p>
			                                @error('synopsis_description_of_the_performance')
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