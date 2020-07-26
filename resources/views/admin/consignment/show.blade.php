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
                    <form method="post" action="/multiple-parcel/deliveryman-assign">
                        <table id="" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th><input class="ml-1" type="checkbox" onclick="toggle(this);" /><br />
                                </th>
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
                                    <td><input  type="checkbox" name="parcel_id[]"
                                                value="{{$res->parcel_id}}"></td>
                                    <td>{{$res->parcel_invoice}}</td>
                                    {{--                                <td>{{$res->parcel_type_id}}</td>--}}
                                    {{--     <td>{{$res->delivery_charge}}</td>--}}
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
                                            {{getDateFormat($res->delivery_date)}}

                                        @endif

                                    </td>

                                    <td>

                                        @if($res->order_pickup_man_id==null)
                                            <div class="col-sm-6 col-md-3">
                                                <div class="text-center">
                                                    <!-- Small modal -->
                                                    <button type="button"
                                                            class="btn btn-sm btn-primary waves-effect waves-light"
                                                            data-toggle="modal"
                                                            data-target=".modal-id{{$res->parcel_id}}">
                                                        Assign
                                                    </button>
                                                </div>

                                                <div class="modal fade modal-id{{$res->parcel_id}}"
                                                     tabindex="-1"
                                                     role="dialog" aria-labelledby="mySmallModalLabel"
                                                     style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-0"
                                                                    id="mySmallModalLabel">Assign
                                                                    Deliveryman</h5>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">
                                                                    ×
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form method="get"
                                                                      action="/admin/parcel/assign-pickup-man">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Select
                                                                            Deliveryman</label>

                                                                        <input name="_token"
                                                                               value="{{csrf_token()}}"
                                                                               type="hidden"/>
                                                                        <input name="parcel_id"
                                                                               value="{{$res->parcel_id}}"
                                                                               type="hidden"/>
                                                                        <select class="form-control select2"
                                                                                name="delivery_man_id">
                                                                            <option>Select</option>

                                                                            @foreach($delivery_mans as $delivery_man)
                                                                                <option
                                                                                    value="{{$delivery_man->delivery_man_id}}">{{$delivery_man->delivery_man_name}}</option>

                                                                            @endforeach

                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        {{--                                                                                <label class="control-label">Select Deliveryman</label>--}}
                                                                        <button type="submit"
                                                                                class="btn btn-block btn-primary btn-sm waves-effect waves-light float-right">
                                                                            Save
                                                                        </button>
                                                                    </div>


                                                                </form>


                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
                                        @else
                                            {{getDeliveryManNameFromId($res->order_pickup_man_id)}}
                                        @endif

                                    </td>


                                    <td>
                                        @if($res->delivery_man_id==null)
                                            <div class="col-sm-6 col-md-3">
                                                <div class="text-center">
                                                    <!-- Small modal -->
                                                    <button type="button"
                                                            class="btn btn-sm btn-primary waves-effect waves-light"
                                                            data-toggle="modal"
                                                            data-target=".modal-id{{$res->parcel_id}}">
                                                        Assign
                                                    </button>
                                                </div>

                                                <div class="modal fade modal-id{{$res->parcel_id}}"
                                                     tabindex="-1"
                                                     role="dialog" aria-labelledby="mySmallModalLabel"
                                                     style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-0"
                                                                    id="mySmallModalLabel">Assign
                                                                    Deliveryman</h5>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">
                                                                    ×
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form method="get"
                                                                      action="/admin/parcel/assign-deliveryman">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Select
                                                                            Deliveryman</label>

                                                                        <input name="_token"
                                                                               value="{{csrf_token()}}"
                                                                               type="hidden"/>
                                                                        <input name="parcel_id"
                                                                               value="{{$res->parcel_id}}"
                                                                               type="hidden"/>
                                                                        <select
                                                                            class="form-control select2"
                                                                            name="delivery_man_id">
                                                                            <option>Select</option>

                                                                            @foreach($delivery_mans as $delivery_man)
                                                                                <option
                                                                                    value="{{$delivery_man->delivery_man_id}}">{{$delivery_man->delivery_man_name}}</option>

                                                                            @endforeach

                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        {{--                                                                                <label class="control-label">Select Deliveryman</label>--}}
                                                                        <button type="submit"
                                                                                class="btn btn-block btn-primary btn-sm waves-effect waves-light float-right">
                                                                            Save
                                                                        </button>
                                                                    </div>


                                                                </form>


                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
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
                                            <button type="button" class="btn btn-primary"
                                                    data-toggle="modal"
                                                    data-target=".receive-modal{{$res->parcel_id}}">Receive
                                            </button>
                                            <div class="modal fade receive-modal{{$res->parcel_id}}"
                                                 tabindex="-1"
                                                 role="dialog" aria-labelledby="mySmallModalLabel"
                                                 style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0"
                                                                id="mySmallModalLabel">Receive Product</h5>
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal" aria-hidden="true">
                                                                ×
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form method="get"
                                                                  action="/admin/parcel/receive-by-admin">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">Notes</label>

                                                                    <input name="_token"
                                                                           value="{{csrf_token()}}"
                                                                           type="hidden"/>
                                                                    <input name="parcel_id"
                                                                           value="{{$res->parcel_id}}"
                                                                           type="hidden"/>


                                                                    <textarea class="form-control"
                                                                              name="notes"></textarea>

                                                                </div>

                                                                <div class="form-group">
                                                                    {{--                                                                                <label class="control-label">Select Deliveryman</label>--}}
                                                                    <button type="submit"
                                                                            class="btn btn-block btn-primary btn-sm waves-effect waves-light float-right">
                                                                        Save
                                                                    </button>
                                                                </div>


                                                            </form>


                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->

                                        @elseif($res->delivery_status=="returned_to_admin")
                                            <span
                                                class="badge badge-pill badge-success"> Returned To Admin</span>
                                        @elseif($res->delivery_status=="partial_delivered")
                                            <span
                                                class="badge badge-pill badge-warning"> Partial Delivered</span>

                                            <button type="button" class="btn btn-primary"
                                                    data-toggle="modal"
                                                    data-target=".receive-modal{{$res->parcel_id}}">Receive
                                            </button>

                                            <div class="modal fade receive-modal{{$res->parcel_id}}"
                                                 tabindex="-1"
                                                 role="dialog" aria-labelledby="mySmallModalLabel"
                                                 style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0"
                                                                id="mySmallModalLabel">Receive Product</h5>
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal" aria-hidden="true">
                                                                ×
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form method="get"
                                                                  action="/admin/parcel/receive-by-admin">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">Notes</label>

                                                                    <input name="_token"
                                                                           value="{{csrf_token()}}"
                                                                           type="hidden"/>
                                                                    <input name="parcel_id"
                                                                           value="{{$res->parcel_id}}"
                                                                           type="hidden"/>


                                                                    <textarea class="form-control"
                                                                              name="notes"></textarea>

                                                                </div>

                                                                <div class="form-group">
                                                                    {{--                                                                                <label class="control-label">Select Deliveryman</label>--}}
                                                                    <button type="submit"
                                                                            class="btn btn-block btn-primary btn-sm waves-effect waves-light float-right">
                                                                        Save
                                                                    </button>
                                                                </div>


                                                            </form>


                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->


                                        @else
                                            <span
                                                class="badge badge-pill badge-success">{{getFormattedStatus($res->delivery_status)}}</span>
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
                                                {{--                                                        <a class="dropdown-item"--}}
                                                {{--                                                           href="/merchant/parcel/edit/{{$res->parcel_id}}">Edit</a>--}}
                                                {{--                                                        <a class="dropdown-item"--}}
                                                {{--                                                           href="/merchant/parcel/delete/{{$res->parcel_id}}">Delete</a>--}}
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

