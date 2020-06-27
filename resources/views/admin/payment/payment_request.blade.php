@extends('layouts.app')
@section('title', 'Payment Request view')

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
                    <form method="post" action="/paymentrequest-all/change">
                        <table id="" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Merchant Name</th>
                                <th>Phone</th>
                                <th>Amount</th>

                                <th>Parcel Count</th>
                                <th>Status</th>

                                <th>Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php($i=1)
                            @foreach($results as $res)
                                <tr>
                                    <td><input class="ml-2" type="checkbox" name="id[]"
                                               value="{{$res->id}}"></td>
                                    <td>{{$res->merchant_name}}</td>
                                    <td>{{$res->merchant_phone}}</td>
                                    <td>{{$res->payable_amount}}</td>

                                    <td>{{count(json_decode($res->parcels,true))}}</td>
                                    <td>
                                        @if($res->paid_status=="pending")

                                            <span class="badge badge-warning">  {{$res->paid_status}}</span>
                                        @elseif($res->paid_status=="rejected")

                                            <span class="badge badge-danger">  {{$res->paid_status}}</span>
                                        @else

                                            <span class="badge badge-success">  {{$res->paid_status}}</span>
                                        @endif


                                    </td>
                                    <td>
                                        <div class="btn-group mr-1 mt-2">
                                            <button type="button" class="btn btn-info btn-sm">Action</button>
                                            <button type="button"
                                                    class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @if($res->paid_status=="pending")
                                                    <a class="dropdown-item"
                                                       href="/admin/view/payments-request/approve/{{$res->id}}">Approve</a>
                                                    <a class="dropdown-item"
                                                       href="/admin/view/payments-request/cancel/{{$res->id}}">Cancel</a>
                                                @elseif($res->paid_status=="rejected")
                                                    <a class="dropdown-item"
                                                       href="/admin/view/payments-request/approve/{{$res->id}}">Approve</a>

                                                @else
                                                    <a class="dropdown-item"
                                                       href="#">Already {{$res->paid_status}}</a>
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
                                value="1" type="submit" onclick="return confirm('are you sure?')">Approved
                        </button>
                        <button name="change" class="btn btn-danger float-right waves-effect waves-light mr-1" value="2"
                                type="submit" onclick="return confirm('are you sure?')">Canceled
                        </button>


                    </form>


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
