@extends('layouts.merchantapp')
@section('title', 'Customer')

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

                                            <th>{{$res->parcel_invoice}}</th>
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
                                            <td>{{$res->customer_name}}</td>
                                            <td>{{$res->customer_phone}}</td>
                                            <td>{{$res->customer_address}}</td>
                                            <td>
                                                <span class="badge badge-pill badge-info">{{$res->delivery_status}}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-info">{{$res->is_paid_to_merchant}}</span>
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
                                                           href="/parcel/edit/{{$res->parcel_id}}">Edit</a>
                                                        <a class="dropdown-item"
                                                           href="/parcel/delete/{{$res->parcel_id}}">Delete</a>
                                                        <a class="dropdown-item"
                                                           href="/parcel/details/{{$res->parcel_id}}">Details</a>
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
