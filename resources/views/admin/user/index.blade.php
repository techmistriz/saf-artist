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
							<h3 class="card-label">List Of {{$moduleConfig['moduleTitle']}} 
							<span class="d-block text-muted pt-2 font-size-sm">  </span></h3>
						</div>
						<div class="card-toolbar">
                            <!--begin::Dropdown-->
                            <form action="{{ route('admin.user.export') }}" method="POST" style="display: flex;">
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

				var url 			= '{!! route($moduleConfig['routes']['fetchDataRoute']) !!}';
				var columnsArray 	=	[
		            
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
		                title: "User Type",
		                template: function (t) {
		                    var artistType = (t.frontend_role && t.frontend_role.name) ? t.frontend_role.name : 'N/A';
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
		                width: 130,
		            },
		            {
		                field: "name",
		                title: "name",
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
		                field: "is_freeze",
		                title: "freeze Status",
		                template: function(t) {
		                    var FREEZE_STATUS = {
		                    	0: {
		                            'title': 'Free',
		                            'class': ' label-light-info'
		                        },
		                        1: {
		                            'title': 'Freezed',
		                            'class': ' label-light-danger'
		                        }
		                    };
		                    return '<span onclick="return onFreezePress(this, '+t?.id+')" class="cursor-pointer label font-weight-bold label-lg ' + FREEZE_STATUS[t?.is_freeze].class + ' label-inline">' + FREEZE_STATUS[t?.is_freeze].title + '</span>';
		                },
		            },		
		            {
		                field: "actions",
		                title: "action",
		                sortable: false,
		            },	
		        ];
			    var table_id	=	'kt_datatable';
			    const t = KTDatatableRemoteAjaxDemo.init(url, columnsArray,  table_id,	null);

			    $(".search_text").on("change", function() {
		    		
		    		t.search($(this).val().toLowerCase(),'search');
		    		
			    });

			    $(".refresh_all").on("click", function() {
		    		window.location.reload();

		    	});

			}));

		</script>

		<script type="text/javascript">
			
			function onFreezePress(_this, id){

				if(confirm('Are you sure you want to change freeze status?')){

		            var route                   = '{{ route("admin.user.update.freeze.status", ["id" => "randomString"])}}';
		            finalRoute                  = route.replace('randomString', id);
		            window.location.href        = finalRoute;
				} else {
					return false;
				}
			}

		</script>
	@endpush