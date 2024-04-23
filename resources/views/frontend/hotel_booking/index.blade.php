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
        						<h3 class="card-label">Hotel Booking 
        						<span class="d-block text-muted pt-2 font-size-sm">  </span></h3>
        					</div>
        					<div class="card-toolbar">
        						<a href="{{ route('hotel.booking.create') }}" class="btn btn-light-primary font-weight-bold ml-2">Add Hotel</a>
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
</div>

@endsection

@push('scripts')
	 <script type="text/javascript">

        jQuery(document).ready((function() {

            var url             = '{!! route("fetch.hotel.booking.data") !!}';
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
                    field: "hotel_status",
                    title: "Hotel Status",
                    template: function(t) {
                        var hotel_status = {
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
                        return '<span class="label font-weight-bold label-lg ' + hotel_status[t?.hotel_status].class + ' label-inline">' + hotel_status[t?.hotel_status].title + '</span>';
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