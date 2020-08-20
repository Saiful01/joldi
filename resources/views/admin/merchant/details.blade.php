@extends('layouts.app')
@section('title', 'All Consignment')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Merchant Parcel</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Parcel </a></li>
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
                        <form class="form-inline" method="post" action="/admin/merchant/details/{{$id}}">
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


                    <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"
                         style='overflow-x:auto'>
                        <div class="row">
                            <div class="col-sm-12">

                                <table class="table mb-0 table-bordered">

                                    <thead>
                                    <tr>

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
                                    @php($total_partial_receivable=0)
                                    @foreach($results as $res)


                                        <?php

                                        $status = $res->delivery_status;
                                        //If partial deliver
                                        $total_partial_receivable = $res->total_amount - $res->received_amount;

                                        ?>



                                        <tr>

                                            <td>{{$res->parcel_invoice}}</td>
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

                                                    <span class="badge-pill bg-primary text-white">Not Assigned</span>

                                                @else
                                                    {{getDeliveryManNameFromId($res->order_pickup_man_id)}}
                                                @endif

                                            </td>


                                            <td>
                                                @if($res->delivery_man_id==null)
                                                    <span class="badge-pill bg-primary text-white">Not Assigned</span>
                                                @else
                                                    {{$res->delivery_man_name}}
                                                @endif


                                            </td>

                                            <td>{{getUserNameFromId($res->hub_receiver)}}</td>

                                            <td>{{$res->area_name}}</td>
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
                                                @elseif($res->delivery_status=="returned_to_admin")
                                                    <span class="badge badge-pill badge-success"> Returned To Admin</span>
                                                @elseif($res->delivery_status=="partial_delivered")
                                                    <span class="badge badge-pill badge-warning"> Partial Deliver</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">{{getFormattedStatus($res->delivery_status)}}</span>
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
                                                               href="/admin/parcel/status-hub-receive/{{$res->parcel_id}}">Hub
                                                                Received</a>

                                                        @endif

                                                        @if($res->delivery_status=="partial_delivered")
                                                            <a class="dropdown-item"
                                                               href="/admin/parcel/return-to-admin/{{$res->parcel_id}}">Return
                                                                to Admin</a>
                                                        @endif

                                                        @if($res->delivery_status=="returned_to_admin")
                                                            <a class="dropdown-item"
                                                               href="/admin/parcel/resolve-merchant-return/{{$res->parcel_id}}">Resolve
                                                                Merchant Return</a>
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


                    @if(isset($status))
                        @if($status=="partial_delivered")

                            <p>Receivable Amount: {{$total_partial_receivable}}</p>
                        @endif
                    @endif
                </div>
                {{ $results->links() }}
            </div>

        </div> <!-- end col -->

    </div>

@endsection