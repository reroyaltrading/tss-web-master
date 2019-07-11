angular.module("InsightCRM").controller("DiallingController", function($scope, $http, $window){
    
    $scope.companies = {};
    $scope.is_locked = false;
    $scope.last_client_id;
    $scope.selector = {};

    $scope.loading_companies = true;
    $scope.loading_client = false;

    $scope.message_add = {};
    $scope.loading_client = false;

    $scope.sending_mail = false;

    $scope.feedback = {};
    $scope.feedback_items_checked = 0;

    $scope.is_call_back = false;

    $scope.single_client = false;

    $scope.LoadCompanies = function()
    {
        var json_url = base_url + "/api/companies/list";
        $http.get(json_url).success(function($data){
            $scope.companies = $data;
            /*$scope.companies.push({
                "company_name": "Select a company",
                "company_id": 0
            });

            $scope.$apply();*/

            $scope.loading_companies = false;
            //console.log($scope.companies);
        });
    };

    $scope.LoadFeedbacks = function()
    {
        var json_url = base_url + "/api/feedback/list";
        $http.get(json_url).success(function($data){
            $scope.feedbacks = $data;
            //console.log($scope.feedbacks);
        });
    };

    $scope.SendFeedback = function()
    {
        $scope.feedback.count = $scope.feedback_items_checked;
        $scope.feedback.client_id = $scope.current_client.id;
        $scope.feedback.hash_import = $scope.current_client.hash_import;

        var json_url = base_url + "/api/feedback/send";
        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.message_add), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {    
            $scope.message_add.message_text = "";
            $("#modalSendClientFeedback").modal("hide");
            $scope.LoadFeedbacks();
        });
    };

    $scope.FeedbackChecker = function(count)
    {
        if(count == $scope.feedback_items_checked)
        {
            $scope.feedback_items_checked--;
        }else{
            $scope.feedback_items_checked = count;
        }
    };

    $scope.CallClient = function()
    {
        var phone = $scope.current_client.phone;
        callbackObj.callClient(phone);
    };

    $scope.WriteFeedback = function()
    {
        $("#modalSendClientFeedback").modal("show");
    };

    $scope.LoadHashes = function()
    {
        var json_url = base_url + "/api/companies/hashes?company_id=" + $scope.selector.company_id;
        $http.get(json_url).success(function($data){
            $scope.hashes = $data;
            //console.log($scope.hashes);
        });
    };

    $scope.LoadStatuses = function()
    {
        var json_url = base_url + "/api/companies/statuses?company_id=" + $scope.selector.company_id + "&hash=" + $scope.selector.hash_stamp;
        $http.get(json_url).success(function($data){
            $scope.statuses = $data;
            //console.log($scope.statuses);
        });
    };

    $scope.LoadScript = function()
    {
        var json_url = base_url + "/api/scripts/list?company_id=" + $scope.selector.company_id;
        $http.get(json_url).success(function($data){
            $scope.script = $data[0];
            $("#script_content").html($scope.script.content);
            //console.log($scope.script);
        });
    };

    $scope.LoadNotes = function()
    {
        var json_url = base_url + "/api/clients/notes/list?id=" + $scope.current_client.id;
        $http.get(json_url).success(function($data){
            $scope.client_notes = $data;
            //console.log($scope.client_notes);
        });
    };

    $scope.GetCompanyNoSelector = function()
    {
        var json_url = base_url + "/api/dialling/noselector";
        $http.get(json_url).success(function($data){
            $scope.selector = $data;
            //console.log($scope.selector);
        });
    };

    $scope.CreateMessage = function()
    {
        var json_url = base_url + "/api/clients/sms/save";

        $scope.message_add.client_id = $scope.current_client.id;

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.message_add), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {    
            $scope.SendSms($scope.current_client.phone, $scope.message_add.message_text);
            $scope.message_add.message_text = "";
            $scope.LoadSms();
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

    $scope.UpdateClient = function($id)
    {
        var json_url = base_url + "/api/clients/get?id=" + $id;
        $http.get(json_url).success(function($data){
            $scope.current_client = $data;
        });
    }

    $scope.EditClient = function($id)
    {
        $scope.LoadCompanies();
        var json_url = base_url + "/api/clients/get?id=" + $id;
        $http.get(json_url).success(function($data){
            $scope.client = $data;
            //console.log($scope.client);
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
            }

            $scope.UpdateClient($scope.current_client.id);
        });
    };

    $scope.CreateNote = function()
    {
        var json_url = base_url + "/api/clients/notes/save";
        $scope.note_add.client_id = $scope.current_client.id;
        $scope.note_add.status_id = $scope.current_client.status_id;

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.note_add), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {
            $scope.note_add.description = "";
            $scope.LoadNotes();
        });
    }

    $scope.LoadSms = function()
    {
        var json_url = base_url + "/api/clients/sms/list?client_id=" + $scope.current_client.id;
        $http.get(json_url).success(function($data){
            $scope.client_messages = $data;
            //console.log($scope.client_messages);
        });
    };

    $scope.LoadAllStatuses = function()
    {
        var json_url = base_url + "/api/statuses/list";
        $http.get(json_url).success(function($data){
            $scope.all_statuses = $data;
            //console.log($scope.all_statuses);
        });
    };

    $scope.UnlockClient = function($id)
    {
        var json_url = base_url + "/api/clients/unlockone?id=" + $id;
        $http.get(json_url).success(function($data){
            //console.log($data);
        });
    };

    $scope.OpenEmailModal = function()
    {
        $("#modalSendMail").modal("show");
    };

    $scope.LoadMailTemplates = function()
    {
        $scope.loading_templates = true;
        var json_url = base_url + "/api/mailling/templates/list";

        $http.get(json_url).success(function($data){
            $scope.templates = $data;
            $scope.loading_templates = false;
        });
    };

    $scope.CloseSession = function()
    {
        if (typeof $scope.current_client !== 'undefined' && $scope.current_client != null)
        {
            $scope.UnlockClient($scope.current_client.id);
            $scope.is_locked = false;
        }
    };

    $scope.LoadMails = function()
    {
        var json_url = base_url + "/api/clients/mail/list?client_id=" + $scope.current_client.id;;
        $http.get(json_url).success(function($data){
            $scope.client_emails = $data;
        });
    };

    $scope.LoadSingleClient = function(id)
    {
        $scope.single_client = true;
        var json_url = base_url + "/api/clients/get?id=" + id;
        $http.get(json_url).success(function($data){
            $scope.current_client = $data;
            $scope.LoadScript();
            $scope.LoadNotes();
            $scope.LoadSms();
            $scope.LoadMails();
            $scope.LoadFeedbacks();
            $scope.LoadPurchases();
            $scope.is_locked = true;
        });
    };

    $scope.LoadPurchases = function()
    {
        if (typeof $scope.current_client !== 'undefined' && $scope.current_client != null)
        {
            var json_url = base_url + "/purchases/list/user?email=" + $scope.current_client.email + "&phone=" + $scope.current_client.phone;
            $http.get(json_url).success(function($data){
                $scope.purchases = $data;
            });
        }
    };

    $scope.NextClientCallBack = function()
    {
        $scope.is_call_back = true;

        if (typeof $scope.current_client !== 'undefined' && $scope.current_client != null)
        {
            $scope.UnlockClient($scope.current_client.id);
        }

        var json_url = base_url + "/api/clients/nextclient_callbacks";
        $scope.loading_client = true;

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.current_client), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {

            $scope.is_locked = $data.found;
            $scope.current_client = $data.client;

            console.log($data);

            if(!$data.found)
            {
                //alert("No client found");
                doErrorMessage("We couldn't found a client with these especifications");
            }else{
                $scope.LoadScript();
                $scope.LoadNotes();
                $scope.LoadSms();
                $scope.LoadMails();
                $scope.LoadFeedbacks();
                $scope.LoadPurchases();
            }
            $scope.loading_client = false;
        });
    };

    $scope.NextClient = function()
    {
        if (typeof $scope.current_client !== 'undefined' && $scope.current_client != null)
        {
            $scope.UnlockClient($scope.current_client.id);
        }

        var json_url = base_url + "/api/clients/nextclient";
        $scope.loading_client = true;
        //$scope.selector.hash_stamp = $scope.selector.hash_import;

        $http({
            method  : 'POST',
            url     : json_url,
            data    :  $.param($scope.selector), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        }).success(function($data) {

            $scope.is_locked = $data.found;
            $scope.current_client = $data.client;

            console.log($data);

            if(!$data.found)
            {
                //alert("No client found");
                doErrorMessage("We couldn't found a client with these especifications");
            }else{
                $scope.LoadScript();
                $scope.LoadNotes();
                $scope.LoadSms();
                $scope.LoadMails();
                $scope.LoadFeedbacks();
            }
            $scope.loading_client = false;
        });
    };

    $scope.GetLastStatuses = function()
    {
        var json_url = base_url + "/api/clients/last_statuses?id=" + $scope.current_client.id;
        $http.get(json_url).success(function($data){
            $scope.last_statuses = $data;
        });
    }

    $scope.GetTemplateHtml = function()
    {
        var $id = $scope.template_id;
        var json_url = base_url + "/api/mailling/template/get?id=" + $id;
        $http.get(json_url).success(function($data){
            $scope.selected_template = $data;
            $('.note-editable').html($data.content);
        });
    };

    $scope.SendMailClient = function()
    {
        $scope.sending_mail = true;
        $scope.send_mail = {};
        $scope.send_mail.client_name = $scope.current_client.name;
        $scope.send_mail.client_email = $scope.current_client.email;
        $scope.send_mail.template_id = $scope.template_id;
        $scope.send_mail.client_id = $scope.current_client.id;
        $scope.send_mail.content = $('.note-editable').html();
        $scope.send_mail.title = $scope.mail_title;

        var json_url = base_url + "/api/mailling/send";
        $http.post(json_url, $scope.send_mail).then(function(response){   
            $scope.sending_mail = false;
            if(response.data.created)
            {
                doSuccessMessage("Mail sent sucessfully");
            }else{
                doErrorMessage("Mail could not be sent");
            }
        });
    };
});