var app = angular.module('parcelApp', []);



app.controller('dashboardController', function ($scope, $http) {

    console.log("lolll");


    $http.get("/statistics")
        .then(function (response) {
            // $scope.myWelcome = response.data;
            console.log(response.data);
            //$scope.parcels = response.data;
            console.log("lolll");

            var chart = new Chartist.Pie("#ct-donut", {series: [response.data.delivery_pending, response.data.delivery_accepted, response.data.delivery_cancelled,response.data.delivery_on_the_way,response.data.delivery_delivered,response.data.delivery_returned], labels: [1, 2, 3,1, 2, 3]}, {
                donut: !0,
                showLabel: !1,
                plugins: [Chartist.plugins.tooltip()]
            });

        });



    app.controller('parcelController', function ($scope, $http) {

        $scope.delivery_charge=0;
        $scope.payable_amount=0;
        $http.get('/get-parcel-type', {}).then(function success(e) {

            console.log(e.data);
            $scope.parcels = e.data;
        });

        $scope.update = function () {

            $http.get('/get-delivery-charge/' + $scope.parcel_type, {}).then(function success(e) {

                console.log(e.data.charge);

                $scope.delivery_charge =parseFloat( e.data.charge);
                $scope.total_amount = parseFloat(e.data.charge) + parseFloat($scope.payable_amount );

                console.log($scope.total_amount);
            });


        };


        $scope.totalPriceCalcualtion = function () {

            $scope.total_amount = parseFloat($scope.delivery_charge)+ parseFloat($scope.payable_amount);

            console.log(parseFloat($scope.delivery_charge) + parseFloat($scope.payable_amount ));

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



});







$(".peity-donut").each(function () {
    $(this).peity("donut", $(this).data())
}), $(".peity-line").each(function () {
    $(this).peity("line", $(this).data())
});
