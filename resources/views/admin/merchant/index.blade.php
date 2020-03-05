@extends('layouts.app')
@section('title', 'Merchant Create')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Merchants</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Merchant Table</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('failed') }}</p>
                    @endif


                    <h4 class="card-title">
                        Merchant List</h4>

                    <table id="" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>COD</th>
                            <th>COD Charge</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>


                        <tbody>
                        @php($i=1)
                        @foreach($results as $res)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$res->merchant_name}}</td>
                                <td>{{$res->merchant_phone}}</td>
                                <td>{{$res->merchant_email}}</td>

                                <td>
                                    @if($res->is_cod_enable)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-warning">No</span>
                                    @endif
                                </td>


                                <td>{{$res->cod_charge}}</td>

                                <td>
                                    @if($res->active_status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>

                                    <div class="btn-group mr-1 mt-2">
                                        <button type="button" class="btn btn-info btn-sm">Action</button>
                                        <button type="button"
                                                class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/admin/merchant/edit/{{$res->merchant_id}}">Edit</a>
                                            <a class="dropdown-item" href="/admin/merchant/profile/{{$res->merchant_id}}">Profile</a>
                                            @if($res->active_status)
                                                <a class="dropdown-item" href="/admin/merchant/inactive/{{$res->merchant_id}}">Inactive</a>
                                            @else
                                                <a class="dropdown-item" href="/admin/merchant/activate/{{$res->merchant_id}}">Activate</a>
                                            @endif
                                        </div>
                                    </div>


                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
