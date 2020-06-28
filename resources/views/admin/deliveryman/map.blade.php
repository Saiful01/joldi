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
            <div id="map" style="margin:50px"></div>
            <script>
                var map;
                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 12,
                        center: new google.maps.LatLng(23.8052091,90.3433764),
                        mapTypeId: 'terrain'
                    });
​
                    // Create a <script> tag and set the USGS URL as the source.
                    var script = document.createElement('script');
                    // This example uses a local copy of the GeoJSON stored at
                    // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
                    script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
                    document.getElementsByTagName('head')[0].appendChild(script);
                }
​
                // Loop through the results array and place a marker for each
                // set of coordinates.
                window.eqfeed_callback = function(results) {
                    //for (var i = 0; i < results.features.length; i++) {

                    var latLng = new google.maps.LatLng(23.8052091,90.3433764);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        map: map
                    });

                    //Next

                    var latLng = new google.maps.LatLng(23.8052071,90.3433754);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        map: map
                    });
                    //Next
                    //var coords = results.features[i].geometry.coordinates;
                    var latLng = new google.maps.LatLng(23.7871595,90.3535339);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        map: map
                    });
                    // }
                }
            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEDWXvfmNADy9lDpov7EBTwSCL5GxL7KM&callback=initMap">
            </script>


        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
