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
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Project Name </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="project_id" tabindex="null" >
                                    <option value="">Select</option>
                                   	@if($projects->count())
                                        @foreach($projects as $value)

                                           <option {{ old('project_id', $row->project_id ?? 0) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

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
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">No. of team members </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                            	<div class="input-group date">
									<input type="text" name="no_of_team_members" value="{{ old('no_of_team_members') ? old('no_of_team_members') : ( isset($row->no_of_team_members) ? $row->no_of_team_members : '') }}" class="form-control" placeholder="Enter No. of team members"/>

									@error('no_of_team_members')
	                                    <div class="invalid-feedback">{{ $message }}</div>
	                                @enderror

									
								</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Brand Name</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="brand_name" value="{{ old('brand_name') ? old('brand_name') :( isset($row->brand_name) ? $row->brand_name : '') }}" class="form-control " maxlength="15"  placeholder="Enter Brand Name"/>
                                @error('brand_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Brand bio/ Note on brand</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control no-summernote-editor" name="brand_bio" id="brand_bio" placeholder="Enter Brand bio/ Note on brand" require>{{ old('brand_bio') ? old('brand_bio') : ( isset($row->brand_bio) ? $row->brand_bio : '') }}</textarea>
                                @error('brand_bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
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

                    <div class="col-6">
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

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">video/ youtube link</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                            	<div class="input-group date">
									<input type="text" name="youtube_link" value="{{ old('youtube_link') ? old('youtube_link') : ( isset($row->youtube_link) ? $row->youtube_link : '') }}" class="form-control" placeholder="Enter video/ youtube link"/>

									@error('youtube_link')
	                                    <div class="invalid-feedback">{{ $message }}</div>
	                                @enderror

									
								</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Menu/Inventory list of the products to be sold </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

								<input type="file" name="inventory_list"  class="form-control form-control-lg form-control-solid @error('inventory_list') is-invalid @enderror " />
                                Uploaded File: 
                                @if($row->inventory_list)
                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->inventory_list) }}">{{$row->inventory_list}}</a>
                            	@else
                            	N/A
                            	@endif

								@error('inventory_list')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        </div>
                    </div>
                
                	<div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">MRP of the products </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="file" name="mrp_of_the_products"  class="form-control form-control-lg form-control-solid @error('mrp_of_the_products') is-invalid @enderror " />
                                Uploaded File: 
                                @if($row->mrp_of_the_products)
                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->mrp_of_the_products) }}">{{$row->mrp_of_the_products}}</a>
                            	@else
                            	N/A
                            	@endif
                                @error('mrp_of_the_products')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">HSN/SAC Code</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="hsn_sac_code" value="{{ old('hsn_sac_code') ? old('hsn_sac_code') :( isset($row->hsn_sac_code) ? $row->hsn_sac_code : '') }}" class="form-control " maxlength="15"  placeholder="Enter HSN/SAC Code"/>
                                @error('hsn_sac_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Registration fees (if needed)</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="registration_fees" value="{{ old('registration_fees') ? old('registration_fees') :( isset($row->registration_fees) ? $row->registration_fees : '') }}" class="form-control " maxlength="15"  placeholder="Enter Registration fees (if needed)"/>
                                @error('registration_fees')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Table</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="tables" tabindex="null" >
                                    <option value="">Select</option>
                                    @foreach(range(1, 50) as $value)
                                       <option {{ old('tables', $row->tables ?? 0) == $value ? 'selected' : '' }} value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @error('tables')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">chair</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="chair" tabindex="null" >
                                    <option value="">Select</option>
                                    @foreach(range(1, 50) as $value)
                                       <option {{ old('chair', $row->chair ?? 0) == $value ? 'selected' : '' }} value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @error('chair')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">easel</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="easel" tabindex="null" >
                                    <option value="">Select</option>
                                    @foreach(range(1, 50) as $value)
                                       <option {{ old('easel', $row->easel ?? 0) == $value ? 'selected' : '' }} value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @error('easel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">fan</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="fan" tabindex="null" >
                                    <option value="">Select</option>
                                    @foreach(range(1, 50) as $value)
                                       <option {{ old('fan', $row->fan ?? 0) == $value ? 'selected' : '' }} value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @error('fan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">dustbin</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="dustbin" tabindex="null" >
                                    <option value="">Select</option>
                                    @foreach(range(1, 50) as $value)
                                       <option {{ old('dustbin', $row->dustbin ?? 0) == $value ? 'selected' : '' }} value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @error('dustbin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">lamp</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="lamp" tabindex="null" >
                                    <option value="">Select</option>
                                    @foreach(range(1, 50) as $value)
                                       <option {{ old('lamp', $row->lamp ?? 0) == $value ? 'selected' : '' }} value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @error('lamp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">lock</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="locks" tabindex="null" >
                                    <option value="">Select</option>
                                    @foreach(range(1, 50) as $value)
                                       <option {{ old('locks', $row->locks ?? 0) == $value ? 'selected' : '' }} value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @error('locks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">extension board</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="extension_board" tabindex="null" >
                                    <option value="">Select</option>
                                    @foreach(range(1, 50) as $value)
                                       <option {{ old('extension_board', $row->extension_board ?? 0) == $value ? 'selected' : '' }} value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @error('extension_board')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Other Requirement</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control no-summernote-editor" name="other_requirement" id="other_requirement" placeholder="Enter Other Requirement" require>{{ old('other_requirement') ? old('other_requirement') : ( isset($row->other_requirement) ? $row->other_requirement : '') }}</textarea>
                                @error('other_requirement')
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