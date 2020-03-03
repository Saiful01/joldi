@extends('layouts.merchantapp')
@section('title', 'Customer')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Delivery Man</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Delivery Man Table</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Delivery Man Datatable</h4>
                    {{--                    <p class="card-title-desc">DataTables has most features enabled by--}}
                    {{--                        default, so all you need to do to use it with your own tables is to call--}}
                    {{--                        the construction function: <code>$().DataTable();</code>.--}}
                    {{--                    </p>--}}

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>phone</th>
                            <th>Password</th>
                            <th>Address</th>
                            <th>Active Status</th>
                        </tr>
                        </thead>


                        <tbody>
                        <tr>
                            @php($i=1)
                            @foreach($result as $res)

                                <td>{{$i++}}</td>
                                <td>{{$res->delivery_man_name}}</td>
                                <td>{{$res->delivery_man_phone}}</td>
                                <td>{{$res->delivery_man_password}}</td>
                                <td>{{$res->delivery_man_address}}</td>
                                <td>{{$res->active_status}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="/deliveryman/edit/{{$res->delivery_man_id}}">Edit</a>
                                            <a class="dropdown-item" href="/deliveryman/delete/{{$res->delivery_man_id}}">Delete</a>

                                        </div>
                                    </div>
                                </td>

                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
