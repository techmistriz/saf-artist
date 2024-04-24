@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Show {{$moduleConfig['moduleTitle']}} Banking Details</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Full Name</th>
                                                <td>{{$row->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Permanent Address</th>
                                                <td>{{$row->permanent_address}}</td>
                                            </tr>
                                            <tr>
                                                <th>Account Number</th>
                                                <td>{{$row->account_number}}</td>
                                            </tr>
                                            <tr>
                                                <th>Bank holder name(As per govt id)</th>
                                                <td>{{$row->bank_holder_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Bank Name</th>
                                                <td>{{$row->bank_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Branch Address</th>
                                                <td>{{$row->branch_address}}</td>
                                            </tr>
                                            <tr>
                                                <th>IFSC Code</th>
                                                <td>{{$row->ifsc_code}}</td>
                                            </tr>
                                            <tr>
                                                <th>Cancelled Cheque Image</th>
                                                <td>
                                                    <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">

                                                        @if(isset($row->cancel_cheque_image) && !empty($row->cancel_cheque_image))
                                                            <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->cancel_cheque_image)}})"></div>
                                                        @else
                                                            <div class="image-input-wrapper"></div>
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        Uploaded File: 
                                                        @if($row->cancel_cheque_image)
                                                            <a target="_blank" href="{{ asset('uploads/users/'.$row->cancel_cheque_image) }}">{{$row->cancel_cheque_image}}</a>
                                                        @else
                                                        N/A
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Pan Card Number</th>
                                                <td>{{$row->pancard_number}}</td>
                                            </tr>
                                            <tr>
                                                <th>Pan Card Image</th>
                                                <td>
                                                    <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">

                                                        @if(isset($row->pancard_image) && !empty($row->pancard_image))
                                                            <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->pancard_image)}})"></div>
                                                        @else
                                                            <div class="image-input-wrapper"></div>
                                                        @endif
                                                    </div>

                                                    <div class="">
                                                        Uploaded File: 
                                                        @if($row->pancard_image)
                                                            <a target="_blank" href="{{ asset('uploads/users/'.$row->pancard_image) }}">{{$row->pancard_image}}</a>
                                                        @else
                                                        N/A
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>GST Applicable</th>
                                                <td>{{$row->has_gst_applicable}}</td>
                                            </tr>
                                            <tr>
                                                <th>GST Number</th>
                                                <td>{{$row->gst_number}}</td>
                                            </tr>
                                            <tr>
                                                <th>Gst Certificate</th>
                                                <td>
                                                    <div class="">
                                                        Uploaded File: 
                                                        @if($row->gst_certificate_file)
                                                            <a target="_blank" href="{{ asset('uploads/users/'.$row->gst_certificate_file) }}">{{$row->gst_certificate_file}}</a>
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