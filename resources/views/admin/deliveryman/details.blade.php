@extends('layouts.app')
@section('title', 'DeliveryMan Details')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">DeliveryMan profile</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">DeliveryMan profile setting</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">


                    <div class="card-body text-center">
                        <h6> Name: {{$result->delivery_man_name}}</h6>
                        <h6> Phone: {{$result->delivery_man_phone}}</h6>
                        <h6> Email: {{$result->delivery_man_email}}</h6>
                        <h6> Active Status: @if($result->active_status==0) <span class="badge-danger">Inactive</span> @else <span class="badge-success">Active</span> @endif</h6>
                        <h6> Address: {{$result->delivery_man_address}}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Profile Image</h4>
                    <div class="card-body">
                        <img class="img-thumbnail" src="/images/{{$result->delivery_man_image}}" width="100%"
                             alt="profile image">

                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Nid</h4>
                    <div class="card-body">
                        <img class="img-thumbnail" src="/images/{{$result->delivery_man_document}}" width="100%"
                             alt="profile image">

                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Driving License</h4>
                    <div class="card-body">
                        <img class="img-thumbnail" src="/images/{{$result->license}}" width="100%" alt="profile image">

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Tax Token</h4>
                    <div class="card-body">
                        <img class="img-thumbnail" src="/images/{{$result->tax_token}}" width="100%" alt=" Tax Token">

                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Blue Book</h4>
                    <div class="card-body">
                        <img class="img-thumbnail" src="/images/{{$result->blue_book}}" width="100%" alt="Blue Book">

                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Insurence</h4>
                    <div class="card-body">
                        <img class="img-thumbnail" src="/images/{{$result->insurence}}" width="100%" alt="Insurence">

                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

