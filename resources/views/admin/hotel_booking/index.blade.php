@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">{{$moduleConfig['moduleTitle']}} 
                            <span class="d-block text-muted pt-2 font-size-sm">  </span></h3>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        
                        @include('flash::message')
                        
                        <!--begin: Search Form-->
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-icon">
                                            <input type="text" class="form-control search_text" name="search_text" placeholder="Search" value="">
                                            <span>
                                                <i class="flaticon2-search-1 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0)" class="btn btn-primary search_bttn">
                                        Search
                                    </a>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-default refresh_all">
                                        <i class="flaticon-refresh text-danger"></i>
                                    </button>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-3">
                                    <div class="form-group row validated">
                                        <select id="profile_id" class="form-control selectpicker" onchange="filterUsers(this)">
                                            <option>Select User Profile</option>
                                            @if($userProfiles->count())
                                                @foreach($userProfiles as $value)
                                                    <option value="{{$value->id}}" {{ old('profile_id', request('profile_id') ?? 0) == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Search Form-->
                        <!--begin: Datatable-->
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                            
                        </div>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script type="text/javascript">

    jQuery(document).ready((function(){

        var profile_id = {{ request('profile_id', 0)}};
        var url = '{!! route($moduleConfig["routes"]["fetchDataRoute"]) !!}' + '?profile_id=' + profile_id;

        var columnsArray    =   [
                
            {
                field: 'id',
                title: '#',
                // sortable: 'asc',
                width: 30,
                type: 'number',
                selector: false,
                textAlign: 'center',
            },
            {
                field: "profile_id",
                title: "Festival",
                template: function(t) {
                    var festival = typeof t?.user_profile?.festival?.name != 'undefined' && t?.user_profile?.festival?.name ? `<b>${t?.user_profile?.festival?.name}</b>` : 'N/A';

                    var year = typeof t?.user_profile?.project_year != 'undefined' && t?.user_profile?.project_year ? t?.user_profile?.project_year : 'N/A';
                    
                    return festival + ' (' + year + ')';
                }
            },
            {
                field: "accomodation",
                title: "accomodation",
            },  
            {
                field: "check_in_date",
                title: "check in date",
            },  
            {
                field: "check_out_date",
                title: "check out date",
            },
            {
                field: "user_profile_status",
                title: "User Profile Status",
                sortable: false,
                template: getStatusTemplate('user_profile_status'),
            },
            {
                field: "banking_status",
                title: "Banking Status",
                sortable: false,
                template: getStatusTemplate('banking_status'),
            },
            {
                field: "ticket_status",
                title: "Ticket Status",
                template: getStatusTemplate('ticket_status'),
            },
            {
                field: "hotel_status",
                title: "Hotel Status",
                sortable: false,
                template: function(t) {
                    return getStatusTemplate('hotel_status')(t);
                },
            },   
            {
                field: "actions",
                title: "actions",
                sortable: false,
            }, 
        ];
        var table_id    =   'kt_datatable';
        const t = KTDatatableRemoteAjaxDemo.init(url, columnsArray,  table_id,  null);

        $(".search_text").on("change", function() {
            
            t.search($(this).val().toLowerCase(),'search');
            
        });

        $(".refresh_all").on("click", function() {
            window.location.reload();

        });

    }));

    function getStatusTemplate(statusField) {
        var status_map = {
            1: {
                'icon': 'fa fa-times text-danger'
            },
            2: {
                'icon': 'fa fa-eye text-warning'
            },
            3: {
                'icon': 'fa fa-check text-success'
            }
        };

        return function(t) {
            var status = t[statusField];
            if (status_map[status]) {
                return '<span class="icon-style"><i class="' + status_map[status].icon + '"></i></span>';
            } else {
                return '<span class="icon-style"><i class="fa fa-question-circle"></i></span>';
            }
        };
    }

    function filterUsers(__this) {
        var profile_id = __this.value;
        window.location.href = "?profile_id=" + profile_id;
    }

</script>
@endpush