@extends('layouts.merchant')
@section('title', 'Shop View')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Shop</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop Table</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Shop Datatable</h4>
                    <a href="/merchant/shop/create" type="button" class="btn btn-success float-right"> +new</a>
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
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <tr>
                            @php($i=1)
                            @foreach($result as $res)

                                <td>{{$i++}}</td>
                                <td>{{$res->shop_name}}</td>
                                <td>{{$res->shop_phone}}</td>
                                <td>{{$res->shop_address}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="/merchant/shop/edit/{{$res->shop_id}}">Edit</a>
                                            <a class="dropdown-item" href="/merchant/shop/delete/{{$res->shop_id}}">Delete</a>

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
