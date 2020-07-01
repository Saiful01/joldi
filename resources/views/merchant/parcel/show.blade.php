@extends('layouts.merchant')
@section('title', 'Parcel View')

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
                        <div class="row mb-3">
                             <div class="col-md-2">
                                 <h4 class="card-title">Parcels</h4>
                             </div>
                            <div class="col-md-2">
                                <form method="post" action="/merchant/same-day/serach" >
                                    <button class="btn  btn-primary waves-effect waves-light">Same Day</button>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                </form>
                            </div>
                            <div class="col-md-2">
                                <form method="post" action="/merchant/next-day/serach" >
                                    <button class="btn  btn-success waves-effect waves-light">Next Day</button>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                </form>

                            </div>
                            <div class="col-md-4">
                                <form class="form-inline" method="post" action="/merchant/invoice/serach">
                                    <div class="form-group mx-sm-3 ">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="text" class="form-control" id="inputPassword2" name="invoice" placeholder="Invoice">
                                        <button type="submit" class="btn btn-info form-group ml-2">Search</button>

                                    </div>
                                </form>
                            </div>
                            {{--<div class="col-md-4">
                                <form class="form-inline" method="post" action="/area/serach">
                                    <div class="form-group mx-sm-3 ">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <select  class="form-control"  name="area_id" >
                                            @foreach($areas as $area)
                                                <option value="{{$area->area_id}}">{{$area->area_name}}</option>
                                            @endforeach

                                        </select>
                                        <button type="submit" class="btn btn-info form-group ml-2">Search</button>

                                    </div>
                                </form>
                            </div>--}}

                        </div>
                        <form method="post" action="/parcel-all/change">
                            <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <table class="table mb-0">

                                            <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>Invoice No</th>
                                                {{--  <th>COD</th>--}}
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

                                                    <td><input  type="checkbox" name="parcel_id[]"
                                                                value="{{$res->parcel_id}}"></td>
                                                    <td>#{{$res->parcel_invoice}}</td>
                                                    {{--                                <td>{{$res->parcel_type_id}}</td>--}}
                                                    {{--   <td>{{$res->cod}}</td>--}}
                                                    <td>{{$res->delivery_charge}}</td>
                                                    <td>{{$res->total_amount}}</td>
                                                    <td>
                                                        @if($res->is_same_day==true)
                                                            <span class="badge badge-pill badge-info">Yes</span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger">No</span>

                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($res->is_same_day==true)
                                                            Today
                                                        @else
                                                            {{$res->delivery_date}}

                                                        @endif

                                                    </td>
                                                    <td>{{$res->customer_name}}</td>
                                                    <td>{{$res->customer_phone}}</td>
                                                    <td>{{$res->customer_address}}</td>
                                                    <td>
                                                        @if($res->delivery_status=="pending")
                                                            <span class="badge badge-pill badge-primary">Pending</span>
                                                        @elseif($res->delivery_status=="accepted")
                                                            <span class="badge badge-pill badge-success"> Accepted</span>
                                                        @elseif($res->delivery_status=="cancelled")
                                                            <span class="badge badge-pill badge-danger"> Cancelled</span>
                                                        @elseif($res->delivery_status=="on_the-way")
                                                            <span class="badge badge-pill badge-info"> On The Way</span>
                                                        @elseif($res->delivery_status=="delivered")
                                                            <span class="badge badge-pill badge-success"> Delivered</span>
                                                        @elseif($res->delivery_status=="returned")
                                                            <span class="badge badge-pill badge-warning"> Returned</span>
                                                        @else
                                                            <span class="badge badge-pill badge-warning"> {{statusFormat($res->delivery_status)}}</span>

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
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            {{--<button name="change" class="btn btn-primary float-right waves-effect waves-light mr-1"
                                    value="1" type="submit" onclick="return confirm('are you sure?')">Active
                            </button>--}}
                            <button name="change" class="btn btn-danger float-right waves-effect waves-light mr-1" value="2"
                                    type="submit" onclick="return confirm('are you sure?')">Delete
                            </button>


                        </form>


                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
