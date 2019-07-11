angular.module("InsightCRM").controller("PurchaseController", function($scope, $http, $window){
    
    $scope.LoadPurchases = function()
    {
        var json_url = base_url + "/api/purchases/listtop";
        $http.get(json_url).success(function($data){
            $scope.purchases = $data;
        });
    }
});