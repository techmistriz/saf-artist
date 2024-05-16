@extends('layouts.frontend')

@section('content')
<style type="text/css">
    .radio {
        display: -webkit-box;
    }

    .image-input {
        margin-right: 10px;
    }

    .bootstrap-select>.dropdown-toggle.btn-light, .bootstrap-select>.dropdown-toggle.btn-secondary {
        height: calc(1.5em + 1.65rem + 2px);
        padding: 0.825rem 1.42rem;
        font-size: 1.08rem;
        line-height: 1.5;
        border-radius: 0.42rem;
        background-color: #f3f6f9 !important;
        border-color: #f3f6f9 !important;
    }    

    /*.form-group .form-control{
        width: 100%;
    }*/
    

</style>

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container container-fluid">        

        <!--begin::Education-->
        <div class="d-flex flex-row">
            @include('frontend/includes/aside')
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">

                    @include('includes.common.error')
                        
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">

                     	{{ csrf_field() }}
                        @include('frontend.user.forms.form')

                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
