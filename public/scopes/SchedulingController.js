

angular.module("InsightCRM").controller("SchedulingController", function($scope, $http, $window){
    $scope.loading_schedulling = true;
    $scope.schedullings = {};

    $scope.LoadSchedulling = function()
    {
        $scope.loading_schedulling = true;
        var json_url = base_url + "/api/sheculing/calls";
        $http.get(json_url).success(function($data){
            $scope.schedullings = $data;
            $scope.loading_schedulling = false;
        });
    };
});