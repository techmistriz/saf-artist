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
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            <form action="{{ route('admin.artist_member.export') }}" method="POST" style="display: flex;">
                                @csrf()
                                <div class="side-select" style="width: 250px">
                                    <select name="individual_ids[]" class="form-control selectpicker" data-actions-box="true" multiple="">
                                        @foreach($individuals as $key => $val)
                                            <option value="{{ $val->id}}"> 
                                                {{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="side-select" style="width: 250px">
                                    <select name="category_ids[]" class="form-control selectpicker" data-actions-box="true" multiple="">
                                        @foreach($disciplines as $key => $val)
                                            <option value="{{ $val->id}}"> 
                                                {{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-light-info font-weight-bold ml-2"> Export</button>
                            </form>
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
                template: function(t, i, o) {

                    var index = i + 1;
                    var page = o?.API?.params?.pagination?.page;
                    var perpage = o?.API?.params?.pagination?.perpage;
                    var offset = (page - 1) * perpage;

                    return (index + offset);
                }
            },            
            {
                field: "frontend_role_id",
                title: "Artist Type",
                template: function (t) {
                    var artistType = (t.frontend_role && t.frontend_role.name) ? t.frontend_role.name : 'N/A';  // Added a check for t.frontend_role
                    var artistTypeClass = '';

                    if (artistType === 'Individual') {
                        artistTypeClass = 'label-primary';
                    } else if (artistType === 'N/A') {
                        artistTypeClass = 'label-danger';
                    } else {
                        artistTypeClass = 'label-success';
                    }

                    return '<span class="label font-weight-bold label-lg ' + artistTypeClass + ' label-inline">' + artistType + '</span>';
                },
            },
            {
                field: "poc_id",
                title: "Parent",
                template: function(t) {
                    return ( typeof t?.poc?.name != 'undefined' && t?.poc?.name)? t?.poc?.name : 'N/A';
                }
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