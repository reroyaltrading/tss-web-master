@extends('layouts.admin')

@section('content')
   
<div class="" ng-controller="DiallingController">
<div class="row" ng-hide="is_locked">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list mg-t-30">
                <div class="cmp-tb-hd">
                    <h2>Company Selector</h2>
                    <p>Select the company you're will be working with</p>
                </div>
                
                <img ng-show="loading_companies" src="{{ asset('public/loading.gif') }}" />

                @if($load_client)
                    <div class="" ng-init="LoadSingleClient({{ $client_id }})">
                    </div>
                @else
                    @if($permission->select_company_to_work)                
                        <form name="formSelector" nh-hide="loading_companies" id="formSelector" ng-submit="NextClient()">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="nk-int-mk sl-dp-mn">
                                        <h2></h2>
                                    </div>
                                    <div class="bootstrap-select fm-cmp-mg" ng-init="LoadCompanies()">
                                        <label for="selectCompany">Company</label>
                                        <select required="required" class="selectpicker form-control" ng-change="LoadHashes()" ng-options="company.id as company.name  for company in companies" ng-model="selector.company_id" id="selectCompany">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="nk-int-mk sl-dp-mn">
                                                <h2></h2>
                                        </div>
                                        <div class="bootstrap-select fm-cmp-mg">
                                            <label for="selectCompany">Hash</label>
                                            <select required="required" class="selectpicker form-control" ng-change="LoadStatuses()" ng-options="hash.name as hash.name  for hash in hashes" ng-model="selector.hash_stamp" id="selectHash">
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <div class="nk-int-mk sl-dp-mn">
                                                <h2></h2>
                                        </div>
                                        <div class="bootstrap-select fm-cmp-mg">
                                            <label for="selectCompany">Status</label>
                                            <select required="required" class="selectpicker form-control" ng-options="status.id as status.name  for status in statuses" ng-model="selector.status_id" id="selectStatus">
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="nk-int-mk sl-dp-mn">
                                                <h2></h2>
                                        </div>
                                        <div class="bootstrap-select fm-cmp-mg">
                                            <label for="selectCompany">&nbsp;</label>
                                            <button class="btn btn-success notika-btn-success waves-effect btn-block" ng-disabled="formSelector.$invalid">Lock</button>
                                        </div>
                                </div>
                                <!--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <div class="nk-int-mk sl-dp-mn">
                                                <h2></h2>
                                        </div>
                                        <div class="bootstrap-select fm-cmp-mg">
                                            <label for="selectCompany">&nbsp;</label>
                                            <button class="btn btn-primary notika-btn-success waves-effect btn-block" ng-click="NextClientCallBack()">Callbacks</button>
                                        </div>
                                </div>-->
                            </div>
                        </form>
                    @else
                        <form name="formSelector" nh-hide="loading_companies" id="formSelector" ng-submit="NextClient()">
                            <div class="row" ng-init="GetCompanyNoSelector()">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="nk-int-mk sl-dp-mn">
                                        <h2></h2>
                                    </div>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <label for="selectCompany">Company</label>
                                        <input required="required" readonly="readonly" ng-model="selector.company_name" class="selectpicker form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="nk-int-mk sl-dp-mn">
                                                <h2></h2>
                                        </div>
                                        <div class="bootstrap-select fm-cmp-mg">
                                            <label for="selectCompany">Import</label>
                                            <input required="required" readonly="readonly"  ng-model="selector.hash_import" class="selectpicker form-control" />
                                        </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="nk-int-mk sl-dp-mn">
                                                <h2></h2>
                                        </div>
                                        <div class="bootstrap-select fm-cmp-mg">
                                            <label for="selectCompany">Status</label>
                                            <input required="required" readonly="readonly"  ng-model="selector.status_name" class="selectpicker form-control" />
                                        </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="nk-int-mk sl-dp-mn">
                                                <h2></h2>
                                        </div>
                                        <div class="bootstrap-select fm-cmp-mg">
                                            <label for="selectCompany">&nbsp;</label>
                                            <button class="btn btn-success notika-btn-success waves-effect btn-block" ng-disabled="formSelector.$invalid">Lock</button>
                                        </div>
                                </div>
                            </div>
                        </form>
                    @endif
                @endif
            </div>
        </div>
</div>

