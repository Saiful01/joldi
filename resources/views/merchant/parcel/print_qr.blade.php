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
                                            {{--<a href="#" class="btn btn-primary waves-effect waves-light">Send</a>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            {{-- <div class="invoice-title">
                                 --}}{{--<h4 class="float-right font-size-16"><strong>Invoice
                                         # parcel_invoice</strong></h4>--}}{{--
                                 --}}{{--<h3 class="mt-0">
                                     <img src="/assets/images/logo.png" alt="logo" height="24">
                                 </h3>--}}{{--
                                 <h3 class="mt-0">
                                     <img src="/assets/images/shop_logo/{{$shop->logo}}" alt="logo" height="40">
                                 </h3>
                             </div>
                             <hr>--}}
                            <div class="row">
                                @foreach($parcel_data as $result)
                                    <div class="col-6">

                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <address>
                                                    <strong>Billed To:</strong>
                                                    <hr>
                                                    <span class="font-weight-bold mr-2">Name:</span> {{$result->customer_name}}
                                                    <br>
                                                    <span class="font-weight-bold mr-2">Phone:</span>{{$result->customer_name}}
                                                    <br>
                                                    <span class="font-weight-bold mr-2">Address:</span>{{$result->customer_address}}
                                                </address>

                                            </div>
                                            <div class="col-md-6">
                                                {!! QrCode::size(150)->generate($result->parcel_invoice); !!}

                                            </div>
                                        </div>

                                    </div>
                                @endforeach


                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>


@endsection
