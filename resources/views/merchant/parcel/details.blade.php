@extends('layouts.merchant')
@section('title', 'Parcel Details')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Parcel Info</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Parcel Table</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="">

                                    <div class="d-print-none">
                                        <div class="float-right">
                                            <a href="javascript:window.print()"
                                               class="btn btn-sm btn-success waves-effect waves-light"><i
                                                        class="fa fa-print"></i> Print</a>
                                            {{--                                            <a href="#" class="btn btn-primary waves-effect waves-light">Send</a>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="invoice-title">
                                <h4 class="float-right font-size-16"><strong>Invoice
                                        # {{$result->parcel_invoice}}</strong></h4>
                                {{--<h3 class="mt-0">
                                    <img src="/assets/images/logo.png" alt="logo" height="24">
                                </h3>--}}
                                <h3 class="mt-0">
                                    <img src="/assets/images/shop_logo/{{$shop->logo}}" alt="logo" height="40">
                                </h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        {{$result->customer_name}}<br>
                                        {{$result->customer_name}}<br>
                                        {{$result->customer_address}}
                                    </address>
                                </div>
                                <div class="col-6 text-right">


                                    {!! QrCode::size(150)->generate($result->parcel_invoice); !!}


                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <address>
                                        <strong>Charge:</strong><br>
                                        Parcel Price: {{$result->payable_amount}}<br>
                                        Delivery Charge: {{$result->delivery_charge}}<br>
                                        Area Charge: {{$result->value}}<br>
                                        COD Charge: {{$result->cod}}<br>
                                        Total Amount: {{$result->total_amount}}<br>
                                        Status: <span class="text-primary">{{ statusFormat($result->delivery_status) }}</span><br>
                                        Date: {{$result->delivery_date}}<br>
                                    </address>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Activity</h4>
                    <ol class="activity-feed">


                        @foreach($histories as $history)
                            <li class="feed-item">
                                <div class="feed-item-list">
                                    <span class="date">{{$history->created_at}}</span>
                                    <span class="activity-text badge badge-info">{{$history->parcel_status}}</span>
                                </div>
                            </li>

                        @endforeach

                    </ol>

                </div>
            </div>

        </div> <!-- end col -->
    </div>

@endsection
