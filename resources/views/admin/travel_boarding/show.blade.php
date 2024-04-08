@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Show {{$moduleConfig['moduleTitle']}} Account Details</h3>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- START Ticket Booking -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-label">Ticket Booking</h5><hr>
                            </div>
                            
                            <div class="col-9">
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Project Name: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->project->name ?? ''}}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Cost Center: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->cost_center ?? ''}}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Program Manager: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->prog_manager ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">POC 2: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->poc2 ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Title: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->salutation ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Traveller Name As Per Gov. ID: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->name ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Age: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->age ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Contact Number: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->contact ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Email ID: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->email ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Mode of Travel (onward Journey): </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->mode_of_travel ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Onward (Mention City): </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->onwardCity->city_name ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Onward (Mention City) - Other: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->onwardCity->city_name ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Date of Travel: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->date_of_travel ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Preferred Time to reach Goa: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->preferred_time_to_reach_goa ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Preferred Flight/Train No to Reach Goa: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->preferred_flight_train_no_to_reach_goa ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Return City: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->returnCity->city_name ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Return City - Other: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->return_city_other ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Return Date: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->return_date ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Preferred Time to leave Goa: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->preferred_time_to_leave_goa ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Preferred Flight/Train No to Leave Goa: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->preferred_flight_train_no_to_leave_goa ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Excess Luggage in KGS: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->excess_luggage_in_kgs ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Artist Remarks: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->artist_remarks ?? '' }}</label>
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">POC Remarks: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->travelBoarding->poc_remarks ?? '' }}</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- END Ticket Booking -->

                        <!-- START Ticket Booking -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-label">Hotel Booking</h5><hr>
                            </div>
                            
                            <div class="col-9">
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Accomodation Required: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->accomodation ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Room Type: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->room_type ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Check In Date: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->check_in_date ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Check Out Date: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->check_out_date ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Total Room Nights: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->total_room_nights ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Artist Remarks: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->hotel_artist_remarks ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">POC Remarks: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->hotel_poc_remarks ?? ''}}</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- END Hotel Booking -->

                        <!-- START Ground Transport -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-label">Ground Transport</h5><hr>
                            </div>
                            
                            <div class="col-9">
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Airport Transfer: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->airport_transfer ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case"> Airport Drop Required: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->airport_drop_required_date ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">No. Of Dedicated Cab Required For The GROUP: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->no_of_dedicated_cab ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Dedicated Cab Required - Starting Date: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->dedicated_cab_required_starting_date ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Dedicated Cab Required - End Date: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->dedicated_cab_required_end_date ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Group Poc Name: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->group_poc_name ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Group Poc Whatsapp Number: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->group_poc_whatsapp_number ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Artist Remarks: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->ground_transport_artist_remarks ?? ''}}</label>
                                    </div>
                                </div>
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Poc Remarks: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->travelBoarding->ground_transport_poc_remarks ?? ''}}</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- END Ground Transport -->
                        
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 text-center">
                                <a class="btn btn-primary" href="{{ route($moduleConfig['routes']['listRoute']) }}">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection