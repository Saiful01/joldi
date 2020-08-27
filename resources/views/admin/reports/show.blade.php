@extends('layouts.app')
@section('title', 'Consignment Reports')

@section('content')

    <!-- start page title -->
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4 class="font-size-18">Parcel Info</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Consignment Report</a></li>
                    </ol>
                </div>
            </div>

        </div>
    <!-- end page title -->


            <div class="card">
                        <div class="card-body">

                            <form class="form-inline" method="post" action="/admin/consignment/report/search">
                                    <div class="form-group mx-sm-3 ">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            {{--<select class="form-control" name="status">
                                                <option value="pending">pending</option>
                                                <option value="pickup_man_assigned">pickup_man_assigned</option>
                                                <option value="accepted">accepted</option>
                                                <option value="delivery_man_assigned">delivery_man_assigned</option>
                                                <option value="on_the_way">on_the_way</option>
                                                <option value="delivered">delivered</option>
                                                <option value="returned">returned</option>
                                                <option value="partial_delivered">partial_delivered</option>
                                                <option value="returned_to_admin">returned_to_admin</option>

                                            </select>--}}
                                            <label for="date">From:</label>
                                            <input type="date" class="form-control" placeholder="" id="email" name="from">
                                            <label for="date">To:</label>
                                            <input type="date" class="form-control" placeholder="" id="email" name="to">


                                                <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                     </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-3">
                                <a href="/admin/parcel/show" class="text-white">
                                    <div class="card bg-primary">
                                        <div class="card-body">
                                            <div class="mx-auto text-white">
                                                <h4 class="text-center">Total Parcel</h4>
                                                <h4 class="text-center">{{$par_count}}</h4>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>


                            <div class="col-md-3">
                                <a href="/admin/parcel/show" class="text-white">
                                    <div class="card bg-pink">
                                        <div class="card-body">
                                            <div class="mx-auto text-white">
                                                <h4 class="text-center">Pending</h4>
                                                <h4 class="text-center">{{$delivery_pending}}</h4>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="/admin/parcel/show" class="text-white">

                                    <div class="card bg-info">
                                        <div class="card-body">
                                            <div class="mx-auto text-white">
                                                <h4 class="text-center">PickupMan Assigened</h4>
                                                <h4 class="text-center">{{$pickup_man_assigned}}</h4>

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
                                                <h4 class="text-center">DeliveryMan assigned</h4>
                                                <h4 class="text-center">{{$delivery_man_assigned}}</h4>

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
                                                <h4 class="text-center">On The Way</h4>
                                                <h4 class="text-center">{{$delivery_on_the_way}}</h4>

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
                                                <h4 class="text-center"> Canceled</h4>
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
                                                <h4 class="text-center"> Delivered</h4>
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
                                                <h4 class="text-center"> Returened</h4>
                                                <h4 class="text-center">{{$delivery_returned}}</h4>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-md-3">
                                <a href="/admin/parcel/show" class="text-white">

                                    <div class="card" style="background-color: #f700ff">
                                        <div class="card-body">
                                            <div class="mx-auto text-white">
                                                <h4 class="text-center"> Returened To Admin</h4>
                                                <h4 class="text-center">{{$delivery_returned_to_admin}}</h4>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-md-3">
                                <a href="/admin/parcel/show" class="text-white">

                                    <div class="card" style="background-color: #4cff00">
                                        <div class="card-body">
                                            <div class="mx-auto text-white">
                                                <h4 class="text-center"> Partial Delivered</h4>
                                                <h4 class="text-center">{{$delivery_partial_delivered}}</h4>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>


                        </div>
                    </div>

                </div>


            </div>








@endsection
