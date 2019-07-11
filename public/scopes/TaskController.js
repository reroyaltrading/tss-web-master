angular.module("InsightCRM").controller("TaskController", function($scope, $http, $window){
    $scope.loading_tasks = false;

    $scope.LoadTasks = function()
    {
        $scope.loading_tasks = true;
        var json_url = base_url + "/api/tasks/list";
        $http.get(json_url).success(function($data){
            $scope.tasks = $data;
            $scope.loading_tasks = false;
            console.log($scope.tasks);
        });
    };

    $scope.AssignTask = function($task)
    {
        $scope.task = $task;
        $scope.LoadCompanies();
        $scope.LoadHashes();
        $scope.LoadStatuses();
        $("#modalSaveTask").modal("show");
    };

    $scope.LoadStatuses = function()
    {
        var json_url = base_url + "/api/companies/statuses?company_id=" + $scope.task.company_id + "&hash=" + $scope.task.hash_import;
        $http.get(json_url).success(function($data){
            $scope.statuses = $data;
            console.log($scope.statuses);
        });
    };

    $scope.SaveTask = function()
    {
        var json_url = base_url + "/api/tasks/save";

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.task), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {  
            $("#modalSaveTask").modal("hide");              
            $scope.LoadTasks();
        });
    };

    $scope.LoadUsers = function()
    {
        $scope.loading_users = true;
        var json_url = base_url + "/api/users/list";
        $http.get(json_url).success(function($data){
            $scope.users = $data;
            $scope.loading_users = false;
            console.log($scope.users);
        });
    };

    $scope.LoadCompanies = function()
    {
        var json_url = base_url + "/api/companies/list";
        $http.get(json_url).success(function($data){
            $scope.companies = $data;
            $scope.loading_companies = false;
            console.log($scope.companies);
        });
    };

    $scope.LoadHashes = function()
    {
        var json_url = base_url + "/api/companies/hashes?company_id=" + $scope.task.company_id;
        $http.get(json_url).success(function($data){
            $scope.hashes = $data;
            console.log($scope.hashes);
        });
    };
});
