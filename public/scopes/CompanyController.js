angular.module("InsightCRM").controller("CompanyController", function($scope, $http, $window){
    $scope.LoadCompanies = function()
    {
        $scope.loading_companies = true;
        var json_url = base_url + "/api/companies/list";
        $http.get(json_url).success(function($data){
            $scope.companies = $data;
            console.log($scope.companies);
            $scope.loading_companies = false;
        });
    };

    $scope.EditCompany = function($id)
    {
        var json_url = base_url + "/api/companies/get?id=" + $id;
        $http.get(json_url).success(function($data){
            $scope.company = $data;
            $("#modalEditCompany").modal("show");
        });
    };

    $scope.DeleteCompany = function($id)
    {
        var json_url = base_url + "/api/companies/delete?id=" + $id;
        $http.get(json_url).success(function($data){
            if($data.deleted)
            {
                $scope.LoadCompanies();
            }
        });
    };

    $scope.SaveCompany = function()
    {
        var json_url = base_url + "/api/companies/save";
        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.company), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {
            if($data.created)
            {
                $("#modalEditCompany").modal("hide");
                $scope.LoadCompanies();
            }
        });
    };

    
    $scope.CreateCompany = function()
    {
        $scope.company = {};
        $("#modalEditCompany").modal("show");
    };
});