@extends('layouts.backend')

@section('content')
  
    
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

        	@if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @include('flash::message')
            
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-6 col-xxl-6">
                    <!--begin::Mixed Widget 1-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between flex-column h-100">
                                <!--begin::Container-->
                                <div class="h-100">
                                    <!--begin::Header-->
                                    <div class="d-flex flex-column flex-center">
                                        <!--begin::Title-->
                                        <a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-success font-size-h4 m-0 pt-7 pb-1">Backend Users</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="pt-1">
                                        @if($admins->count())
                                            @foreach($admins->unique('role.name') as $value)
                                                <div class="d-flex align-items-center pb-9">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 symbol-light-success mr-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon menu-icon">
                                                                <i class="flaticon2-avatar icon-2x"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1">
                                                        <a href="#" class="text-dark-75 text-hover-success mb-1 font-size-lg font-weight-bolder">{{$value->role->name}}</a>
                                                        <span class="text-muted font-weight-bold">Backend</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <!--begin::label-->
                                                    <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">{{ $admins->where('role.name', $value->role->name)->count() }}</span>
                                                    <!--end::label-->
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--eng::Container-->
                                
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 1-->
                </div>
                <div class="col-lg-6 col-xxl-6">
                    <!--begin::Mixed Widget 1-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between flex-column h-100">
                                <!--begin::Container-->
                                <div class="h-100">
                                    <!--begin::Header-->
                                    <div class="d-flex flex-column flex-center">
                                        <!--begin::Title-->
                                        <a href="#" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">Frontend Users</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="pt-1">
                                        @if($users->count())
                                            @foreach($users->unique('frontendRole.name') as $value)
                                                <div class="d-flex align-items-center pb-9">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 symbol-light-primary mr-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon menu-icon">
                                                                <i class="flaticon2-user icon-2x"></i> </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1">
                                                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{{ $value->frontendRole->name }} </a>
                                                        <span class="text-muted font-weight-bold">Frontend</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <!--begin::label-->
                                                    <span class="font-weight-bolder label label-xl label-light-primary label-inline px-3 py-5 min-w-45px">{{ $users->where('frontendRole.name', $value->frontendRole->name)->count() }}</span>
                                                    <!--end::label-->
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--eng::Container-->
                                
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 1-->
                </div>

            </div>
            <!--end::Row-->
            
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection

@push('scripts') 
<script type="text/javascript">

</script>

@endpush