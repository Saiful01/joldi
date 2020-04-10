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
                                            <td>


                                                @if($res->delivery_man_id==null)
                                                    <div class="col-sm-6 col-md-3">
                                                        <div class="text-center">
                                                            <!-- Small modal -->
                                                            <button type="button"
                                                                    class="btn btn-sm btn-primary waves-effect waves-light"
                                                                    data-toggle="modal"
                                                                    data-target=".modal-id{{$res->parcel_id}}">Assign
                                                            </button>
                                                        </div>

                                                        <div class="modal fade modal-id{{$res->parcel_id}}" tabindex="-1"
                                                             role="dialog" aria-labelledby="mySmallModalLabel"
                                                             style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title mt-0"
                                                                            id="mySmallModalLabel">Assign Deliveryman</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-hidden="true">
                                                                            ×
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form method="get" action="/admin/parcel/assign-deliveryman">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Select Deliveryman</label>

                                                                                <input name="_token" value="{{csrf_token()}}" type="hidden"/>
                                                                                <input name="parcel_id" value="{{$res->parcel_id}}" type="hidden"/>
                                                                                <select class="form-control select2" name="delivery_man_id">
                                                                                    <option>Select</option>

                                                                                    @foreach($delivery_mans as $delivery_man)
                                                                                        <option value="{{$delivery_man->delivery_man_id}}">{{$delivery_man->delivery_man_name}}</option>

                                                                                    @endforeach

                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
{{--                                                                                <label class="control-label">Select Deliveryman</label>--}}
                                                                                <button type="submit" class="btn btn-block btn-primary btn-sm waves-effect waves-light float-right">Save</button>
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


                                            <td>{{$res->customer_name}}</td>
                                            <td>{{$res->customer_phone}}</td>
                                            <td>{{$res->customer_address}}</td>
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
                                                @elseif($res->delivery_status=="partial_delivered")
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">admin</button>

                                                    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">

                                                                <span class="badge badge-pill "> Partial Delivered</span>
                                                                <form>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-10">
                                                                            <input type="text"  class="form-control-plaintext" placeholder="write note here" style="border: 1px solid">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-3">
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                                                Update
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </form>


                                                            </div>
                                                        </div>
                                                    </div>

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
{{--                                                        <a class="dropdown-item"--}}
{{--                                                           href="/merchant/parcel/edit/{{$res->parcel_id}}">Edit</a>--}}
{{--                                                        <a class="dropdown-item"--}}
{{--                                                           href="/merchant/parcel/delete/{{$res->parcel_id}}">Delete</a>--}}
                                                        <a class="dropdown-item"
                                                           href="/admin/parcel/details/{{$res->parcel_id}}">Details</a>
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
