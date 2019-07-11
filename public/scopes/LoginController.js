angular.module("InsightCRM").controller("LoginController", function($scope, $http, $window){
    $scope.user = {};

    $scope.logging = false;
    $scope.loginTried = false;
    $scope.loginError = false;
  
  
    $scope.doLogin = function()
    {
      $scope.logging = true;
      var post_url = base_url + "/api/login";    
      console.log('logging');
  
  
         $http({
          method  : 'POST',
          url     : post_url,
          data    : $.param($scope.user), 
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
         }).success(function($data) {
          $scope.loginTried = true;
          //$scope.loginError = !$data.auth;
          
          if($data.auth)
          {
            //console.log($data);
            $window.location.href = $("#dash_main").val();
          }else{
            doErrorMessage('Fail to login, ceck your user and password', 'Error');
          }
  
          $scope.logging = false;
        });
    };

    $scope.completeRecoverLogin = function()
    {
        $scope.user.hash = $("#hash").val();

        $scope.logging = true;
        
        var post_url = base_url + "/api/auth/complete_recover";    
        console.log('recovering');  
  
         $http({
            method  : 'POST',
            url     : post_url,
            data    : $.param($scope.user), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
         }).success(function($data) {
            $scope.loginTried = true;
            
            if($data.revovered)
            {
              $window.location.href = $("#loginpage").val() + "?utm_source=password_recovery";
            }else{
              doErrorMessage('Fail to recover you account', 'Error');
            }
    
            $scope.logging = false;
        });
    }

    $scope.recoverLogin = function()
    {
        $scope.logging = true;
        var post_url = base_url + "/api/auth/recover";    
        console.log('recovering');  
  
         $http({
            method  : 'POST',
            url     : post_url,
            data    : $.param($scope.user), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
         }).success(function($data) {
            $scope.loginTried = true;
            
            if($data.revovered)
            {
              doSuccessMessage('We sent a link on your e-mail, please check it', 'Success');
            }else{
              doErrorMessage('Fail to recover you account', 'Error');
            }
    
            $scope.logging = false;
        });
    };
});
  