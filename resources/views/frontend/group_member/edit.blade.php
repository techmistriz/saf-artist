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
                        
                    <form action="{{ route('store.group.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$row->id}}">
                        <input type="hidden" name="profile_id" value="{{ $row->profile_id }}" >
                        {{ csrf_field() }}
                        @include('frontend.group_member.forms.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection