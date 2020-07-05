@extends('layouts.app')
@section('title', 'Deliveryman View')

@section('content')
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Delivery Man Location</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#"> Delivery man Location</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div id="map" style="width: 100%; height: 400px;"></div>

        </div> <!-- end col -->
    </div> <!-- end row -->




    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEDWXvfmNADy9lDpov7EBTwSCL5GxL7KM"></script>



    <script type="text/javascript">
        var locations = [

                @foreach($datas as $data)


            [  '{{$data->address}}', {{$data->lat}},  {{$data->lon }}],

            @endforeach

        ];

        //console.log(locations+"ddddddddddddddddd")

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: new google.maps.LatLng(23.92, 90.25),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {

            console.log(locations.length+"ddddddddddddddddd")
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    </script>
@endsection
