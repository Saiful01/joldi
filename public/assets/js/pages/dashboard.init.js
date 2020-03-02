var app = angular.module('parcelApp', []);



app.controller('dashboardController', function ($scope, $http) {

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



});







$(".peity-donut").each(function () {
    $(this).peity("donut", $(this).data())
}), $(".peity-line").each(function () {
    $(this).peity("line", $(this).data())
});