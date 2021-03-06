@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')



    <!-- start page title -->
    <div class="row align-items-center" ng-controller="dashboardController">
        <div class="col-sm-6">
            <div class="page-title-box">
                {{--                <h4 class="font-size-18">Compact Sidebar</h4>--}}
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active">Welcome to Admin Dashboard</li>
                </ol>
            </div>
        </div>

        {{--        <div class="col-sm-6">--}}
        {{--            <div class="float-right d-none d-md-block">--}}
        {{--                <div class="dropdown">--}}
        {{--                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button"--}}
        {{--                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
        {{--                        <i class="mdi mdi-settings mr-2"></i> Settings--}}
        {{--                    </button>--}}
        {{--                    <div class="dropdown-menu dropdown-menu-right">--}}
        {{--                        <a class="dropdown-item" href="#">Action</a>--}}
        {{--                        <a class="dropdown-item" href="#">Another action</a>--}}
        {{--                        <a class="dropdown-item" href="#">Something else here</a>--}}
        {{--                        <div class="dropdown-divider"></div>--}}
        {{--                        <a class="dropdown-item" href="#">Separated link</a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-3">
                    <a href="/admin/merchants" class="text-white">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="mx-auto text-white">
                                    <h4 class="text-center">Total Merchant</h4>
                                    <h4 class="text-center">{{$merchant_count}}</h4>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-3">
                    <a href="#" class="text-white">
                        <div class="card bg-pink">
                            <div class="card-body">
                                <div class="mx-auto text-white">
                                    <h4 class="text-center">Total Charge</h4>
                                    <h4 class="text-center">{{$total_delivery_charge}}</h4>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" class="text-white">

                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="mx-auto text-white">
                                    <h4 class="text-center">Total Sales</h4>
                                    <h4 class="text-center">{{$sum}}</h4>

                                </div>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-md-3">
                    <a href="/admin/parcel/show" class="text-white">

                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="mx-auto text-white">
                                    <h4 class="text-center">Total parcel</h4>
                                    <h4 class="text-center">{{$par_count}}</h4>

                                </div>
                            </div>
                        </div>
                    </a>

                </div>

                <div class="col-md-3">
                    <a href="/admin/parcel/show" class="text-white">

                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="mx-auto text-white">
                                    <h4 class="text-center">Total Pending</h4>
                                    <h4 class="text-center">{{$delivery_pending}}</h4>

                                </div>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-md-3">
                    <a href="/admin/parcel/show" class="text-white">

                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="mx-auto text-white">
                                    <h4 class="text-center">Total Canceled</h4>
                                    <h4 class="text-center">{{$delivery_cancelled}}</h4>

                                </div>
                            </div>
                        </div>
                    </a>

                </div>

                <div class="col-md-3">
                    <a href="/admin/parcel/show" class="text-white">

                        <div class="card bg-dark">
                            <div class="card-body">
                                <div class="mx-auto text-white">
                                    <h4 class="text-center">Total Delivered</h4>
                                    <h4 class="text-center">{{$delivery_delivered}}</h4>

                                </div>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-md-3">
                    <a href="/admin/parcel/show" class="text-white">

                        <div class="card" style="background-color: #00ff80">
                            <div class="card-body">
                                <div class="mx-auto text-white">
                                    <h4 class="text-center">Total Returened</h4>
                                    <h4 class="text-center">{{$delivery_returned}}</h4>

                                </div>
                            </div>
                        </div>
                    </a>

                </div>


            </div>
        </div>

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Parcel Report</h4>

                    <div class="cleafix">
                        {{--                        <p class="float-left"><i class="mdi mdi-calendar mr-1 text-primary"></i> Jan 01 ---}}
                        {{--                            Jan 31</p>--}}
                        <h5 class="font-18 text-right">{{$par_count}}</h5>
                    </div>

                    <div id="ct-donut" class="ct-chart wid"></div>

                    <div class="mt-4">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <td><span class="badge badge-primary">Pending</span></td>
                                <td class="text-right">{{$delivery_pending}}</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-success">Accepted</span></td>
                                <td class="text-right">{{$delivery_accepted}}</td>
                            </tr>

                            <tr>
                                <td><span class="badge badge-danger">Rejected By Admin</span></td>
                                <td class="text-right">{{$delivery_cancelled}}</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-warning">Returned By user</span></td>
                                <td class="text-right">{{$delivery_returned}}</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-info">On The Way</span></td>
                                <td class="text-right">{{$delivery_on_the_way}}</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td class="text-right">{{$delivery_delivered}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Parcel</h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-centered table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col"> Invoice</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col" colspan="2">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($parcel_list as $list)
                                    <th scope="row">{{$list->parcel_invoice}}</th>
                                    <td>

                                        {{$list->customer_name}}

                                    </td>
                                    <td>{{$list->delivery_date}}</td>
                                    <td>{{$list->total_amount}}</td>
                                    <td>
                                        @if($list->delivery_status=="pending")
                                            <span class="badge badge-pill badge-primary">Pending</span>
                                        @elseif($list->delivery_status=="accepted")
                                            <span class="badge badge-pill badge-secondary"> Accepted</span>
                                        @elseif($list->delivery_status=="cancelled")
                                            <span class="badge badge-pill badge-danger"> Cancelled</span>
                                        @elseif($list->delivery_status=="on_the_way")
                                            <span class="badge badge-pill badge-info"> On The Way</span>
                                        @elseif($list->delivery_status=="delivered")
                                            <span class="badge badge-pill badge-success"> Delivered</span>
                                        @elseif($list->delivery_status=="returned")
                                            <span class="badge badge-pill badge-warning"> Returned</span>
                                        @elseif($list->delivery_status=="returned_to_admin")
                                            <span class="badge badge-pill badge-success"> Returned To Admin</span>
                                        @elseif($list->delivery_status=="partial_delivered")
                                            <span class="badge badge-pill badge-warning"> Partial Delivered</span>
                                        @else
                                            <span
                                                class="badge badge-pill badge-success">{{getFormattedStatus($list->delivery_status)}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a href="/admin/parcel/details/{{$list->parcel_id}}"
                                               class="btn btn-primary btn-sm">Details</a>
                                        </div>
                                    </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
