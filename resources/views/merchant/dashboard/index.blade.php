@extends('layouts.merchant')
@section('title', 'Dashboard')

@section('content')



    <!-- start page title -->
    <div class="row align-items-center" ng-controller="dashboardController">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Compact Sidebar</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active">Welcome to Merchant Dashboard</li>
                </ol>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="float-right d-none d-md-block">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-settings mr-2"></i> Settings
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="/assets/images/services-icon/01.png" alt="">
                                </div>
                                <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Add Parcel</h5>
                                <h4 class="font-weight-medium font-size-24"> <i
                                        class="mdi mdi-arrow-up text-success ml-2"></i></h4>
{{--                                <div class="mini-stat-label bg-success">--}}
{{--                                    <p class="mb-0">+ 12%</p>--}}
{{--                                </div>--}}
                            </div>
                            <div class="pt-2">
                                <div class="float-right">
                                    <a href="/admin/parcels" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                </div>

{{--                                <p class="text-white-50 mb-0 mt-1">Since last month</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="/assets/images/services-icon/01.png" alt="">
                                </div>
                                <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Payable Amount</h5>
                                <h4 class="font-weight-medium font-size-24">{{$payable_amount}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                {{--                                <div class="mini-stat-label bg-success">--}}
                                {{--                                    <p class="mb-0">+ 12%</p>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="pt-2">
                                <div class="float-right">
                                    <a href="/merchant/payments/request" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                </div>

                                {{--                                <p class="text-white-50 mb-0 mt-1">Since last month</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="/assets/images/services-icon/01.png" alt="">
                                </div>
                                <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Sales</h5>
                                <h4 class="font-weight-medium font-size-24">{{$total_sales}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                {{--                                <div class="mini-stat-label bg-success">--}}
                                {{--                                    <p class="mb-0">+ 12%</p>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="pt-2">
                                <div class="float-right">
                                    <a href="/merchant/payments/request" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                </div>

                                {{--                                <p class="text-white-50 mb-0 mt-1">Since last month</p>--}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="/assets/images/services-icon/01.png" alt="">
                                </div>
                                <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Totall parcel</h5>
                                <h4 class="font-weight-medium font-size-24">{{$par_count}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                {{--                                <div class="mini-stat-label bg-success">--}}
                                {{--                                    <p class="mb-0">+ 12%</p>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="pt-2">
                                <div class="float-right">
                                    <a href="/admin/parcels" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                </div>

                                {{--                                <p class="text-white-50 mb-0 mt-1">Since last month</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="/assets/images/services-icon/01.png" alt="">
                                </div>
                                <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Canceled</h5>
                                <h4 class="font-weight-medium font-size-24">{{$delivery_cancelled}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                {{--                                <div class="mini-stat-label bg-success">--}}
                                {{--                                    <p class="mb-0">+ 12%</p>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="pt-2">
                                <div class="float-right">
                                    <a href="/admin/parcels" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                </div>

                                {{--                                <p class="text-white-50 mb-0 mt-1">Since last month</p>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="/assets/images/services-icon/01.png" alt="">
                                </div>
                                <h5 class="font-size-16 text-uppercase mt-0 text-white-50"> Pending</h5>
                                <h4 class="font-weight-medium font-size-24">{{$delivery_pending}} <i
                                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                {{--                                <div class="mini-stat-label bg-success">--}}
                                {{--                                    <p class="mb-0">+ 12%</p>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="pt-2">
                                <div class="float-right">
                                    <a href="/admin/parcels" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                </div>

                                {{--                                <p class="text-white-50 mb-0 mt-1">Since last month</p>--}}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Activity</h4>
                            <ol class="activity-feed">
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <span class="date">Jan 22</span>
                                        <span class="activity-text">Responded to need “Volunteer
                                                        Activities”</span>
                                    </div>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <span class="date">Jan 20</span>
                                        <span class="activity-text">At vero eos et accusamus et iusto odio
                                                        dignissimos ducimus qui deleniti atque...<a href="#" class="text-success">Read more</a></span>
                                    </div>
                                </li>


                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <span class="date">Jan 16</span>
                                        <span class="activity-text">Sed ut perspiciatis unde omnis iste natus
                                                        error sit rem.</span>
                                    </div>
                                </li>
                            </ol>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Sales Report</h4>

                    <div class="cleafix">
                        <p class="float-left"><i class="mdi mdi-calendar mr-1 text-primary"></i> Jan 01 -
                            Jan 31</p>
                        <h5 class="font-18 text-right">$4230</h5>
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
                                <th scope="col"> Invoice </th>
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
                                        <a href="#" class="btn btn-primary btn-sm">Details</a>
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