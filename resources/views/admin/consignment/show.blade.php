@extends('layouts.app')
@section('title', 'All Consignment')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Parcel Info</h4>
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

                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('failed') }}</p>
                    @endif
                    <h4 class="card-title">Parcels</h4>
                    <p class="card-title-desc">
                    </p>

                    <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">

                                <table class="table mb-0">

                                    <thead>
                                    <tr role="row">
                                        <th>Invoice No</th>
                                        <th>COD</th>
                                        <th>D.Chrage</th>
                                        <th>Amount</th>
                                        <th>Same Day</th>
                                        <th>D. Date</th>
                                        <th>Deliveryman</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>P. Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @php($i=1)
                                    @foreach($results as $res)


                                        <tr role="row" class="odd">

                                            <th>#{{$res->parcel_invoice}}</th>
                                            {{--                                <td>{{$res->parcel_type_id}}</td>--}}
                                            <td>{{$res->cod}}</td>
                                            <td>{{$res->delivery_charge}}</td>
                                            <td>{{$res->total_amount}}</td>
                                            <td>
                                                @if($res->is_same_day==0)
                                                    <span class="badge badge-pill badge-info">Yes</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">No</span>

                                                @endif
                                            </td>
                                            <td>
                                                @if($res->is_same_day==0)
                                                    Today
                                                @else
                                                    {{$res->delivery_date}}

                                                @endif

                                            </td>
                                            <td>


                                                @if($res->delivery_man_id==null)
                                                    <div class="col-sm-6 col-md-3">
                                                        <div class="text-center">
                                                            <!-- Small modal -->
                                                            <button type="button"
                                                                    class="btn btn-primary waves-effect waves-light"
                                                                    data-toggle="modal"
                                                                    data-target=".bs-example-modal-sm">Assign
                                                            </button>
                                                        </div>

                                                        <div class="modal fade bs-example-modal-sm" tabindex="-1"
                                                             role="dialog" aria-labelledby="mySmallModalLabel"
                                                             style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title mt-0"
                                                                            id="mySmallModalLabel">Delivery Man Name</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-hidden="true">
                                                                            ×
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
{{--                                                                        @foreach($delivery_mans as $res)--}}
{{--                                                                            <a href="#">   {{$res->delivery_man_name}}</a>--}}
{{--                                                                        @endforeach--}}

                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                    </div>
                                                @else
                                                    {{$res->delivery_man_name}}
                                                @endif

                                            </td>


                                            <td>{{$res->customer_name}}</td>
                                            <td>{{$res->customer_phone}}</td>
                                            <td>{{$res->customer_address}}</td>
                                            <td>
                                                @if($res->delivery_status=="pending")
                                                    <span class="badge badge-pill badge-primary">Pending</span>
                                                @elseif($res->is_paid_to_merchant=="accepted")
                                                    <span class="badge badge-pill badge-secondary"> Accepted</span>
                                                @elseif($res->is_paid_to_merchant=="cancelled")
                                                    <span class="badge badge-pill badge-danger"> Cancelled</span>
                                                @elseif($res->is_paid_to_merchant=="on_the-way")
                                                    <span class="badge badge-pill badge-info"> On The Way</span>
                                                @elseif($res->is_paid_to_merchant=="delivered")
                                                    <span class="badge badge-pill badge-success"> Delivered</span>
                                                @elseif($res->is_paid_to_merchant=="returned")
                                                    <span class="badge badge-pill badge-warning"> Returned</span>

                                                @endif
                                            </td>
                                            <td>
                                                @if($res->is_paid_to_merchant=="pending")
                                                    <span class="badge badge-pill badge-danger">Pending</span>
                                                @elseif($res->is_paid_to_merchant=="requested")
                                                    <span class="badge badge-pill badge-warning"> Requested</span>
                                                @elseif($res->is_paid_to_merchant=="received")
                                                    <span class="badge badge-pill badge-success"> Received</span>

                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group mr-1 mt-2">
                                                    <button type="button" class="btn btn-info btn-sm">Info</button>
                                                    <button type="button"
                                                            class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu" style="">
                                                        <a class="dropdown-item"
                                                           href="/merchant/parcel/edit/{{$res->parcel_id}}">Edit</a>
                                                        <a class="dropdown-item"
                                                           href="/merchant/parcel/delete/{{$res->parcel_id}}">Delete</a>
                                                        <a class="dropdown-item"
                                                           href="/merchant/parcel/details/{{$res->parcel_id}}">Details</a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
