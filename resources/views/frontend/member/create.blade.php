@extends('layouts.frontend')

@section('content')

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container container-fluid">

        

        <!--begin::Education-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            @include('frontend/includes/aside')
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">
                    <form action="{{route('store.member')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!--Begin::Header-->
                        <div class="card-header">

                            @include('includes.common.error')
                            @include('flash::message')

                            <div class="card-title">
                                <h3 class="card-label">Add Member</h3>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--Begin::Body-->
                        <div class="card-body">                
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Full Name</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">

                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Full Name"/>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">DOB</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <div class="input-group date">
                                                <input type="text" name="dob" value="{{ old('dob') }}" class="form-control kt_datepicker" placeholder="Enter DOB" autocomplete="new dob" readonly/>
                                                @error('dob')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Contact</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" oninput="this.value=this.value.replace(/[^0-9]/, '')" name="contact" value="{{ old('contact') }}" class="form-control" minlength="10" maxlength="10" placeholder="Enter Contact"/>
                                            @error('contact')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Email</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email"/>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Status:</label>
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
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 text-center">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a class="btn btn-light-danger" href="{{ route('dashboard') }}">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Education-->
    </div>
    <!--end::Container-->
</div>
@endsection
