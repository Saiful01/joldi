@extends('layouts.app')
@section('title', 'All Consignment')

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
    {{--        <div class="container-fluid page-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h5>Hello, world! Full width Hero-unit header</h5>
                        <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                        <p><a href="#" class="btn btn-primary btn-large">Learn more »</a></p>
                    </div>
                </div>
            </div>--}}
    <div id="printableArea">
        <div class="container-fluid text-white page-header">
            <div class="row ">
                <div class="col-md-6 text-center m-auto ">
                </div>
                <div class="col-md-6 m-auto" style="padding-top: 117px;margin-right: 0px;text-align: right;">
                    <h6 style="line-height: 8px">Abdullah Bin rawaha Street, Building 10, 3rd Floor</h6>
                    <h6 style="line-height: 8px">Amman , Jordan</h6>
                    <h6 style="line-height: 8px">Tel: +962795885109</h6>
                    <h6 style="line-height: 8px">Email:reservation@hotelshop.me</h6>
                    <h6 style="line-height: 8px">Website:www.hotelshop.me</h6>
                </div>
            </div>
        </div>
        <div class="container-fluid  mt-1">

            <div class="row">
                <div style="background-color: #AD9D74" class="col-md-3 text-white">
                    <h4>Standard Guest</h4>
                    <h6>Name: Abdullah Quisi</h6>
                    <h6>Phone: 962799944463 </h6>
                    <h6>Membership 120075XXX</h6>
                </div>
                <div style="background-color: #F0F0F4" class="col-md-9">
                    <h3> Request Info</h3>
                    <h6> Product Type : <span class="ml-5"><i class="fas fa-hotel"></i> Hotel </span> <span
                            class="ml-5"><i class="fas fa-plane"> Air ticket</i></span>
                        <span class="ml-5"><i class="fas fa-truck-pickup"></i> Tour</span> <span class="ml-5"> <i
                                class="fas fa-box-open"></i> Other</span></h6>
                    <h6>Travel Period: <span class="ml-5"> 3/12/2020- 15/13/2020</span> <span
                            class="ml-2">Traveler(s)</span> <span class="ml-2">25</span></h6>
                    <h6>Destination: <span class="ml-5">Cairo, Egypt</span> <span
                            style="margin-left: 100px">Rooms(s)</span> <span class="ml-2">13</span></h6>
                    <h6>Booking Level: <span class="ml-5">Standard</span></h6>
                </div>
            </div>
        </div>

        <div class="container-fluid  mt-5">
            <div class="row">
                <table class="table table-striped">
                    <thead style="background-color: #2f3cab" class="text-white">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Hotel/Airline</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Includes</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Night(s)</th>
                        <th scope="col">Price/Person</th>
                        <th scope="col">#Room</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">03.12.20</th>
                        <td>Pyramids Park Cairo Hotel</td>
                        <td>Cairo</td>
                        <td>Breakfast</td>
                        <td>RJ - AMM-CAI</td>
                        <td>3</td>
                        <td>323 JOD</td>
                        <td>Double</td>
                        <td>646 JOD</td>

                    </tr>
                    <tr style="background-color:antiquewhite">
                        <th scope="row">03.12.20</th>
                        <td>Pyramids Park Cairo Hotel</td>
                        <td>Cairo</td>
                        <td>Breakfast</td>
                        <td>RJ - AMM-CAI</td>
                        <td>3</td>
                        <td>323 JOD</td>
                        <td>Double</td>
                        <td>646 JOD</td>

                    </tr>
                    <tr>
                        <th scope="row">03.12.20</th>
                        <td>Pyramids Park Cairo Hotel</td>
                        <td>Cairo</td>
                        <td>Breakfast</td>
                        <td>RJ - AMM-CAI</td>
                        <td>3</td>
                        <td>323 JOD</td>
                        <td>Double</td>
                        <td>646 JOD</td>

                    </tr>
                    <tr style="background-color:antiquewhite">
                        <th scope="row">03.12.20</th>
                        <td>Pyramids Park Cairo Hotel</td>
                        <td>Cairo</td>
                        <td>Breakfast</td>
                        <td>RJ - AMM-CAI</td>
                        <td>3</td>
                        <td>323 JOD</td>
                        <td>Double</td>
                        <td>646 JOD</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container-fluid  mt-2">
            <div class="row">
                <table class="table table-striped">
                    <thead style="background-color: sandybrown" class="text-white">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Hotel/Airline</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Includes</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Night(s)</th>
                        <th scope="col">Price/Person</th>
                        <th scope="col">#Room</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">03.12.20</th>
                        <td>Pyramids Park Cairo Hotel</td>
                        <td>Cairo</td>
                        <td>Breakfast</td>
                        <td>RJ - AMM-CAI</td>
                        <td>3</td>
                        <td>323 JOD</td>
                        <td>Double</td>
                        <td>646 JOD</td>

                    </tr>
                    <tr style="background-color:antiquewhite">
                        <th scope="row">03.12.20</th>
                        <td>Pyramids Park Cairo Hotel</td>
                        <td>Cairo</td>
                        <td>Breakfast</td>
                        <td>RJ - AMM-CAI</td>
                        <td>3</td>
                        <td>323 JOD</td>
                        <td>Double</td>
                        <td>646 JOD</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container-fluid  mt-2">
            <div class="row">
                <table class="table table-striped">
                    <thead style="background-color: red" class="text-white">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Hotel/Airline</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Includes</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Night(s)</th>
                        <th scope="col">Price/Person</th>
                        <th scope="col">#Room</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">03.12.20</th>
                        <td>Pyramids Park Cairo Hotel</td>
                        <td>Cairo</td>
                        <td>Breakfast</td>
                        <td>RJ - AMM-CAI</td>
                        <td>3</td>
                        <td>323 JOD</td>
                        <td>Double</td>
                        <td>646 JOD</td>
                    <tr>
                        <th scope="row">03.12.20</th>
                        <td>Pyramids Park Cairo Hotel</td>
                        <td>Cairo</td>
                        <td>Breakfast</td>
                        <td>RJ - AMM-CAI</td>
                        <td>3</td>
                        <td>323 JOD</td>
                        <td>Double</td>
                        <td>646 JOD</td>

                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <p class="text-danger ml-2">**Please note that the above is only an offer so we can't guarantee any
                    availability or rates as it's subject to change</p>
            </div>
        </div>

        <div class="container-fluid page-footer">
            <div class="row">
                <div class="col-md-3 text-dark" style="margin-top: 100px; color: #2F2B5C">
                    <h4>AT YOUR <br> ASSISTANCE</h4>
                </div>
                <div class="col-md-4" style="margin-top: 140px; color: #2F2B5C">
                    <h6>Phone: 1111111</h6>
                    <h6>Email:lll@lll.com</h6>
                </div>
                <div class="col-md-2" class="col-md-4" style="margin-top: 100px; color: #2F2B5C">
                    <h4>Rakan Nazer</h4>
                    <h6>Head of Travel Expert</h6>
                    <h6>Concierge Team</h6>
                </div>
                <div class="col-md-3" style="padding-left: 59px;padding-top: 19px;">
                    <img class="rounded-circle" src="/assets/images/users/user-3.jpg" width="    width: 143px;"/>
                </div>
            </div>
        </div>

    </div>


    <div id="printableArea">
        <h1>Print me</h1>
    </div>

    <input type="button" onclick="printDiv('printableArea')" value="print a div!"/>



    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
