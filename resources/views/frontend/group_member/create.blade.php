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
                        <input type="hidden" name="profile_id" value="{{ request('profile_id') }}" >

                     	{{ csrf_field() }}
                        @include('frontend.group_member.forms.form')

                    </form>

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog" style="margin: 0; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <div class="modal-content">

                                <form method="POST" action="{{ route('group.members.import') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Import member</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <input type="file" name="file" accept=".csv, .pdf, .xlsx, .xls" class="btn btn-secondary">

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-success" >Import member</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
