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
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Synopsis/ Description of the performance</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="synopsis_description_of_the_performance" value="{{ old('synopsis_description_of_the_performance', $row->synopsis_description_of_the_performance ?? '') }}" class="form-control" placeholder="Enter Synopsis/ Description of the performance"/>
                                @error('synopsis_description_of_the_performance')
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
                                <p class="text-muted small">PDF</p>
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

@endpush