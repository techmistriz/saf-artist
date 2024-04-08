@extends('layouts.backend')

@section('content')


<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="row">
		    <div class="col-md-12">
		        
		        <div class="card card-custom gutter-b">
		            <div class="card-header">
		                <div class="card-title">
		                    <h3 class="card-label">Show {{$moduleConfig['moduleTitle']}} Category Details</h3>
		                </div>
		            </div>
		            
		            <div class="card-body">
		                <div class="row">
		                    
		                    <div class="col-12">
		                        
		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">project name: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-right">{{$row->project_name}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Organisation/ Foundation/ Trust you are associated with (if any): </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-right">{{$row->organisation}}</label>
		                            
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Name of the Artisan: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-right">{{ $row->name_of_the_artisan }}</label>
		                            	
		                            
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">About the Artisan: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-right">{{ $row->about_the_artisan }}</label>
		                            
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Name of the Design Studio: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-right">{{ $row->name_of_the_design_studio }}</label>
		                            
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">About the Design Studio: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-right">{{ $row->about_the_design_studio }}</label>
		                            
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">About the Crafts: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-right">{{ $row->about_the_crafts }}</label>
		                            
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">About the Director/Designers: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-right">{{ $row->about_the_director }}</label>
		                            
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Brand name: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-right">{{ $row->brand_name }}</label>
		                            
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Brand Logo: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
		                            		@if(isset($row->brand_logo) && !empty($row->brand_logo))
												<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->brand_logo)}})"></div>
		                            		@else
		                            			<div class="image-input-wrapper"></div>
		                            		@endif
										</div>
										<div class="">
											Uploaded File: 
			                                @if($row->brand_logo)
			                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->brand_logo) }}">{{$row->brand_logo}}</a>
			                            	@else
			                            	N/A
			                            	@endif
										</div>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">High res images of the Designers: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
			                            <div class="row">
				                            <div class="col-lg-4 col-md-4 col-sm-4">
				                            	<div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
				                            		@if(isset($row->high_res_images_of_the_designer_1) && !empty($row->high_res_images_of_the_designer_1))
														<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_designer_1)}})"></div>
				                            		@else
				                            			<div class="image-input-wrapper"></div>
				                            		@endif
												</div>
												<div class="">
													Uploaded File: 
					                                @if($row->high_res_images_of_the_designer_1)
					                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->high_res_images_of_the_designer_1) }}">{{$row->high_res_images_of_the_designer_1}}</a>
					                            	@else
					                            	N/A
					                            	@endif
												</div>
				                            </div>

				                            <div class="col-lg-4 col-md-4 col-sm-4">
				                            	<div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
				                            		@if(isset($row->high_res_images_of_the_designer_2) && !empty($row->high_res_images_of_the_designer_2))
														<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_designer_2)}})"></div>
				                            		@else
				                            			<div class="image-input-wrapper"></div>
				                            		@endif
												</div>
												<div class="">
													Uploaded File: 
					                                @if($row->high_res_images_of_the_designer_2)
					                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->high_res_images_of_the_designer_2) }}">{{$row->high_res_images_of_the_designer_2}}</a>
					                            	@else
					                            	N/A
					                            	@endif
												</div>
				                            </div>

				                            <div class="col-lg-4 col-md-4 col-sm-4">
				                            	<div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
				                            		@if(isset($row->high_res_images_of_the_designer_3) && !empty($row->high_res_images_of_the_designer_3))
														<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_designer_3)}})"></div>
				                            		@else
				                            			<div class="image-input-wrapper"></div>
				                            		@endif
												</div>
												<div class="">
													Uploaded File: 
					                                @if($row->high_res_images_of_the_designer_3)
					                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->high_res_images_of_the_designer_3) }}">{{$row->high_res_images_of_the_designer_3}}</a>
					                            	@else
					                            	N/A
					                            	@endif
												</div>
				                            </div>
			                            </div>
		                            </div>

		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">High res images of the Designers: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
			                            <div class="row">
				                            <div class="col-lg-4 col-md-4 col-sm-4">
				                            	<div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
				                            		@if(isset($row->high_res_images_of_the_product_1) && !empty($row->high_res_images_of_the_product_1))
														<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_product_1)}})"></div>
				                            		@else
				                            			<div class="image-input-wrapper"></div>
				                            		@endif
												</div>
												<div class="">
													Uploaded File: 
					                                @if($row->high_res_images_of_the_product_1)
					                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->high_res_images_of_the_product_1) }}">{{$row->high_res_images_of_the_product_1}}</a>
					                            	@else
					                            	N/A
					                            	@endif
												</div>
				                            </div>

				                            <div class="col-lg-4 col-md-4 col-sm-4">
				                            	<div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
				                            		@if(isset($row->high_res_images_of_the_product_2) && !empty($row->high_res_images_of_the_product_2))
														<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_product_2)}})"></div>
				                            		@else
				                            			<div class="image-input-wrapper"></div>
				                            		@endif
												</div>
												<div class="">
													Uploaded File: 
					                                @if($row->high_res_images_of_the_product_2)
					                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->high_res_images_of_the_product_2) }}">{{$row->high_res_images_of_the_product_2}}</a>
					                            	@else
					                            	N/A
					                            	@endif
												</div>
				                            </div>

				                            <div class="col-lg-4 col-md-4 col-sm-4">
				                            	<div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
				                            		@if(isset($row->high_res_images_of_the_product_3) && !empty($row->high_res_images_of_the_product_3))
														<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->high_res_images_of_the_product_3)}})"></div>
				                            		@else
				                            			<div class="image-input-wrapper"></div>
				                            		@endif
												</div>
												<div class="">
													Uploaded File: 
					                                @if($row->high_res_images_of_the_product_3)
					                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->high_res_images_of_the_product_3) }}">{{$row->high_res_images_of_the_product_3}}</a>
					                            	@else
					                            	N/A
					                            	@endif
												</div>
				                            </div>
			                            </div>
		                            </div>

		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Are you part of any other project: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-right">{{ $row->has_part_of_other_project }}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Category of the project: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-right">{{ $row->otherProjectCategory->name ?? 'N/A' }}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Name of the project: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-right">{{ $row->otherProject->name ?? 'N/A' }}</label>
		                            </div>
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