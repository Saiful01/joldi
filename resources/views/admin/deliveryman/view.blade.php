@extends('layouts.app')
@section('title', 'Deliveryman View')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Delivery Man</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#"> Delivery man Table</a></li>
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
                        Delivery Man List</h4>
                        <a href="/admin/deliveryman/tarck" type="button" class="float-left btn btn-info">Deliveryman Location</a>
                        <a href="/admin/deliveryman/create" type="button" class="float-right btn btn-success">+new</a>
                        <form method="post" action="/deliveryman-all/change">
                            <table id="" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Active Status</th>
                                    <th>Action</th>

                                </tr>
                                </thead>


                                <tbody>
                                @php($i=1)
                                @foreach($result as $res)
                                    <tr>
                                        <td><input  type="checkbox" name="delivery_man_id[]"
                                                   value="{{$res->delivery_man_id}}"></td>
                                        <td>{{$res->delivery_man_name}}</td>
                                        <td>{{$res->delivery_man_phone}}</td>
                                        <td>{{$res->delivery_man_address}}</td>

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
                                                    <a class="dropdown-item" href="/admin/deliveryman/edit/{{$res->delivery_man_id}}">Edit</a>
                                                    <a class="dropdown-item" href="/admin/deliveryman/delete/{{$res->delivery_man_id}}">delete</a>
                                                    @if($res->active_status)
                                                        <a class="dropdown-item" href="/admin/deliveryman/inactive/{{$res->delivery_man_id}}">Inactive</a>
                                                    @else
                                                        <a class="dropdown-item" href="/admin/deliveryman/activate/{{$res->delivery_man_id}}">Activate</a>
                                                    @endif
                                                </div>
                                            </div>


                                        </td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button name="change" class="btn btn-primary float-right waves-effect waves-light mr-1"
                                    value="1" type="submit" onclick="return confirm('are you sure?')">Active
                            </button>
                            <button name="change" class="btn btn-danger float-right waves-effect waves-light mr-1" value="2"
                                    type="submit" onclick="return confirm('are you sure?')">Inactive
                            </button>


                        </form>




                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
