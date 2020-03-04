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
                    {{--<h5 class="card-title">Add New Parcel</h5>
--}}{{--                    <a href="/tttttt/view" type="butoon" class="card-title float-right"> Parcel View </a>--}}{{--
                    <hr>--}}
                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('failed') }}</p>
                    @endif

                    <form class="custom-validation" action="/merchant/parcel/update" method="post" enctype="multipart/form-data"
                          novalidate="">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class=" mb-3">Parcel Information </h5>
                                <hr>

                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Invoice</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder=""
                                               id="example-text-input-lg" name="parcel_invoice" value="{{$invoice}}" readonly>
                                        <input type="hidden" name="_token" value="{{{csrf_token()}}}">
                                        <input type="hidden" name="parcel-id" value="{{$result->parcel-id}}">
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
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                        Types</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-lg" name="parcel_type_id"
                                                id="my_parcel">

                                            <option value="0">Select</option>
                                            @foreach($parcel_types as $parcel_type)
                                                <option value="{{$parcel_type->parcel_type_id}}">
                                                    {{$parcel_type->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">Parcel
                                        Price</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text"
                                               placeholder="Parcel price"
                                               id="example-text-input-lg" name="payable_amount" value="{{$result->payable_amount}}">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">COD</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder="0"
                                               id="example-text-input-lg" name="cod" value="{{$cod_charge}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="delivery_charge" class="col-sm-3 col-form-label">Delivery Charge</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-lg" type="text" placeholder="0"
                                               id="delivery_charge" name="delivery_charge"   ng-model="delivery_charge">
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
                                               name="is_same_day" value="{{$result->is_same_day}}"
                                               onchange="if(!this.checked){isSameDayTrue() }else{isSameDayFalse()}">
                                        <label for="is_same_day" data-on-label="ON" data-off-label="OFF"></label>
                                        <span>Check if not delivered in today</span>
                                    </div>
                                </div>

                                <div class="form-group row" id="delivery_date" style="display: none">
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label"> Delivery
                                        Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg" placeholder="yyyy-mm-dd"
                                               id="datepicker-autoclose" name="delivery_date" value="{{$result->delivery_date}}">
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
                                    <label for="example-text-input-lg" class="col-sm-3 col-form-label">                                  Note</label>
                                    <div class="col-sm-9">
                               <textarea class="form-control form-control-lg" type="text" placeholder="Write Note..."
                                         id="example-text-input-lg" name="parcel_notes">{{$result->parcel_notes}}</textarea>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                   update
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Reset
                                </button>
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <script>


        /*  var app = angular.module('parcelApp', []);
          app.controller('parcelController', function ($scope, $http) {

              $http.get("/angular")
                  .then(function (response) {
                      // $scope.myWelcome = response.data;
                      console.log(response.data);
                      $scope.parcels = response.data;
                      //$scope.delivery_charge=response.data.charge
                  });
              // console.log(parcel_type);

              function parcelTypeChange(){

                  console.log($scope.my_parcel);
              }


          });*/


        /*  function isSameDayTrue() {
              //var is_same_day = document.getElementById('is_same_day').value;
              document.getElementById('delivery_date').style.display = 'block';

              //console.log(document.getElementById("is_same_day").value);
          }

          function isSameDayFalse() {
              //var is_same_day = document.getElementById('is_same_day').value;
              document.getElementById('delivery_date').style.display = 'none';

              //console.log(document.getElementById("is_same_day").value);
          }

          //Select this using js
          var parcel_type = document.getElementById('parcel_type');

                  //Add event when change happens
                  parcel_type.onchange = function () {
                      var value = parcel_type.value;
                      console.log(value+"000");
                      document.getElementById('delivery_charge').value= value
                  }*/
    </script>

@endsection
