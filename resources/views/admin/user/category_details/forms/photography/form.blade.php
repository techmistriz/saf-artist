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
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Number of people in your group </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                            	<input type="text" name="no_of_people_in_group" oninput="this.value=this.value.replace(/[^0-9]/, '')" value="{{ old('no_of_people_in_group') ? old('no_of_people_in_group') : ( isset($row->no_of_people_in_group) ? $row->no_of_people_in_group : '') }}" class="form-control" placeholder="Enter Details"/>
                            	
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

@endpush