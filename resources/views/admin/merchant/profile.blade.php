@extends('layouts.app')
@section('title', 'Merchant Profile')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Merchants profile</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Merchant profile setting</a></li>
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
                    <h6> Active Status: @if($result->active_status==0) NO @else YES @endif</h6>
                    <h6> COD Enable: @if($result->is_cod_enable==0) No @else yes @endif</h6>
                    <h6> COD Charge: {{$result->cod_charge}}</h6>
                    <h6> Area: {{$result->area_name}}</h6>
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
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-title">
                    <h5 class="mt-2 text-center text-success"> Payment Methoed Details</h5>
                </div>
                <div class="card-body">
                    @foreach($payment_data as $data)
                        <h6> <strong>Payment Method :</strong> {{$data->payment_methoed_name}}</h6>
                        <h6> <strong>Account Number:</strong> {{$data->account_number}}</h6>
                        <h6> <strong>Branch Addrss:</strong> {{$data->branch_address}}</h6>
                        <h6> <strong>Payee Name:</strong> {{$data->payee_name}}</h6>

{{--                        <a href="/merchant/paymentmethoed/edit/{{$data->paymentmethoed_id}}"--}}
{{--                           class="btn btn-primary btn-sm waves-effect waves-light">Edit</a>--}}

                    @endforeach
                    <hr>
{{--                    <a href="/merchant/paymentmethoed/create"--}}
{{--                       class="btn btn-info btn-sm waves-effect waves-light">+create</a>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

