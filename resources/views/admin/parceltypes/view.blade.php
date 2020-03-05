@extends('layouts.app')
@section('title', 'ParcelTypes View')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Parcel types</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Parcel types Table</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Parcel types Datatable</h4>
                    <a href="/admin/parceltypes/create" type="button" class="btn btn-success float-right"> +new</a>
                    {{--                    <p class="card-title-desc">DataTables has most features enabled by--}}
                    {{--                        default, so all you need to do to use it with your own tables is to call--}}
                    {{--                        the construction function: <code>$().DataTable();</code>.--}}
                    {{--                    </p>--}}

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> Parcel types Name</th>
                            <th>Chrage</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <tr>
                            @php($i=1)
                            @foreach($result as $res)

                                <td>{{$i++}}</td>
                                <td>{{$res->title}}</td>
                                <td>{{$res->charge}}</td>
                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button type="button" class="btn btn-info btn-sm">Action</button>
                                        <button type="button"
                                                class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/admin/parceltypes/edit/{{$res->parcel_type_id}}">Edit</a>
                                            <a class="dropdown-item" href="/admin/parceltypes/delete/{{$res->parcel_type_id}}">Delete</a>
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
