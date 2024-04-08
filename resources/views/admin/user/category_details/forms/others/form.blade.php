@include('flash::message')
<style type="text/css">
	.radio {
		display: -webkit-box;
	}

	.image-input {
	    margin-right: 10px;
	}

</style>
<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}} Category Details</h3>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Name </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="project_name" value="{{ old('project_name') ? old('project_name') :( isset($row->project_name) ? $row->project_name : '') }}" class="form-control" placeholder="Enter Project Name"/>
                                @error('project_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                     
                    
                    <div class="col-6">
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
                    
                    <div class="col-6">
                        
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Form / Genre </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                            	<div class="input-group date">
									<input type="text" name="form_genre" value="{{ old('form_genre') ? old('form_genre') : ( isset($row->form_genre) ? $row->form_genre : '') }}" class="form-control" placeholder="Enter Form / Genre"/>

									@error('form_genre')
	                                    <div class="invalid-feedback">{{ $message }}</div>
	                                @enderror

									
								</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Organisation/ Foundation/ Trust you are associated with(if any) </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="organisation" value="{{ old('organisation') ? old('organisation') :( isset($row->organisation) ? $row->organisation : '') }}" class="form-control" maxlength="15"  placeholder="Enter Organisation/ Foundation/ Trust you are associated with(if any)"/>
                                @error('organisation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Space and visual design requirements </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control no-summernote-editor" name="space_visual_design_requirements" id="space_visual_design_requirements" placeholder="Enter Permanent Address" require>{{ old('space_visual_design_requirements') ? old('space_visual_design_requirements') : ( isset($row->space_visual_design_requirements) ? $row->space_visual_design_requirements : '') }}</textarea>
                                @error('space_visual_design_requirements')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                	<div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Biodata/ Profile </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="file" name="biodata"  class="form-control form-control-lg form-control-solid @error('biodata') is-invalid @enderror " />
                                Uploaded File: 
                                @if($row->biodata)
                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->biodata) }}">{{$row->biodata}}</a>
                            	@else
                            	N/A
                            	@endif
                                @error('biodata')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
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

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-center">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a class="btn btn-light-danger" href="{{ route($moduleConfig['routes']['listRoute']) }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script type="text/javascript">
    
    // START address_proof_file
    var address_proof_file = new KTImageInput('address_proof_file');

	address_proof_file.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	address_proof_file.on('change', function(imageInput) {

		// swal.fire({
		// 	title: 'Image successfully uploaded !',
		// 	type: 'error',
		// 	buttonsStyling: false,
		// 	confirmButtonText: 'Okay!',
		// 	confirmButtonClass: 'btn btn-primary font-weight-bold'
		// });
		
	});

	address_proof_file.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END address_proof_file

</script>
@endpush