angular.module("InsightCRM").controller("ImportController", function($scope, $http, $window){
    var dropzone_url = $("#dropzone_url").val();
    var dZUpload = $("#dropzone_test").dropzone({ url: dropzone_url });
    
    $scope.LoadImports = function()
    {
        $scope.loading_imports = true;
        var json_url = base_url + "/api/imports/list";
        $http.get(json_url).success(function($data){
            $scope.imports = $data;
            $scope.loading_imports = false;
            console.log($scope.imports);
        });
    };

    $scope.CancelUpload = function()
    {
        var json_url = base_url + "/api/imports/cancel";
        Dropzone.options.dropzone_test.removeAllFiles();
        $http.get(json_url).success(function($data){
            $("#modalImportFile").modal("hide");
        });
    };

    $scope.CancelUploadNoMessage = function()
    {
        var json_url = base_url + "/api/imports/cancel";
        $http.get(json_url).success(function($data){
        });
    };

    $scope.GetDropzone = function()
    {
        var json_url = base_url + "/htmls/dropzone.html";
        $http.get(json_url).success(function($data){
            console.log($data);
            $("#dropzone_content").html($data);
        });
    }

    $scope.LoadStatuses = function()
    {
        var json_url = base_url + "/api/statuses/list";
        $http.get(json_url).success(function($data){
            $scope.statuses = $data;
            console.log($scope.statuses);
        });
    };

    $scope.SaveFile = function()
    {
        var json_url = base_url + "/api/imports/save";

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.import), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {
            $("#modalImportFile").modal("hide");  
            $scope.LoadImports();           
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

    $scope.ImportFile = function()
    {
        //$scope.GetDropzone();
        $scope.CancelUploadNoMessage();

        if(!(typeof dZUpload[0].dropzone === 'undefined')){
            dZUpload[0].dropzone.removeAllFiles();  
        }
        
        $("#modalImportFile").modal("show");
    };  

    $scope.ShowProcessFile = function($id)
    {
        var json_url = base_url + "/api/imports/files/list?id=" + $id;
        $http.get(json_url).success(function($data){
            $scope.import_files = $data;
            $("#modalProcessFile").modal("show");
        });
    };

    $scope.LoadProcessFiles = function($id)
    {
        var json_url = base_url + "/api/imports/files/list?id=" + $id;
        $http.get(json_url).success(function($data){
            $scope.import_files = $data;
        });
    }

    $scope.DeleteImport = function($id)
    {
        var json_url = base_url + "/api/imports/delete?id=" + $id;
        $http.get(json_url).success(function($data){
            $scope.LoadImports();
        });
    };

    $scope.ProcessFile = function(file, import_id)
    {
        file.is_processing = true;
        var file_id = file.id;
        var json_url = base_url + "/api/imports/files/import?id=" + file_id;
        $http.get(json_url).success(function($data){
            $scope.LoadProcessFiles(import_id);
            file.is_processing = false;
        });
    };
});