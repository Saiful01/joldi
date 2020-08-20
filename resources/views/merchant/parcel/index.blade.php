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
                    <li class="breadcrumb-item"><a href="#">Add New Parcel, <span style="color: red">You are adding Parcel for {{\Illuminate\Support\Facades\Session::get('shop_name')}}</span>
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Change
                            </button>
                        </a></li>
                    {{--<a class="btn btn-sm btn-danger float-right d-inline" href="">Track Parcel</a>--}}


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
                            <div class="col-md-4">
                                <h5 class=" mb-3">Customer Information </h5>
                                <hr>


                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Name</label>--}}
                                    <div class="col-sm-12">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder="কাস্টমার নাম"
                                               id="example-text-input-lg" name="customer_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Phone</label>--}}
                                    <div class="col-sm-12">
                                        <input class="form-control form-control-lg" type="number"
                                               placeholder=" কাস্টমার ফোন"
                                               id="example-text-input-lg" name="customer_phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Area</label>--}}
                                    <div class="col-sm-12">


                                        <select ng-model="area_id" class="form-control form-control-lg"
                                                name="area_id" ng-change="updateArea()">
                                            {{-- <option value="0">
                                                 Select
                                             </option>--}}
                                            <option value="" selected disabled hidden>Area</option>
                                            <option ng-repeat="x in areas" value="@{{x.area_id}}"
                                                    ng-selected="1">
                                                @{{x.area_name}}
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Address</label>--}}
                                    <div class="col-sm-12">
                               <textarea class="form-control form-control-lg" type="text" placeholder="কাস্টমার ঠিকানা"
                                         id="example-text-input-lg" name="customer_address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">--}}
                                    {{--Note</label>--}}
                                    <div class="col-sm-12">
                               <textarea class="form-control form-control-lg" type="text"
                                         placeholder="কোনো বিশেষ নির্দেশনা"
                                         id="example-text-input-lg" name="parcel_notes"></textarea>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-4">
                                <h5 class=" mb-3">{{$invoice}} </h5>
                                <hr>
                                <input class="form-control form-control-lg" type="hidden" placeholder=""
                                       id="example-text-input-lg" name="parcel_invoice" value="{{$invoice}}"
                                       readonly>

                                {{--    <div class="form-group row">
                                        <label for="example-text-input-lg" class="col-sm-3 col-form-label">Invoice</label>
                                        <div class="col-sm-12">
                                            <input class="form-control form-control-lg" type="hidden" placeholder=""
                                                   id="example-text-input-lg" name="parcel_invoice" value="{{$invoice}}"
                                                   readonly>



                                        </div>
                                    </div>--}}
                                <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                                {{--<input type="hidden" name="area_charge" ng-model="area_charge">--}}
                                <input type="hidden" name="shop_id" value="{{Session::get('shop_id')}}">
                                <input type="hidden" name="is_same_day" value="{{$is_same_day}}">

                                {{--     <div class="form-group row">
                                         <label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                             Title</label>
                                         <div class="col-sm-12">
                                             <input class="form-control form-control-lg" type="text"
                                                    placeholder=""
                                                    id="example-text-input-lg" name="parcel_title">
                                         </div>
                                     </div>--}}

                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                        Types</label>--}}
                                    <div class="col-sm-12">
                                        <select ng-model="parcel_type" class="form-control form-control-lg"
                                                name="parcel_type_id" ng-change="update()">
                                            {{-- <option value="0">
                                                 Select
                                             </option>--}}
                                            <option value="" selected disabled hidden>ওজন</option>
                                            <option ng-repeat="x in parcels" value="@{{x.parcel_type_id}}"
                                                    ng-selected="1">
                                                @{{x.title}}
                                            </option>
                                        </select>


                                    </div>
                                </div>
                                <div class="form-group row" style="display: none;">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">COD</label>--}}
                                    <div class="col-sm-12">
                                        <input class="form-control form-control-lg" type="text" placeholder="0"
                                               value="{{$cod_charge}}" name="cod" ng-model="cod_charge"
                                        >
                                    </div>
                                </div>
                                <div class="form-group row" style="display: none">
                                    <label for="delivery_charge" class="col-sm-3 col-form-label">Delivery Charge</label>
                                    <div class="col-sm-12">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder="ডেলিভারি চার্জ"
                                               id="delivery_charge" name="delivery_charge" ng-model="delivery_charge"
                                               readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{-- <label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                         Price</label>--}}
                                    <div class="col-sm-12">
                                        <input class="form-control form-control-lg" type="number"
                                               placeholder="পার্সেল  প্রাইস"
                                               id="example-text-input-lg" name="payable_amount"
                                               ng-model="payable_amount" ng-change="totalPriceCalcualtion()">
                                    </div>
                                </div>
                                <div class="form-group row" style="display: none">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Total
                                        Amount</label>
                                    <div class="col-sm-12">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder="মোট টাকা"
                                               id="example-text-input-lg" name="total_amount" ng-model="total_amount">
                                    </div>
                                </div>
                                {{--                                <div class="form-group row">--}}
                                {{--                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Same Day--}}
                                {{--                                        Delivery</label>--}}
                                {{--                                    <div class="col-sm-12">--}}
                                {{--                                        <input type="checkbox" id="is_same_day" switch="none" checked=""--}}
                                {{--                                               name="is_same_day"--}}
                                {{--                                               onchange="if(!this.checked){isSameDayTrue() }else{isSameDayFalse()}">--}}
                                {{--                                        <label for="is_same_day" data-on-label="ON" data-off-label="OFF"></label>--}}
                                {{--                                        <span>Check if not delivered in today</span>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                {{--                                <div class="form-group" id="delivery_date" style="display: none">--}}
                                {{--                                    <div class="row">--}}
                                {{--                                        <label for="example-text-input-lg" class="col-sm-3 col-form-label"> Delivery--}}
                                {{--                                            Date</label>--}}
                                {{--                                        <div class="col-sm-12">--}}
                                {{--                                            <input type="text" class="form-control form-control-lg"--}}
                                {{--                                                   placeholder="yyyy-mm-dd"--}}
                                {{--                                                   id="datepicker-autoclose" name="delivery_date">--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}

                                {{--                                </div>--}}


                                <div class="form-group row" style="display: none;">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">Is Same
                                        day</label>--}}
                                    <div class="col-sm-12">
                                        <input class="form-control form-control-lg" type="hidden" name="is_same_day"
                                               value="{{$is_same_day}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-md-6 col-form-label">Payment
                                        Collection</label>
                                    <div class="col-md-3">
                                        <input class="form-check-input " type="radio" name="is_online_payment"
                                               value="1">
                                        <label class="form-check-label  ">
                                            Yes
                                        </label>

                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-check-input  " type="radio" name="is_online_payment"
                                               value="0" checked>
                                        <label class="form-check-label   ">
                                            No
                                        </label>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label"></label>--}}
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Submit
                                        </button>
                                        {{-- <button type="reset" class="btn btn-secondary waves-effect">
                                             Reset
                                         </button>--}}
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>ডেলিভারি চার্জ বিস্তারিত </h6>
                                        <hr>
                                    </div>
                                    <div class="card-body" style="background-color: rgba(210,210,210,0.47)">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h6>Cash Collection</h6>
                                                <h6>Delivery Charge</h6>
                                                <h6>Cod Charge</h6>
                                                <h6>Area Charge</h6>
                                                <hr>
                                                <h6>Total Payble Amount</h6>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 ng-bind="payable_amount">Tk. 100</h6>
                                                <h6 ng-bind="delivery_charge">Tk. 60</h6>
                                                <h6 ng-bind="cod_charge">Tk. 0</h6>
                                                <h6 ng-bind="area_charge">Tk. 0</h6>
                                                <hr>
                                                <h6 ng-bind="total_amount">Tk. 40</h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Shop Selection</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <form action="/merchant/current/shop">
                        <div class="form-group">
                            <label for="sel1">Select Shop:</label>
                            <select class="form-control" name="shop">
                                @foreach($shops as $shop)
                                    <option value="{{$shop->shop_id}}">{{$shop->shop_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>
        var app = angular.module('parcelCreateApp', []);
        app.controller('parcelController', function ($scope, $http) {

            $scope.delivery_charge = 0;
            $scope.payable_amount = "";
            $scope.total_amount = 0;
            $scope.area_charge = 0;
            $scope.cod_charge = '<?php echo $cod_charge?>';
            $scope.cod = '<?php echo $cod_charge?>';

            $http.get('/get-parcel-type', {}).then(function success(e) {

                console.log(e.data);
                $scope.parcels = e.data;
            });

            $http.get('/get-area', {}).then(function success(e) {

                console.log(e.data);
                $scope.areas = e.data;
            });

            $scope.updateArea = function () {
                console.log($scope.area_id + '---');

                $http.get('/get-area-charge/' + $scope.area_id, {}).then(function success(e) {

                    console.log(e.data.value);
                    $scope.cod_charge = (parseFloat($scope.payable_amount) * parseFloat($scope.cod) / 100);

                    $scope.area_charge = parseFloat(e.data.value);
                    $scope.total_amount = parseFloat($scope.delivery_charge) + parseFloat($scope.payable_amount) + parseFloat($scope.cod_charge) + parseFloat($scope.area_charge);

                    console.log($scope + '--');
                });

            };

            $scope.update = function () {

                $http.get('/get-delivery-charge/' + $scope.parcel_type, {}).then(function success(e) {

                    console.log(e.data.charge);

                    $scope.delivery_charge = parseFloat(e.data.charge);
                    $scope.cod_charge = (parseFloat($scope.payable_amount) * parseFloat($scope.cod) / 100);
                    $scope.total_amount = parseFloat(e.data.charge) + parseFloat($scope.payable_amount) + parseFloat($scope.cod_charge) + parseFloat($scope.area_charge);
                    ;

                    console.log($scope.total_amount);
                });

            };


            $scope.totalPriceCalcualtion = function () {
                $scope.cod_charge = (parseFloat($scope.payable_amount) * parseFloat($scope.cod) / 100);

                $scope.total_amount = parseFloat($scope.delivery_charge) + parseFloat($scope.payable_amount) + parseFloat($scope.cod_charge) + parseFloat($scope.area_charge);

                console.log("hhhh" + parseFloat($scope.delivery_charge) + parseFloat($scope.payable_amount));

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
