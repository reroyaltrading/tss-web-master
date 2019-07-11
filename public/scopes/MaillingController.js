angular.module("InsightCRM").controller("MaillingController", function($scope, $http, $window){
    $scope.templates = {};
    $scope.loading_templates = false;

    $scope.LoadTemplates = function()
    {
        $scope.loading_templates = true;
        var json_url = base_url + "/api/mailling/templates/list";

        $http.get(json_url).success(function($data){
            $scope.templates = $data;
            $scope.loading_templates = false;
        });
    };

    $scope.DeleteTemplate = function(id)
    {
        $scope.loading_templates = true;
        var json_url = base_url + "/api/mailling/template/delete?id=" + id;

        $http.get(json_url).success(function($data){
            $scope.LoadTemplates();
        });
    };

    $scope.SaveTemplate = function()
    {
        $scope.template = {};

        var id = $("#id").val();

        if(id > 0)
        {
            $scope.template.id = id;
        }

        $scope.template.name = $("#template_name").val();
        $scope.template.content = $('.note-editable').html();

        var json_url = base_url + "/api/mailling/template/save";
        $http.post(json_url, $scope.template).then(function(response){   
            console.log(response);
            if(response.data.created)
            {
                doSuccessMessage("Template saved sucessfully");
            }else{
                doErrorMessage("Template could not be saved");
            }
        });
    };
});