@extends('layouts.merchant')
@section('title', 'PaymentMethoed create')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Payment Methoed</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Add New Payment Methoed</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('failed') }}</p>
                    @endif
                    <h5 class="card-title">Add New Payment Methoed</h5>
                    <hr>
                    <form class="custom-validation" method="post" action="/merchant/paymentmethoed/store" novalidate=""
                          enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">Payment Methoed Name</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" placeholder="Name"
                                       id="example-text-input-lg" name="payment_methoed_name" required>
                                <input type="hidden" name="_token" value="{{{csrf_token()}}}"/>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">Account Number</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" placeholder="phone"
                                       id="example-text-input-lg" name="account_number" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">Branch address</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="email" placeholder="Address"
                                       id="example-text-input-lg" name="branch_address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">Payee Name</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="email" placeholder="Name"
                                       id="example-text-input-lg" name="payee_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Submit
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

@endsection
