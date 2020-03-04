@extends('layouts.merchant')
@section('title', 'Customer')

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
        <div class="col-xl-4">
            <div class="card">
                <div class="card header">
                    <img class="img-thumbnail" src="" alt="profile image">
                </div>
                <div class="card-body text-center">
                    <h4> Name: {{$result->merchant_name}}</h4>
                    <h6> Phone: {{$result->merchant_phone}}</h6>
                    <h6> Email: {{$result->merchant_email}}</h6>
                    <h6> Active Status: @if($result->active_status==0) Yes @else No @endif</h6>
                    <h6> COD Enable: @if($result->is_cod_enable==0) No @else yes @endif</h6>
                    <h6> COD Charge: {{$result->cod_charge}}</h6>
                    <h6> Area: {{$result->area_name}}</h6>
                </div>
            </div>
        </div>

    </div>


@endsection
