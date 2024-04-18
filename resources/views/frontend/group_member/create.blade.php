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

                    @include('includes.common.error')
                        
                    <form action="{{ route('store.group.member') }}" method="POST" enctype="multipart/form-data">

                     	{{ csrf_field() }}
                        @include('frontend.group_member.forms.form')

                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
