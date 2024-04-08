@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">

        @include('admin.includes.common.error')
            
        <form action="{{ route($moduleConfig['routes']['updateCategoryDetailsRoute'], $row->user_id) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$row->user_id}}">
            {{ csrf_field() }}
            @include('admin.'.$moduleConfig['viewCategoryDetailsFolder'].'.forms.'.$catViewFile.'.form');
        </form>
    </div>
</div>
@endsection


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