@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
		    <div class="col-md-12">		        
		        <div class="card card-custom gutter-b">
		            <div class="card-header">
		                <div class="card-title">
		                    <h3 class="card-label">Show {{$moduleConfig['moduleTitle']}}</h3>
		                </div>
		            </div>
		             <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Member</th>
                                                <td colspan="3">{{$row->member->name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>Accomodation Required</th>
                                                <td colspan="3">{{$row->accomodation}}</td>
                                            </tr>
                                            <tr>
                                                <th>Occupant</th>
                                                <td colspan="3">{{$row->occupant}}</td>
                                            </tr>
                                            <tr>
                                                <th>Check In Date</th>
                                                <td colspan="3">{{$row->check_in_date}}</td>
                                            </tr>
                                            <tr>
                                                <th>Check Out Date</th>
                                                <td colspan="3">{{$row->check_out_date}}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Room Nights</th>
                                                <td colspan="3">{{$row->total_room_nights}}</td>
                                            </tr>
                                            <tr>
                                                <th>Artist Remarks</th>
                                                <td colspan="3">{{$row->artist_remarks}}</td>
                                            </tr>
                                            <tr>
                                                <th>Performance Venue</th>
                                                <td colspan="3">{{$row->performance_venue}}</td>
                                            </tr> 
                                            <tr>
                                                <th>Hotel Budget</th>
                                                <td colspan="3">{{$row->hotel_budget}}</td>
                                            </tr>
                                            <tr>
                                                <th>Hotel Room Sharing</th>
                                                <td colspan="3">{{$row->room_sharing}}</td>
                                            </tr>
                                            @if($shareRooms->count())
	                                            @foreach($shareRooms as $key => $value)
				                                    <tr>
				                                    	<th>Room No - {{ $value->room_no }}</th>
				                                        <td>{{ $value->name_1 }}</td>
				                                        <td>{{ $value->name_2 }}</td>
				                                    </tr>
				                                @endforeach
			                                @endif
                                            <tr>
                                                <th>Local Travel</th>
                                                <td colspan="3">{{$row->local_travel}}</td>
                                            </tr>
                                            <tr>
                                                <th>Performance Date</th>
                                                <td colspan="3">{{$row->performance_date}}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td colspan="3">{{ $row->status ? 'Active' : 'Inactive' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Created Date</th>
                                                <td colspan="3">{{$row->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <th>Updated Date</th>
                                                <td colspan="3">{{$row->updated_at}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>		           
		            <div class="card-footer">
		                <div class="row">
		                    <div class="col-lg-4"></div>
		                    <div class="col-lg-4 text-center">
		                        <a class="btn btn-primary" href="{{route('admin.user.index')}}">Back</a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>

    </div>
</div>
@endsection