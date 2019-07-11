angular.module("InsightCRM").controller("CalendarController", function($scope, $http, $window){
    
    $scope.LoadEvents = function()
    {
        var json_url = base_url + "/api/calendar/listmonth";
        $http.get(json_url).success(function($data){
            $scope.events = $data;
        });
    }
});