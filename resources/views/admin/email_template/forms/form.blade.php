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
                    
                    <div class="col-6">
                        
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-right">Name</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="name" value="{{ old('name') ? old('name') :( isset($row->name) ? $row->name : '') }}" class="form-control" required placeholder="Enter Name"/>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                          <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-right">Subject</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="subject" value="{{ old('subject') ? old('subject') :( isset($row->subject) ? $row->subject : '') }}" class="form-control" required placeholder="Enter Subject"/>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                     
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-right">Content </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control summernote-editor" name="content" id="content" placeholder="Enter Content" require>{{ old('content') ? old('content') : ( isset($row->content) ? $row->content : '') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>

                        <div class="form-group row validated">

                        	<label class="col-form-label col-lg-3 col-sm-12 text-lg-right">Status</label>
							<div class="col-3">
								<span class="switch switch-icon">
									<label>
										<input type="checkbox" value="1" name="status" {{ old('status', $row->status ?? 0) == '1' ? 'checked' : '' }} />
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
                    <div class="col-lg-3"></div>
                    <div class="col-lg-4 text-center">
                        <button type="submit" class="btn btn-light-primary mr-2">Submit</button>
                        <a class="btn btn-primary" href="{{ route($moduleConfig['routes']['listRoute']) }}">Cancel</a>
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