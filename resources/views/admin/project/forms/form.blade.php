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
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Name</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="name" value="{{ old('name', $row->name ?? '') }}" class="form-control" required placeholder="Enter Project Name"/>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>                        

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Year</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-custom selectpicker" name="year" tabindex="null" onchange="getFestival()" required>
                                    <option value="">Select Year</option>
                                    @if( isset($project_years) && count($project_years))
                                        @foreach($project_years as $year)

                                           <option {{ !empty(old('year')) && old('year') == $year ? 'selected' : ( isset($row->year) && $row->year == $year ? 'selected' : '' ) }} value="{{$year}}">{{$year}}</option>

                                        @endforeach
                                    @endif
                                </select>

                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left"> Festival </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="festival_id" tabindex="null" required>
                                    <option value="">Select Festival</option>
                                </select>

                                @error('festival_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left"> Discipline </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="category_id" tabindex="null" >
                                    <option value="">Select Discipline</option>
                                    @if($categories->count())
                                        @foreach($categories as $category)

                                           <option {{ !empty(old('category_id')) && old('category_id') == $category->id ? 'selected' : ( isset($row->category_id) && $row->category_id == $category->id ? 'selected' : '' ) }} value="{{$category->id}}">{{$category->name}}</option>

                                        @endforeach
                                    @endif
                                </select>

                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>

                        <div class="form-group row validated">

                        	<label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Status</label>
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
    $(document).ready(function(){
        
        getFestival();
        
    });
    function getFestival() {

        var year = $('select[name=year]').val();

        if(year){

            $.ajax({
                type: "GET",
                url: "{{ url('festivals') }}/" + year,
                datatype: 'json',
                success: function (response) {
                    if(response?.status){
                        var options = '<option value="">Select Festival</option>';
                        if(response.data.length) {

                            var selectedId = '{{ $row->festival_id ?? 0 }}';

                            for (var i = 0; i < response.data.length; i++) {

                                var _selected = '';

                                if(selectedId == response.data[i].id){

                                    _selected = 'selected';
                                }
                                //console.log(response.data[i].name);
                                options += '<option '+_selected+' value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
                            }

                            $("select[name='festival_id']").html(options);
                            $("select[name='festival_id']").selectpicker('refresh');
                        }
                    }
                }
            });

        } else {

            $("select[name='festival_id']").html('<option value="">Select Festival</option>');
            $("select[name='festival_id']").selectpicker('refresh');
        }
    }

</script>
@endpush