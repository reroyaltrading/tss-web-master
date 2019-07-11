angular.module("InsightCRM").controller("RecordingController", function($scope, $http, $window){
    $scope.loading_recordings = false;

    $scope.LoadRecordings = function()
    {
        $scope.loading_recordings = true;
        var json_url = base_url + "/api/recordings/list";
        $http.get(json_url).success(function($data){
            $scope.recordings = $data;
            $scope.loading_recordings = false;
        });
    };
});