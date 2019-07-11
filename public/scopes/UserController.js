angular.module("InsightCRM").controller("UserController", function($scope, $http, $window){
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

    $scope.CreateUser = function()
    {
        $scope.user = null;
        $("#modalEditUser").modal("show");
    };

    $scope.DeleteUser = function($id)
    {
        var json_url = base_url + "/api/users/delete?id=" + $id;
        $http.get(json_url).success(function($data){
            if($data.deleted)
           {
                doSuccessMessage("User deleted sucessfully");
           }else{
                doErrorMessage("User could not be deleted");
           }
        });
    };

    $scope.EditPermission = function($id)
    {
        var json_url = base_url + "/api/permissions/list?id=" + $id;
        $http.get(json_url).success(function($data){
            $("#modalEditPermission").modal("show");
            $scope.permission = $data;
            console.log($scope.permission);
        });
    };

    $scope.SavePermissions = function()
    {
        var json_url = base_url + "/api/permissions/save";

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.permission), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {
            $("#modalEditPermission").modal("hide");             
        });
    };

    $scope.EditUser = function($id)
    {
        var json_url = base_url + "/api/users/get?id=" + $id;
        $http.get(json_url).success(function($data){
            $("#modalEditUser").modal("show");
            $scope.user = $data;
            console.log($scope.user);
        });
    }

    $scope.SaveUser = function()
    {
        var json_url = base_url + "/api/users/save";

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.user), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {
            if(!$data.created)
            {
                doErrorMessage("User saved sucessfully");
            }else{
                $("#modalEditUser").modal("hide");
                $scope.LoadUsers();                
            }
        });
    };

    $scope.SendSms = function($phone, $message)
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
                doSuccessMessage("SMS sent sucessfully");
            }else{
                doErrorMessage("SMS could not be sent");
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