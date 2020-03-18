@extends('layouts.merchant')
@section('title', 'Parcel Create')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Parcel</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Add New Parcel</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row" ng-controller="parcelController">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{--                    <h5 class="card-title">Add New Parcel</h5>
                                        <a href="/tttttt/view" type="butoon" class="card-title float-right"> Parcel View </a>
                                        <hr>--}}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('failed') }}</p>
                    @endif

                    <form class="custom-validation" action="/merchant/parcel/store" method="post"
                          enctype="multipart/form-data"
                          novalidate="">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class=" mb-3">Parcel Information </h5>
                                <hr>

                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Invoice</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder=""
                                               id="example-text-input-lg" name="parcel_invoice" value="{{$invoice}}"
                                               readonly>
                                        <input type="hidden" name="_token" value="{{{csrf_token()}}}">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                        Title</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder=""
                                               id="example-text-input-lg" name="parcel_title">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                        Price</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder="Parcel price"
                                               id="example-text-input-lg" name="payable_amount"
                                               ng-model="payable_amount" ng-change="totalPriceCalcualtion()">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                        Types</label>
                                    <div class="col-sm-9">
                                        <select ng-model="parcel_type" class="form-control form-control-lg"
                                                name="parcel_type_id" ng-change="update()">
                                            {{-- <option value="0">
                                                 Select
                                             </option>--}}

                                            <option ng-repeat="x in parcels" value="@{{x.parcel_type_id}}"
                                                    ng-selected="1">
                                                @{{x.title}}
                                            </option>
                                        </select>


                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">COD</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder="0"
                                               value="{{$cod_charge}}" name="cod"
                                               readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="delivery_charge" class="col-sm-3 col-form-label">Delivery Charge</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder="0"
                                               id="delivery_charge" name="delivery_charge" ng-model="delivery_charge"
                                               readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Total
                                        Amount</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder="Total Amount"
                                               id="example-text-input-lg" name="total_amount" ng-model="total_amount">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Same Day
                                        Delivery</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" id="is_same_day" switch="none" checked=""
                                               name="is_same_day"
                                               onchange="if(!this.checked){isSameDayTrue() }else{isSameDayFalse()}">
                                        <label for="is_same_day" data-on-label="ON" data-off-label="OFF"></label>
                                        <span>Check if not delivered in today</span>
                                    </div>
                                </div>

                                <div class="form-group" id="delivery_date" style="display: none">
                                    <div class="row">
                                        <label for="example-text-input-lg" class="col-sm-3 col-form-label"> Delivery
                                            Date</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-lg"
                                                   placeholder="yyyy-mm-dd"
                                                   id="datepicker-autoclose" name="delivery_date">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <h5 class=" mb-3">Customer Information </h5>
                                <hr>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder="Name"
                                               id="example-text-input-lg" name="customer_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Phone</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder="Phone"
                                               id="example-text-input-lg" name="customer_phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Address</label>
                                    <div class="col-sm-9">
                               <textarea class="form-control form-control-lg" type="text" placeholder="Customer Address"
                                         id="example-text-input-lg" name="customer_address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">
                                        Note</label>
                                    <div class="col-sm-9">
                               <textarea class="form-control form-control-lg" type="text" placeholder="Write Note..."
                                         id="example-text-input-lg" name="parcel_notes"></textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Reset
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
