@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">

        @include('admin.includes.common.error')
            
        <form action="{{route($moduleConfig['routes']['updateRoute'], $row->id)}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$row->id}}">
            {{ csrf_field() }}
            @include('admin.'.$moduleConfig['viewFolder'].'.forms.form');
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script type="text/javascript">
	
	function roomNightCalc(){

		var check_in_date  = document.getElementById('check_in_date').value;
		var check_out_date  = document.getElementById('check_out_date').value;
		
		if(!check_in_date && check_out_date){

			$("#total_room_nights").val('');
			return;
		}

		if(check_in_date && check_out_date){

			const date1 = moment(check_in_date, 'DD/MM/YYY').toDate();
			const date2 = moment(check_out_date, 'DD/MM/YYY').toDate();

			var diff = Math.abs(date2.getTime() - date1.getTime());
			var dayDiff = Math.ceil(diff / (1000 * 3600 * 24));  

			if (date1 > date2){ 

				$("#total_room_nights").val('');
				$("#check_out_date").parent().after('<div class="invalid-feedback">Check-out date must be after check-in date!</div>');

			} else {
				
				$("#total_room_nights").val(dayDiff);
				$("#check_out_date").parent().parent().find('.invalid-feedback').remove();
				return;
			}

		} else {
			
			$("#total_room_nights").val('');
		}
	}
	
	function checkOtherCity(_this, selector = ''){

		if($(_this).val() == '16'){
			$("." + selector).show();
		} else {

			$("." + selector).hide();
		}
	}

</script>
@endpush