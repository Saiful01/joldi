@extends('layouts.merchant')
@section('title', 'Dashboard')

@section('content')



    <!-- start page title -->
    <div class="row align-items-center" ng-controller="dashboardController">
        <div class="col-sm-6">
            <div class="page-title-box">
                {{--                <h4 class="font-size-18">Compact Sidebar</h4>--}}
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active">Welcome to Merchant Dashboard</li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-left mini-stat-img mr-4">
                                        <img src="/assets/images/services-icon/01.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase mt-0 text-white">Add Parcel</h5>
                                    <h4 class="font-weight-medium font-size-24"><i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                    {{--                                <div class="mini-stat-label bg-success">--}}
                                    {{--                                    <p class="mb-0">+ 12%</p>--}}
                                    {{--                                </div>--}}
                                </div>
                                <div class="pt-2">
                                    <div class="float-right">

                                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg"
                                           class="text-white"><i class="mdi mdi-arrow-right h5"></i></a>
                                    </div>

                                    {{--                                <p class="text-white mb-0 mt-1">Since last month</p>--}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <a href="/merchant/payments/request" class="text-white">
                    <div class="col-xl-4 col-md-6">
                        <div class="card mini-stat bg-pink text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-left mini-stat-img mr-4">
                                        <img src="/assets/images/services-icon/01.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase mt-0 text-white">Payable Amount</h5>
                                    <h4 class="font-weight-medium font-size-24">{{$payable_amount}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                    {{--                                <div class="mini-stat-label bg-success">--}}
                                    {{--                                    <p class="mb-0">+ 12%</p>--}}
                                    {{--                                </div>--}}
                                </div>
                                <div class="pt-2">
                                    <div class="float-right">
                                        <a href="/merchant/payments/request" class="text-white"><i
                                                class="mdi mdi-arrow-right h5"></i></a>
                                    </div>

                                    {{--                                <p class="text-white mb-0 mt-1">Since last month</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="/merchant/payments/request" class="text-white">
                    <div class="col-xl-4 col-md-6">
                        <div class="card mini-stat bg-success text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-left mini-stat-img mr-4">
                                        <img src="/assets/images/services-icon/01.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase mt-0 text-white">Total Sales</h5>
                                    <h4 class="font-weight-medium font-size-24">{{$total_sales}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                    {{--                                <div class="mini-stat-label bg-success">--}}
                                    {{--                                    <p class="mb-0">+ 12%</p>--}}
                                    {{--                                </div>--}}
                                </div>
                                <div class="pt-2">
                                    <div class="float-right">
                                        <a href="/merchant/payments/request" class="text-white"><i
                                                class="mdi mdi-arrow-right h5"></i></a>
                                    </div>

                                    {{--                            php artisan cache:clear    <p class="text-white mb-0 mt-1">Since last month</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="/merchant/parcel/show" class="text-white">
                    <div class="col-xl-4 col-md-6">
                        <div class="card mini-stat bg-info text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-left mini-stat-img mr-4">
                                        <img src="/assets/images/services-icon/01.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase mt-0 text-white">Totall parcel</h5>
                                    <h4 class="font-weight-medium font-size-24">{{$par_count}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                    {{--                                <div class="mini-stat-label bg-success">--}}
                                    {{--                                    <p class="mb-0">+ 12%</p>--}}
                                    {{--                                </div>--}}
                                </div>
                                <div class="pt-2">
                                    <div class="float-right">
                                        <a href="/merchant/parcel/show" class="text-white"><i
                                                class="mdi mdi-arrow-right h5"></i></a>
                                    </div>

                                    {{--                                <p class="text-white mb-0 mt-1">Since last month</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>


                </a>
                <a href="/merchant/parcel/show" class="text-white">

                    <div class="col-xl-4 col-md-6">
                        <div class="card mini-stat bg-danger text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-left mini-stat-img mr-4">
                                        <img src="/assets/images/services-icon/01.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase mt-0 text-white">Canceled</h5>
                                    <h4 class="font-weight-medium font-size-24">{{$delivery_cancelled}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                    {{--                                <div class="mini-stat-label bg-success">--}}
                                    {{--                                    <p class="mb-0">+ 12%</p>--}}
                                    {{--                                </div>--}}
                                </div>
                                <div class="pt-2">
                                    <div class="float-right">
                                        <a href="/merchant/parcel/show" class="text-white"><i
                                                class="mdi mdi-arrow-right h5"></i></a>
                                    </div>

                                    {{--                                <p class="text-white mb-0 mt-1">Since last month</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="/merchant/parcel/show" class="text-white">

                    <div class="col-xl-4 col-md-6">
                        <div class="card mini-stat bg-warning text-white">
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="float-left mini-stat-img mr-4">
                                        <img src="/assets/images/services-icon/01.png" alt="">
                                    </div>
                                    <h5 class="font-size-16 text-uppercase mt-0 text-white"> Pending</h5>
                                    <h4 class="font-weight-medium font-size-24">{{$delivery_pending}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                    {{--                                <div class="mini-stat-label bg-success">--}}
                                    {{--                                    <p class="mb-0">+ 12%</p>--}}
                                    {{--                                </div>--}}
                                </div>
                                <div class="pt-2">
                                    <div class="float-right">
                                        <a href="/merchant/parcel/show" class="text-white"><i
                                                class="mdi mdi-arrow-right h5"></i></a>
                                    </div>

                                    {{--                                <p class="text-white mb-0 mt-1">Since last month</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>


            </div>
        </div>
        <div class="col-md-3">

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
                                    <td><span class="badge badge-success">{{$list->delivery_status}}</span></td>
                                    <td>
                                        <div>
                                            <a href="/merchant/parcel/details/{{$list->parcel_id}}"
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
    //modal
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card card-body pickupOptions border-0 p-2">

                    <h5 class="text-center">Choose Delivery Type</h5>
                    <div class="row">

                        <div class="col-6"><a href="/merchant/parcels/next_day">
                                <div class="card info-card border-0 my-3 cursor-pointer">
                                    <div class="card-body rounded text-white" style="background-color: #4E599A ">
                                        {{--                                    <div class="text-center over-badge"><span class="content">24h</span></div>--}}
                                        <p class="font-13 mb-0 text-center line-height-1_25 lbl">Next Day</p>
                                        <p class="font-12 text-center line-height-1_25 mb-0 opacity-7_5">Delivery</p>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="col-6"><a href="/merchant/parcels/same_day">
                                <div class="card info-card border-0 my-3 cursor-pointer">
                                    <div class="card-body rounded text-white " style="background-color: #25A7B7">
                                        {{--                                    <div class="text-center over-badge"><span class="content">12h</span></div>--}}
                                        <p class="font-13 mb-0 text-center line-height-1_25 lbl">Same Day</p>
                                        <p class="font-12 text-center line-height-1_25 mb-0 opacity-7_5">Delivery</p>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>

        var app = angular.module('parcelCreateApp', []);


        app.controller('dashboardController', function ($scope, $http) {

            console.log("lolll");


            $http.get("/statistics")
                .then(function (response) {
                    // $scope.myWelcome = response.data;
                    console.log(response.data);
                    //$scope.parcels = response.data;
                    console.log("lolll");

                    var chart = new Chartist.Pie("#ct-donut", {
                        series: [response.data.delivery_pending, response.data.delivery_accepted, response.data.delivery_cancelled, response.data.delivery_on_the_way, response.data.delivery_delivered, response.data.delivery_returned],
                        labels: [1, 2, 3, 1, 2, 3]
                    }, {
                        donut: !0,
                        showLabel: !1,
                        plugins: [Chartist.plugins.tooltip()]
                    });

                });

        });


    </script>

@endsection
