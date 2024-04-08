<form action="{{ route('update.category') }}" method="POST" enctype="multipart/form-data" id="category_form">
    <input type="hidden" name="_method" value="PUT">
    {{ csrf_field() }}
	<div class="row">
		<div class="col-12">
	        <div class="form-group row validated">
	            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Category </label>
	            <div class="col-lg-9 col-md-9 col-sm-12">
	                <select class="form-control form-control-lg form-control-solid selectpicker" name="category_id" tabindex="null" onchange="document.getElementById('category_form').submit();">
	                    <option value="">Select</option>
	                   	@if($categories->count())
	                        @foreach($categories as $value)

	                           <option {{ old('category_id', $user->category_id ?? 0) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

	                        @endforeach
	                    @endif
	                </select>
	                @error('category_id')
	                    <div class="invalid-feedback">{{ $message }}</div>
	                @enderror
	            </div>
	        </div>
	    </div>
	</div>
</form>


@push('scripts')
<script type="text/javascript">
    
	function hasPartOfOtherProject(_this){

		if($(_this).val() == 'Yes'){
			$(".has-part-of-other-project").show();
		} else {

			$(".has-part-of-other-project").hide();
		}
	}

	function getProjects(_this, selectedId = 0) {

	    var other_project_category_id = $('#other_project_category_id').val();
	    if(other_project_category_id){
		    $.ajax({
				type: "GET",
				url: "{{ url('projects') }}/?category_id=" + other_project_category_id,
				datatype: 'json',
				success: function (response) {
					if(response?.status){
						var options = '<option value="">Select Project</option>';
						if(response.data.length) {
							for (var i = 0; i < response.data.length; i++) {

								var _selected = '';

								if(selectedId == response.data[i].id){

									_selected = 'selected';
								}

								options += '<option '+_selected+' value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
							}

							$("#other_project_id").html(options);
							$("#other_project_id").selectpicker('refresh');
						}
					}
				}
			});
	    } else {
	    	$("#other_project_id").html('<option value="">Select Project</option>');
	    	$("#other_project_id").selectpicker('refresh');
	    }
    }

    $(document).ready(function(){
		
		getProjects(null, <?php echo old( 'other_project_id', $row->other_project_id ?? 0 )?>);

	});

</script>
@endpush