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
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">

                	<form action="{{ route('update.category.details') }}" method="POST" enctype="multipart/form-data">
			            <input type="hidden" name="_method" value="PUT">
			            <input type="hidden" name="id" value="{{$row->id}}">
			            {{ csrf_field() }}
	                    <!--Begin::Header-->
	                    <div class="card-header">

	                    	@include('flash::message')

			                <div class="card-title">
			                    <h3 class="card-label">Project Category Details</h3>
			                </div>
			            </div>
	                    <!--end::Header-->
	                    <!--Begin::Body-->
	                    <div class="card-body">
			                <div class="row">
			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Name </label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <select class="form-control form-control-lg form-control-solid selectpicker" name="project_id" tabindex="null" >
                                                <option value="">Select</option>
                                               	@if($projects->count())
                                                    @foreach($projects as $value)

                                                       <option {{ old('project_id', $value->id ?? 0) ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

                                                    @endforeach
                                                @endif
                                            </select>
			                                @error('project_id')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            </div>
			                        </div>
			                    </div>
			                     
			                    
			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Number of people in your group </label>

			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="file" name="no_of_people_in_group"  class="form-control form-control-lg form-control-solid @error('no_of_people_in_group') is-invalid @enderror " />
			                                Uploaded File: 
			                                @if($row->no_of_people_in_group)
			                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->no_of_people_in_group) }}">{{$row->no_of_people_in_group}}</a>
			                            	@else
			                            	N/A
			                            	@endif
			                               
			                                @error('no_of_people_in_group')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>

			                        </div>
			                    </div>
			                    
			                    <div class="col-12">
			                        
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Form / Genre </label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">

			                            	<div class="input-group date">
												<input type="text" name="form_genre" value="{{ old('form_genre') ? old('form_genre') : ( isset($row->form_genre) ? $row->form_genre : '') }}" class="form-control form-control-lg form-control-solid" {{isset($row->form_genre) ? '':''}} placeholder="Enter Form / Genre"/>

												@error('form_genre')
				                                    <div class="invalid-feedback">{{ $message }}</div>
				                                @enderror

												
											</div>
			                            </div>
			                        </div>
			                    </div>
			                    
			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Organisation/ Foundation/ Trust you are associated with(if any) </label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="organisation" value="{{ old('organisation') ? old('organisation') :( isset($row->organisation) ? $row->organisation : '') }}" class="form-control form-control-lg form-control-solid" maxlength="15"  placeholder="Enter Organisation/ Foundation/ Trust you are associated with(if any)"/>
			                                @error('organisation')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Light designer needed</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <select class="form-control form-control-lg form-control-solid selectpicker" name="light_designer_needed" tabindex="null" >
			                                    <option value="">Select</option>
			                                    <option value="Yes" {{(old('light_designer_needed') == 'Yes' || (!isset($row->light_designer_needed) || empty($row->light_designer_needed)) ) ? 'selected' : ( isset($row->light_designer_needed) && $row->light_designer_needed == 'Yes' ? 'selected' : '')}}>Yes</option>
			                                    <option value="No" {{(old('light_designer_needed') == 'No' || (!isset($row->light_designer_needed) || empty($row->light_designer_needed)) ) ? 'selected' : ( isset($row->light_designer_needed) && $row->light_designer_needed == 'No' ? 'selected' : '')}}>No</option>
			                                </select>

			                                @error('category')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Sound designer needed</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <select class="form-control form-control-lg form-control-solid selectpicker" name="sound_designer_needed" tabindex="null" >
			                                    <option value="">Select</option>
			                                    <option value="Yes" {{(old('sound_designer_needed') == 'Yes' || (!isset($row->sound_designer_needed) || empty($row->sound_designer_needed)) ) ? 'selected' : ( isset($row->sound_designer_needed) && $row->sound_designer_needed == 'Yes' ? 'selected' : '')}}>Yes</option>
			                                    <option value="No" {{(old('sound_designer_needed') == 'No' || (!isset($row->sound_designer_needed) || empty($row->sound_designer_needed)) ) ? 'selected' : ( isset($row->sound_designer_needed) && $row->sound_designer_needed == 'No' ? 'selected' : '')}}>No</option>
			                                </select>

			                                @error('category')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">IPRS licence required?</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <select class="form-control form-control-lg form-control-solid selectpicker" name="iprs_license_required" tabindex="null" >
			                                    <option value="">Select</option>
			                                    <option value="Yes" {{(old('iprs_license_required') == 'Yes' || (!isset($row->iprs_license_required) || empty($row->iprs_license_required)) ) ? 'selected' : ( isset($row->iprs_license_required) && $row->iprs_license_required == 'Yes' ? 'selected' : '')}}>Yes</option>
			                                    <option value="No" {{(old('iprs_license_required') == 'No' || (!isset($row->iprs_license_required) || empty($row->iprs_license_required)) ) ? 'selected' : ( isset($row->iprs_license_required) && $row->iprs_license_required == 'No' ? 'selected' : '')}}>No</option>
			                                </select>

			                                @error('category')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>
			                    
			                
			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Space and visual design requirements </label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <textarea class="form-control form-control-lg form-control-solid no-summernote-editor" name="space_visual_design_requirements" id="space_visual_design_requirements" placeholder="Enter Permanent Address" >{{ old('space_visual_design_requirements') ? old('space_visual_design_requirements') : ( isset($row->space_visual_design_requirements) ? $row->space_visual_design_requirements : '') }}</textarea>
			                                @error('space_visual_design_requirements')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>
			                </div>

			                <div class="row">
			                	<div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Biodata/ Profile </label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="biodata" value="{{ old('biodata') ? old('biodata') :( isset($row->biodata) ? $row->biodata : '') }}" class="form-control form-control-lg form-control-solid" maxlength="15"  placeholder="Enter Biodata"/>
			                                @error('biodata')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Tech Rider </label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="file" name="tech_rider"  class="form-control form-control-lg form-control-solid @error('tech_rider') is-invalid @enderror " />
			                                Uploaded File: 
			                                @if($row->tech_rider)
			                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->tech_rider) }}">{{$row->tech_rider}}</a>
			                            	@else
			                            	N/A
			                            	@endif
			                               
			                                @error('tech_rider')
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
			                    <div class="col-lg-4"></div>
			                    <div class="col-lg-4 text-center">
			                        <button type="submit" class="btn btn-primary mr-2">Update</button>
			                    </div>
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