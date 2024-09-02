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
                                                <td>{{$row->member->name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>Project Name</th>
                                                <td>{{ implode(', ', $row->project()) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Title</th>
                                                <td>{{$row->salutation}}</td>
                                            </tr>
                                            <tr>
                                                <th>Traveller Name As Per Gov. ID</th>
                                                <td>{{$row->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Age</th>
                                                <td>{{$row->age}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{$row->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>Contact</th>
                                                <td>{{$row->contact}}</td>
                                            </tr> 
                                            <tr>
                                                <th>Origin City</th>
                                                <td>{{$row->onward_city ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Travel</th>
                                                <td>{{ \Carbon\Carbon::parse($row->onward_date)->format('d-M-Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Return City</th>
                                                <td>{{$row->return_city ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>Preferred Return Date for Travel</th>
                                                <td>{{ \Carbon\Carbon::parse($row->return_date)->format('d-M-Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pick Up Required</th>
                                                <td>{{ $row->pickup_required}}</td>
                                            </tr>
                                            
                                             <tr style="{{ isset($row->member->poc_id) && !empty($row->member->poc_id) ? '' : 'display:none;'}}">
                                                <th>International/Domestic Traveller</th>
                                                <td>{{$row->international_or_domestic}}</td>
                                            </tr> 
                                            <tr style="{{(isset($row->member->poc_id) && empty($row->member->poc_id)) || (isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic') ? 'display:none;' : '' }}">
                                                <th>Do you have work visa for India</th>
                                                <td>{{$row->work_visa}}</td>
                                            </tr>
                                            <tr style="{{(isset($row->member->poc_id) && empty($row->member->poc_id)) || (isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic') ? 'display:none;' : '' }}">
                                                <th>Upload Passport (Image)</th>
                                                <td>
                                                    <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">

                                                        @if(isset($row->upload_passport) && !empty($row->upload_passport))
                                                            <div class="image-input-wrapper" style="background-image: url({{asset('uploads/passports/'.$row->upload_passport)}})"></div>
                                                        @else
                                                            <div class="image-input-wrapper"></div>
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        Uploaded File: 
                                                        @if($row->upload_passport)
                                                            <a target="_blank" href="{{ asset('uploads/passports/'.$row->upload_passport) }}">{{$row->upload_passport}}</a>
                                                        @else
                                                        N/A
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr> 
                                            <tr style="{{(isset($row->member->poc_id) && empty($row->member->poc_id)) || (isset($row->international_or_domestic) && $row->international_or_domestic == 'International') ? 'display:none;' : '' }}">
                                                <th>Upload Adhaar card or Driving License</th>
                                                <td>
                                                    <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">

                                                        @if(isset($row->adhaarcard_driving) && !empty($row->adhaarcard_driving))
                                                            <div class="image-input-wrapper" style="background-image: url({{asset('uploads/adhaarcard_drivings/'.$row->adhaarcard_driving)}})"></div>
                                                        @else
                                                            <div class="image-input-wrapper"></div>
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        Uploaded File: 
                                                        @if($row->adhaarcard_driving)
                                                            <a target="_blank" href="{{ asset('uploads/adhaarcard_drivings/'.$row->adhaarcard_driving) }}">{{$row->adhaarcard_driving}}</a>
                                                        @else
                                                        N/A
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>                                          
                                            <tr>
                                                <th>Status</th>
                                                <td>{{ $row->status ? 'Active' : 'Inactive' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Created Date</th>
                                                <td>{{ $row->created_at  }}</td>
                                            </tr>
                                            <tr>
                                                <th>Updated Date</th>
                                                <td>{{ $row->updated_at }}</td>
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