<div class="row" ng-show="is_locked">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list mg-t-30">
                <div class="cmp-tb-hd">
                   

                    <div class="row">
                            <div class="col-md-6">
                                    <h2><% current_client.name %></h2>
                                    <p>Select the company you're will be working with</p>
                            </div>
                            <div class="col-md-3">
                                   
                            </div>
                            <div class="col-md-3">
                                <h3 class="text-center">
                                            <% selector.status_name %>
                                </h3>
                                <a class="btn btn-danger notika-btn-danger waves-effect btn-block btn-sm" href="#" ng-click="CloseSession()">Close</a>
                                <button class="btn btn-primary notika-btn-success waves-effect btn-block btn-sm" ng-click="NextClient()" ng-show="!single_client"><span ng-show="loading_client"><i class="fa fa-spinner fa-spin"></i>&nbsp;</span>Next Client</button>
                            </div>
                        </div>  
                </div>

                
                
            <div class="widget-tabs-int">
                
                <div class="widget-tabs-list">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Customer Info</a></li>
                        <li><a data-toggle="tab" href="#menu2">Purchases</a></li>
                        <li><a data-toggle="tab" href="#menu7">Customer Feedback</a></li>
                        <li><a data-toggle="tab" href="#menu1">Script</a></li>
                        <li><a data-toggle="tab" href="#menu3">Notes</a></li>
                        <li><a data-toggle="tab" href="#menu4">SMS</a></li>
                        <li><a data-toggle="tab" href="#menu6">Emails</a></li>
                        <li><a data-toggle="tab" href="#menu5">Calendar</a></li>
                        
                    </ul>
                    <div class="tab-content tab-custom-st">

                        <div id="home" class="tab-pane fade in active">
                            <div class="tab-ctn">
                                <p>
                                    <a href="#" ng-click="EditClient(current_client.id)" class="btn btn-primary">Edit Customer</a>
                                    <a class="btn btn-success notika-btn-success waves-effect" href="tel:<% selector.prefix + current_client.phone %>">Call Client</a>                
                                    <a class="btn btn-warning  notika-btn-secondary waves-effect" ng-click="WriteFeedback()" href="#">Write a Feedback</a>                
                                </p>

                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Name:</strong>&nbsp;<% current_client.name %></p>
                                        <p><strong>Email:</strong>&nbsp;<% current_client.email %></p>
                                        <p><strong>Phone:</strong>&nbsp;<% current_client.phone %></p>
                                        <p><strong>State/Province:</strong>&nbsp;<% current_client.state_province %></p>
                                        <p><strong>Import:</strong>&nbsp;<% current_client.hash_import %></p>
                                        <p class="tab-mg-b-0"><strong>Description:</strong>&nbsp;<% current_client.hash_import %></p>
                                    </div>
                                    <div class="col-md-6">
                                            <form  ng-submit="CreateNote()">
                                                    <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 10px;" ng-init="LoadAllStatuses()">
                                                                    <div class="form-example-int form-example-st">
                                                                        <label for="">Status:</label>
                                                                        <div class="form-group">
                                                                            <select required="required" class="selectpicker form-control" ng-options="status.id as status.name for status in all_statuses" ng-model="current_client.status_id" id="selectStatus">
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                                <div class="form-example-int form-example-st">
                                                                    <label for="">Date to Call (If callback):</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="datepicker_client_status" required="current_client.status_id != 4" ng-disabled="current_client.status_id != 4" ng-model="note_add.date_to_call" placeholder="Enter Date">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                                    <div class="form-example-int form-example-st">
                                                                        <label for="">Time to Call (If callback):</label>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="timepicker" required="current_client.status_id != 4" ng-disabled="current_client.status_id != 4" ng-model="note_add.time_to_call" placeholder="Enter Time">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                                    <div class="form-example-int form-example-st">
                                                                        <label for="">Description:</label>
                                                                        <div class="form-group">
                                                                            <textarea type="text" class="form-control" required="required" ng-model="note_add.description" placeholder="Enter Note"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                            <div class="form-example-int">
                                                                <button type="submit" class="btn btn-success notika-btn-success waves-effect btn-block">Add Note</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                    </div>
                                </div>
                                <hr>

                                <p ng-hide="last_statuses.length > 0">No status update registred</p>
                                <div class="table-responsive" ng-show="last_statuses.length > 0">
                                    <table class="table table-stripped">
                                        <thead>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Operator</th>
                                            <th>Date Call</th>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="status in last_statuses">
                                                <td><% $index+1%></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="tab-ctn">
                                <p class="" id="script_content" name="script_content"></p>
                            </div>
                        </div>
                        <div id="menu7" class="tab-pane fade">
                            <div class="tab-ctn">
                                    <table class="table table-sc-ex">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Message</th>
                                                    <th>Creator</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="feedback in feedbacks">
                                                    <td><% feedback.id %></td>
                                                    <td><% feedback.starts %></td>
                                                    <td><% feedback.description %></td>
                                                </tr>
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <div class="tab-ctn">
                                <table class="table table-sc-ex">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Order Total</th>
                                            <th>Order Task</th>
                                            <th>Paid Date</th>
                                            <th>Company</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="purchase in purchases">
                                            <td><% purchase.order_id %></td>
                                            <td><% purchase.order_total %></td>
                                            <td><% purchase.order_tax %></td>
                                            <td><% purchase.paid_date %></td>
                                            <td><% purchase.order_status %></td>
                                            <td><% purchase.company %></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                                <div class="tab-ctn">
                                        <form  ng-submit="CreateNote()">
                                           
                                            <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" ng-init="LoadAllStatuses()">
                                                            <div class="form-example-int form-example-st">
                                                                <div class="form-group">
                                                                    <select required="required" class="selectpicker form-control" ng-options="status.id as status.name for status in all_statuses" ng-model="current_client.status_id" id="selectStatus">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="form-example-int form-example-st">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="datepicker_client_status_two" required="current_client.status_id != 4" ng-disabled="current_client.status_id != 4" ng-model="note_add.date_to_call" placeholder="Enter Note">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                            <div class="form-example-int form-example-st">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="timepicker" required="current_client.status_id != 4" ng-disabled="current_client.status_id != 4" ng-model="note_add.time_to_call" placeholder="Enter Time">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <div class="form-example-int form-example-st">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" required="required" ng-model="note_add.description" placeholder="Enter Note">
                                                                </div>
                                                            </div>
                                                        </div>
                                                <div class="col-lg-1 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="form-example-int">
                                                        <button type="submit" class="btn btn-success notika-btn-success waves-effect btn-block">Add Note</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                            <hr>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                                                    <table class="table table-sc-ex">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Description</th>
                                                                    <th>Status</th>
                                                                    <th>Date To Call Back</th>
                                                                    <th>Creator</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr ng-repeat="note in client_notes">
                                                                    <td><% note.id %></td>
                                                                    <td><% note.description %></td>
                                                                    <td><% note.status_name %></td>
                                                                    <td><% note.date_to_call %></td>
                                                                    <td><% note.user_name %></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            
                            <div id="menu5" class="tab-pane fade">
                                    <div class="tab-ctn" style="min-height: 300px;">
                                        <div class="col-md-8">
                                        </div>
                                        <div class="col-md-4">
                                            <div id='calendar'></div>
                                        </div>
                                    </div>
                            </div>

                            <div id="menu6" class="tab-pane fade">
                                    <div class="tab-ctn">
                                            <button type="button" class="btn btn-success notika-btn-success waves-effect" ng-click="OpenEmailModal()">Send Email</button>
                                            <hr>
                                            <table class="table table-sc-ex">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Template</th>
                                                            <th>Created by</th>
                                                            <th>Created at</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="mail in client_emails">
                                                            <td><% mail.id %></td>
                                                            <td><% mail.template_name %></td>
                                                            <td><% mail.user_name %></td>
                                                            <td><% mail.created_at %></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                    </div>
                                </div>
                            
                            <div id="menu4" class="tab-pane fade">
                                    <div class="tab-ctn">
                                            <form class="row" ng-submit="CreateMessage()">
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <div class="form-example-int form-example-st">
                                                            <div class="form-group">
                                                                <div class="">
                                                                    <input type="text" ng-model="message_add.message_text" class="form-control" placeholder="Enter Text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <div class="form-example-int">
                                                            <button type="submit" class="btn btn-success notika-btn-success waves-effect btn-block">Send SMS</button>
                                                        </div>
                                                    </div>
                                                </form>

                                                <hr>
                                                <div class="row">
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" style="margin-top: 20px;">
                                                                <table class="table table-sc-ex">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Message</th>
                                                                                <th>Creator</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr ng-repeat="message in client_messages">
                                                                                <td><% message.id %></td>
                                                                                <td><% message.message_text %></td>
                                                                                <td><% message.user_name %></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                        </div>
                                                    </div>

                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<form ng-submit="SendMailClient()">
        <div class="modal fade" id="modalSendMail" name="modalSendMail" role="dialog" style="display: none;" ng-init="LoadMailTemplates()">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <h2>Send SMS</h2>
                        
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">User Name</label>
                            <input required="required" ng-model="current_client.name" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">User Email</label>
                            <input required="required" readonly="readonly" ng-model="current_client.email" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Template</label>
                            <select required="required" class="selectpicker form-control" ng-change="GetTemplateHtml()" ng-options="template.id as template.name  for template in templates" ng-model="template_id" id="template_id">
                                </select>
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Title</label>
                            <input required="required" ng-model="mail_title" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg" style="margin-top: 20px;">
                            <div class="html-editor-cm" id="summernote_root">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-top: 5px;">
                        <button type="submit" class="btn btn-default waves-effect"><span ng-show="sending_mail"><i class="fa fa-spin fa-spinner"></i>&nbsp;</span>Send</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

