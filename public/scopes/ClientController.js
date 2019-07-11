angular.module("InsightCRM").controller("ClientController", function($scope, $http, $window){
    $scope.loading_clients = false;
    $scope.clients = {};
    $scope.companies = {};

    $scope.total_pages = 0;
    $scope.items_per_page = 10;

    $scope.selector = {};
    $scope.selector.company_id = 0;
    $scope.selector.hash_import = 0;

    $scope.UnlockAll = function()
    {
        $scope.loading_clients = true;
        var json_url = base_url + "/api/clients/unlockall";
        $http.get(json_url).success(function($data){
            $scope.LoadClients($scope.page);
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

    $scope.LockAll = function()
    {
        $scope.loading_clients = true;
        var json_url = base_url + "/api/clients/lockall";
        $http.get(json_url).success(function($data){
            $scope.LoadClients($scope.page);
        });
    };  

    $scope.OpenModalPurchases = function(phone, email)
    {
        var json_url = base_url + "/purchases/list/user?email=" + email + "&phone=" + phone;
        $http.get(json_url).success(function($data){
            $("#modalPurchases").modal("show");
            $scope.purchases = $data;
        });
    };

    $scope.LoadHashes = function()
    {
        var json_url = base_url + "/api/companies/hashes?company_id=" + $scope.selector.company_id;
        $http.get(json_url).success(function($data){
            $scope.hashes = $data;
            console.log($scope.hashes);
        });
    };

    $scope.GetArrayPages = function()
    {
        return new Array(total_pages); 
    }

    $scope.ExportClients = function()
    {
        var json_url = base_url + "/api/clients/list/export?items_per_page=" + $scope.items_per_page + "&company_id=" + $scope.selector.company_id + "&hash_import=" + $scope.selector.hash_import;
        $window.open(json_url, '_blank');

    }

    $scope.LoadClients = function(page)
    {
        $scope.loading_clients = true;
        var json_url = base_url + "/api/clients/list?page=" + page + "&items_per_page=" + $scope.items_per_page + "&company_id=" + $scope.selector.company_id + "&hash_import=" + $scope.selector.hash_import;
        $http.get(json_url).success(function($data){
            $scope.clients = $data.clients;
            $scope.total_pages = $data.total_pages;
            $scope.page = $data.page;
            $scope.items_per_page = $data.items_per_page;
            console.log($scope.clients);
            $scope.loading_clients = false;
        });
    };

    $scope.UnlockClient = function(id, locked)
    {
        var json_url = base_url + (locked ? "/api/clients/one/unlock" :  "/api/clients/one/lock") + "?client_id=" + id;
        $http.get(json_url).success(function($data){
            if($data.created)
            {
                $scope.LoadClients($scope.page);
            }
        });
    };

    $scope.OpenSMSSender = function($phone)
    {
        $scope.send_sms_number = $phone;
        $("#modalSendSms").modal("show");
    };
    
    $scope.SendSms = function()
    {
        $scope.SendSmsByPhone($scope.send_sms_number, $scope.send_sms_message);
    };

    $scope.EditClient = function($id)
    {
        $scope.LoadCompanies();
        var json_url = base_url + "/api/clients/get?id=" + $id;
        $http.get(json_url).success(function($data){
            $scope.client = $data;
            console.log($scope.client);
            $("#modalEditClient").modal("show");
        });
    };

    $scope.CreateClient = function()
    {
        $scope.client = null;
        $("#modalEditClient").modal("show");
    };

    $scope.SaveClient = function()
    {
        var json_url = base_url + "/api/clients/save";

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.client), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {
            if(!$data.created)
            {
                doErrorMessage("SMS could not be sent");
            }else{
                $("#modalEditClient").modal("hide");
                $scope.LoadClients($scope.page);                
            }
        });
    };

    $scope.DeleteClient = function($id)
    {
        var json_url = base_url + "/api/clients/delete?id=" + $id;
        $http.get(json_url).success(function($data){
           if($data.deleted)
           {
                doSuccessMessage("Client deleted sucessfully");
                $scope.LoadClients($scope.page);
           }else{
                doErrorMessage("Client could not be deleted");
           }
        });
    };

    $scope.LoadCompanies = function()
    {
        var json_url = base_url + "/api/companies/list";
        $http.get(json_url).success(function($data){
            $scope.companies = $data;
            console.log($scope.companies);
        });
    };

    $scope.SendSmsByPhone = function($phone, $message)
    {
        var json_url = base_url + "/sms/send.php";

        $scope.message_temp = {};
        $scope.message_temp.phone = $phone;
        $scope.message_temp.message = $message;

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.message_temp), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {
            if($data.sent)
            {
                $("#modalSendSms").modal("hide");
                doSuccessMessage("SMS sent sucessfully");
                $scope.send_sms_message = "";
            }else{
                $("#modalSendSms").modal("hide");
                doErrorMessage("SMS could not be sent");
            }
        });
    };
});