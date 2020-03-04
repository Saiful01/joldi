@extends('layouts.app')
@section('title', 'Customer')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Parcel Information</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Parcel Table</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">
                        Parcel Datatable</h4>
                    {{--                    <p class="card-title-desc">DataTables has most features enabled by--}}
                    {{--                        default, so all you need to do to use it with your own tables is to call--}}
                    {{--                        the construction function: <code>$().DataTable();</code>.--}}
                    {{--                    </p>--}}

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice No</th>
                            <th>Parcel Types</th>
                            <th>COD</th>
                            <th>Delivery Chrage</th>
                            <th>Totall Amount</th>
                            <th>Same day</th>
                            <th>Delivery date</th>
                            <th>Customer Name</th>
                            <th>Customer phone</th>
                            <th>Customer Address</th>
                            <th>Note</th>
                            <th>Action</th>

                        </tr>
                        </thead>


                        <tbody>
                        @php($i=1)
                        @foreach($result as $res)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$res->parcel_invoice}}</td>
                                <td>{{$res->parcel_type_id}}</td>
                                <td>{{$res->cod}}</td>
                                <td>{{$res->delivery_charge}}</td>
                                <td>{{$res->total_amount}}</td>
                                <td>{{$res->is_same_day}}</td>
                                <td>{{$res->delivery_date}}</td>
                                <td>{{$res->customer_name}}</td>
                                <td>{{$res->customer_phone}}</td>
                                <td>{{$res->customer_address}}</td>
                                <td>{{$res->parcel_notes}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-info dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="/parcel/edit/{{$res->parcel_id}}">Edit</a>
                                            <a class="dropdown-item"
                                               href="/parcel/delete/{{$res->parcel_id}}">Delete</a>

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
