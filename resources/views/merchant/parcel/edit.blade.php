@extends('layouts.merchant')
@section('title', 'Parcel Edit')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Parcel</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Edit Parcel</a></li>
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

                    <form class="custom-validation" action="/merchant/parcel/update" method="post"
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
                                               id="example-text-input-lg" name="parcel_invoice" value="{{$result->parcel_invoice}}"
                                               readonly>
                                        <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                                        <input type="hidden" name="parcel_id" value="{{$result->parcel_id}}">
                                        <input type="hidden" name="customer_id" value="{{$result->customer_id}}">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                        Title</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder=""
                                               id="example-text-input-lg" name="parcel_title" value="{{$result->parcel_title}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="payable_amount" class="col-sm-3 col-form-label">Parcel
                                        Price</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder="Parcel price"
                                               id="payable_amount" name="payable_amount"  value="{{$result->payable_amount}}"
                                               ng-model="payable_amount" ng-change="totalPriceCalcualtion()">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                        Types</label>
                                    <div class="col-sm-9">
                                        <select ng-model="parcel_type" class="form-control form-control-lg"
                                                name="parcel_type_id" value="{{$result->title}}" ng-change="update()">
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
                                               value="{{$result->cod}}" name="cod"
                                               readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="delivery_charge" class="col-sm-3 col-form-label">Delivery Charge</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder="0"
                                               id="delivery_charge" name="delivery_charge" value="{{$result->delivery_charge}}" ng-model="delivery_charge"
                                               readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Total
                                        Amount</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder="Total Amount"
                                               id="example-text-input-lg" name="total_amount" value="{{$result->total_amount}}" ng-model="total_amount">
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
                                               id="example-text-input-lg" name="customer_name" value="{{$result->customer_name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Phone</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder="Phone"
                                               id="example-text-input-lg" name="customer_phone" value="{{$result->customer_phone}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Address</label>
                                    <div class="col-sm-9">
                               <textarea class="form-control form-control-lg" type="text" placeholder="Customer Address"
                                         id="example-text-input-lg" name="customer_address">{{$result->customer_address}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">
                                        Note</label>
                                    <div class="col-sm-9">
                               <textarea class="form-control form-control-lg" type="text" placeholder="Write Note..."
                                         id="example-text-input-lg" name="parcel_notes">{{$result->parcel_notes}}</textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Update
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

    <script>
        var app = angular.module('parcelCreateApp', []);
        app.controller('parcelController', function ($scope, $http) {

            $scope.delivery_charge = '<?php  echo $result->delivery_charge ?>';
            $scope.payable_amount = '<?php  echo $result->payable_amount ?>';
            $scope.total_amount = '<?php  echo ($result->payable_amount+$result->delivery_charge) ?>';

            $http.get('/get-parcel-type', {}).then(function success(e) {

                console.log(e.data);
                $scope.parcels = e.data;
            });

            $scope.update = function () {

                $http.get('/get-delivery-charge/' + $scope.parcel_type, {}).then(function success(e) {

                    console.log(e.data.charge);

                    $scope.delivery_charge = parseFloat(e.data.charge);
                    $scope.total_amount = parseFloat(e.data.charge) + parseFloat($scope.payable_amount);

                    console.log($scope.total_amount);
                });

            };


            $scope.totalPriceCalcualtion = function () {

                $scope.total_amount = parseFloat($scope.delivery_charge) + parseFloat($scope.payable_amount);

                console.log(parseFloat($scope.delivery_charge) + parseFloat($scope.payable_amount));

                //parseFloat($scope.delivery_charge) + parseFloat($scope.payable_amount) + parseFloat($scope.cod);


            }
        });


        function isSameDayTrue() {
            //var is_same_day = document.getElementById('is_same_day').value;
            document.getElementById('delivery_date').style.display = 'block';

            //console.log(document.getElementById("is_same_day").value);
        }

        function isSameDayFalse() {
            //var is_same_day = document.getElementById('is_same_day').value;
            document.getElementById('delivery_date').style.display = 'none';

            //console.log(document.getElementById("is_same_day").value);
        }

    </script>


@endsection
