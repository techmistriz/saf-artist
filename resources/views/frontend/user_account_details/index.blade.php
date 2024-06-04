@extends('layouts.frontend')

@section('content')

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container container-fluid">        

        <!--begin::Education-->
        <div class="d-flex flex-row">
            @include('frontend/includes/aside')
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">Banking Details 
                                <span class="d-block text-muted pt-2 font-size-sm">  </span></h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ route('user.account.details.create') }}" class="btn font-weight-bold ml-2" id="button">Add Banking Details</a>
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
                                    <!-- <div class="col-md-1">
                                        <button class="btn btn-default refresh_all">
                                            <i class="flaticon-refresh text-danger"></i>
                                        </button>
                                    </div> -->

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
</div>

@endsection

@push('scripts')
    <script type="text/javascript">

        jQuery(document).ready((function() {

            var url             = '{!! route("fetch.user.account.details.data") !!}';
            var columnsArray    =   [
                
                {
                    field: 'id',
                    title: '#',
                    // sortable: 'asc',
                    width: 30,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                    template: function(t, i, o) {

                        var index = i + 1;
                        var page = o?.API?.params?.pagination?.page;
                        var perpage = o?.API?.params?.pagination?.perpage;
                        var offset = (page - 1) * perpage;

                        return (index + offset);
                    }
                },
                {
                    field: "profile_id",
                    title: "Festival",
                    template: function(t) {
                        return ( typeof t?.profile?.festival?.name != 'undefined' && t?.profile?.festival?.name)? t?.profile?.festival?.name : 'N/A';
                    }
                },   
                {
                    field: "name",
                    title: "Name",
                }, 
                {
                    field: "status",
                    title: "status",
                    template: function(t) {
                        var status = {
                            0: {
                                'title': 'Inactive',
                                'class': ' label-light-danger'
                            },
                            1: {
                                'title': 'Active',
                                'class': ' label-light-success'
                            }
                            
                        };
                        return '<span class="label font-weight-bold label-lg ' + status[t?.status].class + ' label-inline">' + status[t?.status].title + '</span>';
                    },
                },      
                {
                    field: "frontend_actions",
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