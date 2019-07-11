angular.module("InsightCRM").controller("AppointmentController", function($scope, $http, $window){
    $scope.appointments = {};
    $scope.total_pages = 0;
    $scope.current_page = 0;
    $scope.appointment = {};
    $scope.has_emails = false;

    $scope.LoadAppointments = function($page)
    {
        var json_url = base_url + "/api/appointments/list?page=" + $page;
        $http.get(json_url).success(function($data){
            $scope.appointments = $data.appointments;
            $scope.total_pages = $data.total_pages;
            $scope.current_page = $page;
        });
    };

    $scope.OpenModalAp = function()
    {
        var json_url = base_url + "/api/users/list";
        $http.get(json_url).success(function($data){
            $scope.users = $data;
            $scope.has_emails = false;
            $scope.appointment.emails = "";
            $("#modalSendAppointment").modal("show");
        });
    };

    $scope.SendAppointment = function()
    {
        $scope.sending_mail = true;
        $scope.appointment.content = $('.note-editable').html();
        var json_url = base_url + "/api/appointment/send";

        console.log($scope.appointment);

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.appointment), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {
            $scope.sending_mail = false;

            if($data.send)
            {
                doErrorMessage("Appointment schedulled sucessfully");
            }else{
                doErrorMessage("Appointment could not be schedulled sucessfully");
            }
        });
    };

    $scope.AddUser = function()
    {
        $scope.appointment.emails += (($scope.has_emails ? ";" : "")  + $scope.user_email);
        $scope.has_emails = true;
    };
});