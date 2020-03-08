@extends('layouts.merchant')
@section('title', 'Profile')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Merchant Profile</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Merchant Profile Setting</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3">

            <!-- Simple card -->
            <div class="card">
                <img class="card-img-top img-fluid" src="/merchant/{{$result->merchant_image}}" alt="Card image cap">
                <div class="card-body">
                    <h4> Name: {{$result->merchant_name}}</h4>
                    <h6> Phone: {{$result->merchant_phone}}</h6>
                    <h6> Email: {{$result->merchant_email}}</h6>
                    <h6> Active Status: @if($result->active_status==0) NO @else Yes @endif</h6>
                    <h6> COD Enable: @if($result->is_cod_enable==0) No @else yes @endif</h6>
                    <h6> COD Charge: {{$result->cod_charge}}</h6>
                    <h6> Area: {{$result->area_name}}</h6>
                    <a href="/merchant/setting/edit/{{$result->merchant_id}}" class="btn btn-primary waves-effect waves-light">Edit</a>
                </div>
            </div>

        </div>


    </div>



@endsection
