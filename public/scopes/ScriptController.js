angular.module("InsightCRM").controller("ScriptController", function($scope, $http, $window){
    $scope.loading_scripts = false;
    $scope.scripts = {};
    $scope.companies = {};
    $scope.statuses = {};

    $scope.script = {};

    $scope.LoadScripts = function()
    {
        $scope.loading_clients = true;
        var json_url = base_url + "/api/scripts/list";
        $http.get(json_url).success(function($data){
            $scope.scripts = $data;
            console.log($scope.scripts);
            $scope.loading_scripts = false;
        });
    };

    $scope.LoadData = function()
    {
        $scope.LoadCompanies();
        $scope.LoadStatuses();
        $scope.LoadScript();
    }

    $scope.LoadCompanies = function()
    {
        var json_url = base_url + "/api/companies/list";
        $http.get(json_url).success(function($data){
            $scope.companies = $data;
        });
    };

    $scope.LoadStatuses = function()
    {
        var json_url = base_url + "/api/statuses/list";
        $http.get(json_url).success(function($data){
            $scope.statuses = $data;
        });
    };

    $scope.SaveScript = function()
    {
        $scope.script.content = $('.note-editable').html();
        var json_url = base_url + "/api/scripts/save";
        $http.post(json_url, $scope.script).then(function(response){   console.log(response) });
    }

    $scope.LoadScript = function()
    {
        var $id = $("#id").val();
        if($id > 0)
        {
            var json_url = base_url + "/api/scripts/get?id=" + $id;
            $http.get(json_url).success(function($data){
                $scope.script = $data;
            });
        }
    }

    $scope.DeleteScript = function($id)
    {
        var json_url = base_url + "/api/scripts/delete?id=" + $id;
        $http.get(json_url).success(function($data){
            if($data.deleted)
            {
                $scope.LoadScripts();
            }
        });
    }

    
});