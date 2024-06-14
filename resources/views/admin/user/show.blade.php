@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Show {{$moduleConfig['moduleTitle']}}</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>User Type</th>
                                                <td colspan="4">{{ $row->frontendRole->name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Category</th>
                                                <td colspan="4">{{ $row->category->name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Artist Type</th>
                                                <td colspan="4">{{ $row->artistType->name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Name of Curators</th>
                                                <td colspan="4">{{ $row->curator_name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Full Name</th>
                                                <td colspan="4">{{$row->name}}</td>
                                            </tr>

                                            <tr>
                                                <th>Contact</th>
                                                <td colspan="4">{{$row->contact}}</td>
                                            </tr>

                                            <tr>
                                                <th>Email</th>
                                                <td colspan="4">{{$row->email}}</td>
                                            </tr>                                            

                                            <tr>
                                                <th>Status</th>
                                                <td colspan="4">{{ $row->status ? 'Active' : 'Inactive' }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
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