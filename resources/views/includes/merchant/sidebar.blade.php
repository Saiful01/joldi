<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="/merchant/dashboard" class="waves-effect">
                        <i class="ti-home"></i><span class="badge badge-pill badge-primary float-right">2</span>
                        <span>Dashboard</span>
                    </a>
                </li>


                <li>
                    <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class=" waves-effect">
                        <i class="fas fa-archive"></i>
                        <span>Add Parcel</span>
                    </a>
                </li>


                <li>
                    <a href="/merchant/payments/request" class=" waves-effect">
                        <i class="ti-money"></i>
                        <span>Payment Request</span>
                    </a>
                </li>


                <li>
                    <a href="/merchant/payments/view" class=" waves-effect">
                        <i class="fa fa-th-list"></i>
                        <span>View Payments</span>
                    </a>
                </li>

                <li>
                    <a href="/merchant/parcel/show" class=" waves-effect">
                        <i class="fa fa-gift"></i>
                        <span>All Consignment</span>
                    </a>
                </li>
                <li>
                    <a href="/merchant/shop/view" class=" waves-effect">
                        <i class="fas fa-archive"></i>
                        <span>Shop management</span>
                    </a>
                </li>
                <li>
                    <a href="/merchant/profile/setting" class=" waves-effect">
                        <i class="ti-settings"></i>
                        <span>Settings</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

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
                                    <p class="font-12 text-center line-height-1_25 mb-0 opacity-7_5">Delivery</p></div>
                            </div>
                        </a>

                    </div>
                    <div class="col-6"><a href="/merchant/parcels/same_day">
                            <div class="card info-card border-0 my-3 cursor-pointer">
                                <div class="card-body rounded text-white " style="background-color: #25A7B7">
                                    {{--                                    <div class="text-center over-badge"><span class="content">12h</span></div>--}}
                                    <p class="font-13 mb-0 text-center line-height-1_25 lbl">Same Day</p>
                                    <p class="font-12 text-center line-height-1_25 mb-0 opacity-7_5">Delivery</p></div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
