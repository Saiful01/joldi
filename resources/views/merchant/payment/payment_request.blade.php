@extends('layouts.app')
@section('title', 'Customer')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Payment Information</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Payment Table</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{session('success')}}!</strong>
                        </div>
                    @endif
                    @if(session('failed'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{session('failed')}}!</strong>
                        </div>
                    @endif

                    <form class="form-inline" action="/merchant/payments/request" method="post"
                          enctype="multipart/form-data"
                          novalidate="">

                        <div class="form-group">
                            <label style="padding-right: 5px">From</label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker"
                                           name="from_date">
                                    <input type="hidden" name="_token" value="{{{csrf_token()}}}">

                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="padding-right: 5px;padding-left: 5px">To</label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy"
                                           id="datepicker-autoclose" name="to_date">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>


                        <div class="form-group">

                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Search
                                </button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pending Parcels</h4>
                    <p class="card-title-desc"></p>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">

                            <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Parcel Price</th>
                                <th>Total Charge<span style="font-size: 10px">(COD+Delivery)</span></th>
                                <th>Payable Amount</th>

                                <th>Delivery Date</th>
                                <th>Delivered</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total_price = 0;
                            $total_charge = 0;
                            ?>
                            @foreach($results as $result)
                                <tr>
                                    <th>{{$result->parcel_invoice}}</th>
                                    <th>{{$result->payable_amount}}</th>
                                    <th>{{$result->cod+$result->delivery_charge}}</th>
                                    <th>{{$result->payable_amount-($result->cod+$result->delivery_charge)}}</th>
                                    <th>{{$result->delivery_date}}</th>
                                    <th>{{$result->updated_at}}</th>
                                    <?php
                                    $total_price = $total_price + $result->payable_amount;
                                    $total_charge = $total_charge + $result->cod + $result->delivery_charge;
                                    ?>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>


            <div class="card text-center">
                <div class="card-body">
                    <div class="py-4">

                        <h5 class="text-primary mt-4">Receivable Amount</h5>
                        <p style="line-height: 10px"> Total Amount {{ $total_price}}</p>
                        <p style="line-height: 10px"> Total Charge: {{ $total_charge}}</p>
                        <p style="line-height: 10px">Receivable Amount {{ $total_price-$total_charge}}</p>

                        <form class="custom-validation" action="/merchant/payments/store" method="post"
                              enctype="multipart/form-data"
                              novalidate="">

                            <div class="form-group row" style="display: none">
                                <div class="col-sm-9">
                                    <input class="form-control form-control-lg" type="text" placeholder=""
                                           id="example-text-input-lg" name="parcels" value="{{$results}}"
                                           readonly>
                                    <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                                    <input type="hidden" name="payable_amount" value="{{ $total_price-$total_charge}}">
                                    <input type="hidden" name="from_date" value="{{ $total_price-$total_charge}}">

                                </div>
                            </div>


                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Payment Request
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