<form ng-submit="SaveClient()">
        <div class="modal fade" id="modalEditClient" name="modalEditClient" role="dialog" style="display: none;">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <h2>Send SMS</h2>
                        
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Name</label>
                            <input required="required" ng-model="client.name" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Phone</label>
                            <input required="required" readonly="readonly" ng-model="client.phone" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">City</label>
                            <input required="required" ng-model="client.city" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">State/Province</label>
                            <input required="required" ng-model="client.state_province" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Postal Code</label>
                            <input required="required" ng-model="client.postal_code" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Optional code</label>
                            <input required="required" ng-model="client.optional_code" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Email</label>
                            <input required="required" ng-model="client.email" class="selectpicker form-control" />
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Company</label>
                            <select required="required" class="selectpicker form-control" ng-options="company.id as company.name  for company in companies" ng-model="client.company_id" id="company_id">
                                </select>
                        </div>
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Description</label>
                            <input ng-model="client.description" class="selectpicker form-control" />
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-top: 5px;">
                        <button type="submit" class="btn btn-default waves-effect">Send</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form ng-submit="SendFeedback()">
        <div class="modal fade" id="modalSendClientFeedback" name="modalSendClientFeedback" role="dialog" style="display: none;">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <h2>Client Feedback</h2>

                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Satisfaction</label>
                            <span class="fa fa-star <% feedback_items_checked >= 1 ? 'checked' : '' %>" ng-click="FeedbackChecker(1)"></span>
                            <span class="fa fa-star <% feedback_items_checked >= 2 ? 'checked' : '' %>" ng-click="FeedbackChecker(2)"></span>
                            <span class="fa fa-star <% feedback_items_checked >= 3 ? 'checked' : '' %>" ng-click="FeedbackChecker(3)"></span>
                            <span class="fa fa-star <% feedback_items_checked >= 4 ? 'checked' : '' %>" ng-click="FeedbackChecker(4)"></span>
                            <span class="fa fa-star <% feedback_items_checked == 5 ? 'checked' : '' %>" ng-click="FeedbackChecker(5)"></span>
                        </div>

                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Description</label>
                            <input required="required" ng-model="feedback.description" class="selectpicker form-control" />
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-top: 5px;">
                        <button type="submit" class="btn btn-default waves-effect">Send</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection

