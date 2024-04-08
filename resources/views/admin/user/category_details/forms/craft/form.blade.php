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
                                <select class="form-control selectpicker" name="project_id" tabindex="null" >
                                    <option value="">Select</option>
                                   	@if($projects->count())
                                        @foreach($projects as $project_id)

                                           <option {{ !empty(old('project_id')) && old('project_id') == $project_id->id ? 'selected' : ( isset($row->project_id) && $row->project_id == $project_id->id ? 'selected' : '' ) }} value="{{$project_id->id}}">{{$project_id->name}}</option>

                                        @endforeach
                                    @endif
                                </select>
                                @error('project_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Organisation/ Foundation/ Trust you are associated with (if any)</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="organisation" value="{{ old('organisation') ? old('organisation') :( isset($row->organisation) ? $row->organisation : '') }}" class="form-control "   placeholder="Enter Name of the Artisan"/>
                                @error('organisation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name of the Artisan</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="name_of_the_artisan" value="{{ old('name_of_the_artisan') ? old('name_of_the_artisan') :( isset($row->name_of_the_artisan) ? $row->name_of_the_artisan : '') }}" class="form-control "   placeholder="Enter Name of the Artisan"/>
                                @error('name_of_the_artisan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">About the Artisan </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                            	<div class="input-group date">
									<textarea class="form-control  no-summernote-editor" name="about_the_artisan" id="about_the_artisan" placeholder="Enter About the Artisan" >{{ old('about_the_artisan') ? old('about_the_artisan') : ( isset($row->about_the_artisan) ? $row->about_the_artisan : '') }}</textarea>

									@error('form_genre')
	                                    <div class="invalid-feedback">{{ $message }}</div>
	                                @enderror

									
								</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name of the Design Studio</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="name_of_the_design_studio" value="{{ old('name_of_the_design_studio') ? old('name_of_the_design_studio') :( isset($row->name_of_the_design_studio) ? $row->name_of_the_design_studio : '') }}" class="form-control " maxlength="15"  placeholder="Enter Name of the Design Studio"/>
                                @error('name_of_the_design_studio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">About the Design Studio</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control  no-summernote-editor" name="about_the_design_studio" id="about_the_design_studio" placeholder="Enter About the Design Studio" >{{ old('about_the_design_studio') ? old('about_the_design_studio') : ( isset($row->about_the_design_studio) ? $row->about_the_design_studio : '') }}</textarea>
                                @error('about_the_design_studio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                 
                	<div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">About the Crafts </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control  no-summernote-editor" name="about_the_crafts" id="about_the_crafts" placeholder="Enter About the Crafts" >{{ old('about_the_crafts') ? old('about_the_crafts') : ( isset($row->about_the_crafts) ? $row->about_the_crafts : '') }}</textarea>
                                @error('biodata')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">About the Director/Designers </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control  no-summernote-editor" name="about_the_director" id="about_the_director" placeholder="Enter About the Director/Designers" >{{ old('about_the_director') ? old('about_the_director') : ( isset($row->about_the_director) ? $row->about_the_director : '') }}</textarea>
                                @error('about_the_director')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Brand Name</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="brand_name" value="{{ old('brand_name') ? old('brand_name') :( isset($row->brand_name) ? $row->brand_name : '') }}" class="form-control " maxlength="15"  placeholder="Enter Brand Name"/>
                                @error('brand_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Brand Logo </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                            	<div class="image-input image-input-outline" id="brand_logo" style="background-image: url({{asset('media/users/blank.png')}})">

                            		@if(isset($row->brand_logo) && !empty($row->brand_logo))
										<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->brand_logo)}})"></div>
                            		@else
                            			<div class="image-input-wrapper brand_logo_base64"></div>
                            		@endif

									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="brand_logo" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="brand_logo_remove"/>
									</label>

									@if(isset($row->brand_logo) && !empty($row->brand_logo))
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@else
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@endif
								</div>

                                @error('brand_logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">High res images of the Designers </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                            	<div class="image-input image-input-outline" id="high_res_images_of_the_designer_1" style="background-image: url({{asset('media/users/blank.png')}})">

                            		@if(isset($row->high_res_images_of_the_designer_1) && !empty($row->high_res_images_of_the_designer_1))
										<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_designer_1)}})"></div>
                            		@else
                            			<div class="image-input-wrapper high_res_images_of_the_designer_1_base64"></div>
                            		@endif

									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="high_res_images_of_the_designer_1" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="high_res_images_of_the_designer_1_remove"/>
									</label>

									@if(isset($row->high_res_images_of_the_designer_1) && !empty($row->high_res_images_of_the_designer_1))
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@else
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@endif
								</div>

								<div class="image-input image-input-outline" id="high_res_images_of_the_designer_2" style="background-image: url({{asset('media/users/blank.png')}})">

                            		@if(isset($row->high_res_images_of_the_designer_2) && !empty($row->high_res_images_of_the_designer_2))
										<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_designer_2)}})"></div>
                            		@else
                            			<div class="image-input-wrapper high_res_images_of_the_designer_2_base64"></div>
                            		@endif

									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="high_res_images_of_the_designer_2" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="high_res_images_of_the_designer_2_remove"/>
									</label>

									@if(isset($row->high_res_images_of_the_designer_2) && !empty($row->high_res_images_of_the_designer_2))
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@else
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@endif
								</div>

								<div class="image-input image-input-outline" id="high_res_images_of_the_designer_3" style="background-image: url({{asset('media/users/blank.png')}})">

                            		@if(isset($row->high_res_images_of_the_designer_3) && !empty($row->high_res_images_of_the_designer_3))
										<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_designer_3)}})"></div>
                            		@else
                            			<div class="image-input-wrapper high_res_images_of_the_designer_3_base64"></div>
                            		@endif

									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="high_res_images_of_the_designer_3" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="high_res_images_of_the_designer_3_remove"/>
									</label>

									@if(isset($row->high_res_images_of_the_designer_3) && !empty($row->high_res_images_of_the_designer_3))
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@else
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@endif
								</div>

                                @error('high_res_images_of_the_designer_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @error('high_res_images_of_the_designer_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @error('high_res_images_of_the_designer_3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">High res images of the product</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                            	<div class="image-input image-input-outline" id="high_res_images_of_the_product_1" style="background-image: url({{asset('media/users/blank.png')}})">

                            		@if(isset($row->high_res_images_of_the_product_1) && !empty($row->high_res_images_of_the_product_1))
										<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_product_1)}})"></div>
                            		@else
                            			<div class="image-input-wrapper high_res_images_of_the_product_1_base64"></div>
                            		@endif

									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="high_res_images_of_the_product_1" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="high_res_images_of_the_product_1_remove"/>
									</label>

									@if(isset($row->high_res_images_of_the_product_1) && !empty($row->high_res_images_of_the_product_1))
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@else
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@endif
								</div>

								<div class="image-input image-input-outline" id="high_res_images_of_the_product_2" style="background-image: url({{asset('media/users/blank.png')}})">

                            		@if(isset($row->high_res_images_of_the_product_2) && !empty($row->high_res_images_of_the_product_2))
										<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_product_2)}})"></div>
                            		@else
                            			<div class="image-input-wrapper high_res_images_of_the_product_2_base64"></div>
                            		@endif

									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="high_res_images_of_the_product_2" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="high_res_images_of_the_product_2_remove"/>
									</label>

									@if(isset($row->high_res_images_of_the_product_2) && !empty($row->high_res_images_of_the_product_2))
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@else
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@endif
								</div>

								<div class="image-input image-input-outline" id="high_res_images_of_the_product_3" style="background-image: url({{asset('media/users/blank.png')}})">

                            		@if(isset($row->high_res_images_of_the_product_3) && !empty($row->high_res_images_of_the_product_3))
										<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_product_3)}})"></div>
                            		@else
                            			<div class="image-input-wrapper high_res_images_of_the_product_3_base64"></div>
                            		@endif

									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="high_res_images_of_the_product_3" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="high_res_images_of_the_product_3_remove"/>
									</label>

									@if(isset($row->high_res_images_of_the_product_3) && !empty($row->high_res_images_of_the_product_3))
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@else
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@endif
								</div>

                                @error('high_res_images_of_the_product_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @error('high_res_images_of_the_product_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @error('high_res_images_of_the_product_3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
	                    <div class="form-group row validated">
	                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Are you part of any other project</label>
	                        <div class="col-lg-9 col-md-9 col-sm-12">
	                            <select class="form-control form-control-lg form-control-solid selectpicker" name="has_part_of_other_project" tabindex="null" onchange="hasPartOfOtherProject(this)">
	                                <option value="">Select</option>

	                                <option value="Yes" {{  old('has_part_of_other_project', $row->has_part_of_other_project ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
	                                <option value="No" {{  old('has_part_of_other_project', $row->has_part_of_other_project ?? '') == 'No' ? 'selected' : '' }}>No</option>

	                            </select>

	                            @error('has_part_of_other_project')
	                                <div class="invalid-feedback">{{ $message }}</div>
	                            @enderror
	                        
	                        </div>
	                    </div>
	                </div>
	            </div>

	            <div class="row  has-part-of-other-project" style="display: {{ old('has_part_of_other_project', $row->has_part_of_other_project ?? 'No') == 'Yes' ? '' : 'none'; }}">
	                <div class="col-6">
	                	<div class="form-group row validated">
	                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Category of the project </label>
	                        <div class="col-lg-9 col-md-9 col-sm-12">
	                            <select class="form-control form-control-lg form-control-solid selectpicker" name="other_project_category_id" id="other_project_category_id" tabindex="null" onchange="getProjects(this)">
	                                <option value="">Select</option>
	                               	@if($categories->count())
				                        @foreach($categories as $value)

				                           <option {{ old('other_project_category_id', $row->other_project_category_id ?? 0) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

				                        @endforeach
				                    @endif
	                            </select>
	                            @error('other_project_category_id')
	                                <div class="invalid-feedback">{{ $message }}</div>
	                            @enderror
	                        </div>
	                    </div>
	                </div>

	                <div class="col-6">
	                    <div class="form-group row validated">
	                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name of the project </label>
	                        <div class="col-lg-9 col-md-9 col-sm-12">
	                            <select class="form-control form-control-lg form-control-solid selectpicker" name="other_project_id" id="other_project_id" tabindex="null" >
	                                <option value="">Select</option>
	                               	
	                            </select>
	                            @error('other_project_id')
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
    
    // START brand_logo
    var brand_logo = new KTImageInput('brand_logo');

	brand_logo.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	brand_logo.on('change', function(imageInput) {

		// swal.fire({
		// 	title: 'Image successfully uploaded !',
		// 	type: 'error',
		// 	buttonsStyling: false,
		// 	confirmButtonText: 'Okay!',
		// 	confirmButtonClass: 'btn btn-primary font-weight-bold'
		// });
		
	});

	brand_logo.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END brand_logo


	// START high_res_images_of_the_designer_1
    var high_res_images_of_the_designer_1 = new KTImageInput('high_res_images_of_the_designer_1');

	high_res_images_of_the_designer_1.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	high_res_images_of_the_designer_1.on('change', function(imageInput) {
		
	});

	high_res_images_of_the_designer_1.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END high_res_images_of_the_designer_1

	// START high_res_images_of_the_designer_2
    var high_res_images_of_the_designer_2 = new KTImageInput('high_res_images_of_the_designer_2');

	high_res_images_of_the_designer_2.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	high_res_images_of_the_designer_2.on('change', function(imageInput) {
		
	});

	high_res_images_of_the_designer_2.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END high_res_images_of_the_designer_2

	// START high_res_images_of_the_designer_3
    var high_res_images_of_the_designer_3 = new KTImageInput('high_res_images_of_the_designer_3');

	high_res_images_of_the_designer_3.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	high_res_images_of_the_designer_3.on('change', function(imageInput) {
		
	});

	high_res_images_of_the_designer_3.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END high_res_images_of_the_designer_3

	// START high_res_images_of_the_product_1
    var high_res_images_of_the_product_1 = new KTImageInput('high_res_images_of_the_product_1');

	high_res_images_of_the_product_1.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	high_res_images_of_the_product_1.on('change', function(imageInput) {
		
	});

	high_res_images_of_the_product_1.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END high_res_images_of_the_product_1

	// START high_res_images_of_the_product_2
    var high_res_images_of_the_product_2 = new KTImageInput('high_res_images_of_the_product_2');

	high_res_images_of_the_product_2.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	high_res_images_of_the_product_2.on('change', function(imageInput) {
		
	});

	high_res_images_of_the_product_2.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END high_res_images_of_the_product_2

	// START high_res_images_of_the_product_3
    var high_res_images_of_the_product_3 = new KTImageInput('high_res_images_of_the_product_3');

	high_res_images_of_the_product_3.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	high_res_images_of_the_product_3.on('change', function(imageInput) {
		
	});

	high_res_images_of_the_product_3.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END high_res_images_of_the_product_3

	
</script>
@endpush