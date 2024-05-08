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
                    
                    <div class="col-8">
                        
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Pincode</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="pincode" value="{{ old('pincode') ? old('pincode') :( isset($row->pincode) ? $row->pincode : '') }}" class="form-control" required placeholder="Enter Pincode" oninput="this.value=this.value.replace(/[^0-9]/, '')"/>
                                @error('pincode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Country</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="country_id" tabindex="null" onchange="getState()" data-live-search="true" required>
                                    <option value="" data-slug="">Select Country</option>
                                    @if($countries->count())
                                        @foreach($countries as $value)
                                          <option {{ (old('country_id') ?? optional($row)->country_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->country_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('country_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">State</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="state_id" tabindex="null" onchange="getCity()" data-live-search="true" required>
                                    <option value="" data-slug="">Select State</option>
                                   
                                </select>
                                @error('state_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">City</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="city_id" tabindex="null" data-live-search="true" required>
                                    <option value="" data-slug="">Select City</option>
                                    
                                </select>
                                @error('city_id')
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
    function getState() {
        var country_id = $('select[name=country_id]').val();

        if (country_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('states') }}/" + country_id,
                dataType: 'json',
                success: function (response) {
                    if (response && response.status) {
                        var options = '<option value="">Select State</option>';
                        if (response.data.length) {

                            var selectedId = '{{ $row->state_id ?? 0 }}';

                            for (var i = 0; i < response.data.length; i++) {
                                var _selected = '';

                                if (selectedId == response.data[i].id) {
                                    _selected = 'selected';
                                }

                                options += '<option ' + _selected + ' value="' + response.data[i].id + '">' + response.data[i].state_name + '</option>';
                            }

                            $("select[name='state_id']").html(options);
                            $("select[name='state_id']").selectpicker('refresh');
                            getCity();
                        }
                    }
                }
            });

        } else {

            $("select[name='state_id']").html('<option value="">Select State</option>');
            $("select[name='state_id']").selectpicker('refresh');
        }
    }

    function getCity() {

        var state_id = $('select[name=state_id]').val();

        if (state_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('cities') }}/" + state_id,
                datatype: 'json',
                success: function (response) {
                    if (response && response.status) {
                        var options = '<option value="">Select City</option>';
                        if (response.data.length) {

                            var selectedId = '{{ $row->city_id ?? 0 }}';

                            for (var i = 0; i < response.data.length; i++) {
                                var _selected = '';

                                if (selectedId == response.data[i].id) {
                                    _selected = 'selected';
                                }

                                options += '<option ' + _selected + ' value="' + response.data[i].id + '">' + response.data[i].city_name + '</option>';
                            }

                            $("select[name='city_id']").html(options);
                            $("select[name='city_id']").selectpicker('refresh');
                        }
                    }
                }
            });

        } else {
            
            $("select[name='city_id']").html('<option value="">Select City</option>');
            $("select[name='city_id']").selectpicker('refresh');
        }
    }


    $(document).ready(function(){
        
        getState();
        
    });

</script>
@endpush