@section('pagescript')

    <link href='{{ asset('public/fullcalendar/core/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('public/fullcalendar/daygrid/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('public/fullcalendar/core/main.js') }}'></script>
    <script src='{{ asset('public/fullcalendar/interaction/main.js') }}'></script>
    <script src='{{ asset('public/fullcalendar/daygrid/main.js') }}'></script>
    <script src="{{ asset('node_modules/angular-fullcalendar/src/angular-fullcalendar.js') }}"></script>

    <script src="{{ asset('public/notika/js/summernote/summernote-updated.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/summernote/summernote-active.js') }}"></script>

    <link href="{{ asset('public/css/vanillaCalendar.css') }}" type="text/css" />
    <script src="{{ asset('public/scopes/DiallingController.js') }}"></script>
    <script src="{{ asset('public/js/vanillaCalendar.js') }}" type="text/javascript"></script>

    <script src="{{ asset('public/js/jquery.timepicker.min.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery.timepicker.min.css') }}" type="text/javascript"/>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');      
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid' ],
        });      

        calendar.on('dateClick', function(info) {
            console.log('clicked on ' + info.dateStr);
        });              

        calendar.render();
        });

        $("#datepicker_client_status").datepicker();
        $("#datepicker_client_status_two").datepicker();
        $("#timepicker").timepicker();

        //$(document).ready(function() {
            $('#summernote').summernote();
        //});
    </script>
@endsection