@include('flash::message')

<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}}</h3>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">                    
                    <div class="col-12">
                                                
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Question:</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="question" value="{{ old('question', $row->question ?? '') }}" class="form-control" required placeholder="Enter question"/>
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Answer:</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                                <textarea name="answer" class="form-control" required placeholder="Enter answer" >{{ old('answer', $row->answer ?? '') }}</textarea>
                                @error('answer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row validated">
                        	<label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Status:</label>
							<div class="col-3">
								<span class="switch switch-icon">
									<label>
										<input type="checkbox" value="1" name="status" {{ old('status', $row->status ?? 1) == '1' ? 'checked' : '' }} />
										<span></span>
									</label>
								</span>
							</div>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-center">
                        <button type="submit" class="btn btn-light-primary mr-2">Submit</button>
                        <a class="btn btn-light-danger" href="{{ route($moduleConfig['routes']['listRoute']) }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">

</script>
@endpush