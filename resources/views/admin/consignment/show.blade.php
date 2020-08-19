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
            @include('includes.message')
            <div class="card">
                <div class="card-body">

                    <div class="row mb-3">
                        {{-- <div class="col-md-1">
                             <h4 class="card-title">Parcels</h4>
                         </div>--}}
                        <div class="col-md-1">
                            <form method="post" action="/same-day/serach">
                                <button class="btn btn-sm  btn-primary waves-effect waves-light">Same Day</button>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                            </form>
                        </div>
                        <div class="col-md-1">
                            <form method="post" action="/next-day/serach">
                                <button class="btn btn-sm  btn-success waves-effect waves-light">Next Day</button>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </form>

                        </div>
                        <div class="col-md-3">
                            <form class="form-inline" method="post" action="/invoice/serach">
                                <div class="form-group mx-sm-3 ">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="text" class="form-control" id="inputPassword2" name="invoice"
                                           placeholder="Invoice">
                                    <button type="submit" class="btn btn-info form-group ml-2">Search</button>

                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form class="form-inline" method="post" action="/area/serach">
                                <div class="form-group mx-sm-3 ">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <select class="form-control" name="area_id">
                                        @foreach($areas as $area)
                                            <option value="{{$area->area_id}}">{{$area->area_name}}</option>
                                        @endforeach

                                    </select>
                                    <button type="submit" class="btn btn-info form-group ml-2">Search</button>

                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form class="form-inline" method="post" action="/status/serach">
                                <div class="form-group mx-sm-3 ">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <select class="form-control" name="status">
                                        <option value="pending">pending</option>
                                        <option value="pickup_man_assigned">pickup_man_assigned</option>
                                        <option value="accepted">accepted</option>
                                        <option value="delivery_man_assigned">delivery_man_assigned</option>
                                        <option value="on_the_way">on_the_way</option>
                                        <option value="delivered">delivered</option>
                                        <option value="returned">returned</option>
                                        <option value="partial_delivered">partial_delivered</option>
                                        <option value="returned_to_admin">returned_to_admin</option>

                                    </select>
                                    <button type="submit" class="btn btn-info form-group ml-2">Search</button>

                                </div>
                            </form>
                        </div>

                    </div>

                    <form method="post" action="/multiple-parcel/deliveryman-assign">
                        <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"
                             style='overflow-x:auto'>
                            <div class="row">
                                <div class="col-sm-12">

                                    <table class="table mb-0 table-bordered">

                                        <thead>
                                        <tr>
                                            <th><input class="ml-1" type="checkbox" onclick="toggle(this);"/><br/></th>
                                            <th>Invoice No</th>
                                            {{-- <th>D.Chrage</th>--}}
                                            <th>Amount</th>
                                            <th>Receivable Amount</th>
                                            <th>Same Day</th>
                                            <th>DeliveryDate</th>
                                            <th>Pickup Man</th>
                                            <th>Deliveryman</th>
                                            <th>Hub Receiver</th>

                                            <td>Area</td>
                                            <th>Status</th>
                                            <th>P. Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @php($i=1)
                                        @foreach($results as $res)


                                            <tr>
                                                <td><input type="checkbox" name="parcel_id[]"
                                                           value="{{$res->parcel_id}}"></td>

                                                <td>{{$res->parcel_invoice}}</td>
                                              {{--  <td>{{$res->parcel_type_id}}</td>--}}
                                               {{-- <td>{{$res->delivery_charge}}</td>--}}
                                                <td>{{$res->total_amount}}

                                                    {{$res->payable_amount}}+{{$res->delivery_charge}}+{{$res->cod}}
                                                    +{{$res->area_charge}}

                                                </td>
                                                <td>{{$res->receivable_amount}}</td>
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
                                                        {{getDateFormat(getDateFromParcelId($res->parcel_id))}}

                                                    @endif

                                                </td>

                                                <td>

                                                    @if($res->order_pickup_man_id==null)

                                                        Not Assigned

                                                    @else
                                                        {{getDeliveryManNameFromId($res->order_pickup_man_id)}}
                                                    @endif

                                                </td>


                                                <td>
                                                    @if($res->delivery_man_id==null)
                                                        Not Assigned
                                                    @else
                                                        {{$res->delivery_man_name}}
                                                    @endif


                                                </td>

                                                <td>{{getUserNameFromId($res->hub_receiver)}}</td>

                                                <td>{{$res->area_name}}</td>
                                              {{--  <td>{{$res->area_name}}</td>--}}
                                                <td>


                                                    @if($res->delivery_status=="pending")
                                                        <span class="badge badge-pill badge-primary">Pending</span>
                                                    @elseif($res->delivery_status=="accepted")
                                                        <span class="badge badge-pill badge-secondary"> Accepted</span>
                                                    @elseif($res->delivery_status=="cancelled")
                                                        <span class="badge badge-pill badge-danger"> Cancelled</span>
                                                    @elseif($res->delivery_status=="on_the_way")
                                                        <span class="badge badge-pill badge-info"> On The Way</span>
                                                    @elseif($res->delivery_status=="delivered")
                                                        <span class="badge badge-pill badge-success"> Delivered</span>
                                                    @elseif($res->delivery_status=="returned")
                                                        <span class="badge badge-pill badge-warning"> Returned</span>
                                                    @else

                                                        <span class="badge badge-pill badge-warning"> {{$res->delivery_status}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($res->is_paid_to_merchant=="pending")
                                                        <span class="badge badge-pill badge-danger">Pending</span>
                                                    @elseif($res->is_paid_to_merchant=="requested")
                                                        <span class="badge badge-pill badge-warning"> Requested</span>
                                                    @elseif($res->is_paid_to_merchant=="received")
                                                        <span class="badge badge-pill badge-success"> Paid</span>

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
                                                               href="/admin/parcel/details/{{$res->parcel_id}}">Details</a>

                                                            @if($res->delivery_status=="accepted")
                                                                <a class="dropdown-item"
                                                                   href="/admin/parcel/status-change/{{$res->parcel_id}}">Hub
                                                                    Received</a>

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


                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <button name="change" class="btn btn-danger float-right waves-effect waves-light mr-1" value="2"
                                type="submit" onclick="return confirm('are you sure?')">DeliveryMan Assign
                        </button>
                        <button name="change" class="btn btn-primary float-right waves-effect waves-light mr-1"
                                value="1" type="submit" onclick="return confirm('are you sure?')">PickupMan Assign
                        </button>


                    </form>
                </div>
                {{ $results->links() }}
            </div>

        </div> <!-- end col -->

    </div>

@endsection
