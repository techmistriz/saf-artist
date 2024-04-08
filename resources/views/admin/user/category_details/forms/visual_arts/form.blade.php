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
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Concept Note</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="file" name="concept_note"  class="form-control form-control-lg form-control-solid  @error('concept_note') is-invalid @enderror " />
                                <p class="text-muted small">Upload PDF (Name of file- Project Name + Artist Name)</p>
                                Uploaded File: 
                                @if($row->concept_note)
                                    <a target="_blank" href="{{ asset('uploads/users/'.$row->concept_note) }}">{{$row->concept_note}}</a>
                                @else
                                N/A
                                @endif
                                @error('concept_note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Has this project been shown before</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-solid selectpicker" name="has_this_project_show_before" tabindex="null" onchange="hasThisProjectShowBefore(this)">
                                    <option value="">Select</option>

                                    <option value="Yes" {{  old('has_this_project_show_before', $row->has_this_project_show_before ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{  old('has_this_project_show_before', $row->has_this_project_show_before ?? '') == 'No' ? 'selected' : '' }}>No</option>

                                </select>

                                @error('has_this_project_show_before')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6 reference-image-link-wrapper" style="display: {{ old('has_this_project_show_before', $row->has_this_project_show_before ?? '') == 'Yes' ? '' : 'none'; }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Reference Image (Google drive link) </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="reference_image_link" value="{{ old('reference_image_link', $row->reference_image_link ?? '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Reference Image (Google drive link)"/>
                                @error('reference_image_link')
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
    
    function hasThisProjectShowBefore(_this){

        if($(_this).val() == 'Yes'){
            $(".reference-image-link-wrapper").show();
        } else {

            $(".reference-image-link-wrapper").hide();
        }
    }

</script>
@endpush