@extends('layouts.merchantapp')
@section('title', 'Customer')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Delivery Man</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Delivery Man Edit</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> elivery Man Edit</h5>
                    <hr>
                    <form class="custom-validation" method="post" action="/deliveryman/update" novalidate=""
                          enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Name</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" placeholder="Name"
                                       id="example-text-input-lg" name="delivery_man_name" value="{{delivery_man_name}}" required>
                                <input type="hidden" name="_token" value="{{{csrf_token()}}}"/>
                                <input type="hidden" name="delivery_man_id" value="{{delivery_man_id}}"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" placeholder="phone"
                                       id="example-text-input-lg" name="delivery_man_phone" value="{{delivery_man_phone}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Password </label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="password" placeholder="Email"
                                       id="example-text-input-lg" name="delivery_man_password" value="{{delivery_man_password}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Address</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" placeholder="Address"
                                       id="example-text-input-lg" name="delivery_man_address" value="{{delivery_man_address}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
