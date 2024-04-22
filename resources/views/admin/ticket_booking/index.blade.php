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
                        <!-- <div class="card-toolbar">
                            <a href="{{ route($moduleConfig['routes']['createRoute']) }}" class="btn btn-light-primary font-weight-bold ml-2"> + Add</a>
                        </div> -->
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

    jQuery(document).ready((function() {

        var url             = '{!! route($moduleConfig['routes']['fetchDataRoute']) !!}';
        var columnsArray    =   [
                
            {
                field: 'id',
                title: '#',
                sortable: 'asc',
                width: 30,
                type: 'number',
                selector: false,
                textAlign: 'center',
            },            
            {
                field: "source_id",
                title: "Member",
                template: function (t) {
                    var memberName = (typeof t?.member?.name !== 'undefined' && t?.member?.name) ? t?.member?.name : 'N/A';
                    var member_class = (t?.member?.poc_id === null) ? 'label-success' : 'label-primary';

                    return '<span class="label font-weight-bold label-lg ' + member_class + ' label-inline">' + memberName + '</span>';
                },
            },
            {
                field: "name",
                title: "Name",
            },  
            {
                field: "email",
                title: "Email",
            },  
            {
                field: "contact",
                title: "Contact",
            },
            {
                field: "ticket_status",
                title: "Ticket Status",
                template: function(t) {
                    var ticket_status = {
                        0: {
                            'title': 'Added by Group',
                            'class': ' label-light-warning'
                        },
                        1: {
                            'title': 'Added by Admin',
                            'class': ' label-light-success'
                        },                        
                        2: {
                            'title': 'COMPLETED',
                            'class': ' label-light-danger'
                        },
                        3: {
                            'title': 'CANCELLED',
                            'class': ' label-danger'
                        }
                        
                    };
                    return '<span class="label font-weight-bold label-lg ' + ticket_status[t?.ticket_status].class + ' label-inline">' + ticket_status[t?.ticket_status].title + '</span>';
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

    </script>
@endpush