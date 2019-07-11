@extends('layouts.admin')

@section('content')

<div class="" ng-controller="AppointmentController">
<div class="row mg-t-30">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="breadcomb-list">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="breadcomb-wp">
                            <div class="breadcomb-icon">
                                <i class="notika-icon notika-calendar"></i>
                            </div>
                            <div class="breadcomb-ctn">
                                <h2>Appointments</h2>
                                <p>Recent appointments on <span class="bread-ntd">system</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                        <div class="breadcomb-report">
                            <button data-toggle="tooltip" class="btn waves-effect"  ng-click="OpenModalAp()"><i class="notika-icon notika-sent"></i>&nbsp; Create Appointment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mg-t-30">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ng-init="LoadAppointments(0)">
                            <div class="inbox-text-list sm-res-mg-t-30">
                                <div class="form-group">
                                    <div class="nk-int-st search-input search-overt">
                                        <input type="text" class="form-control" placeholder="Search email..."  ng-model="search.$">
                                        <button class="btn search-ib waves-effect">Search</button>
                                    </div>
                                </div>
                                <div class="inbox-btn-st-ls btn-toolbar">
                                    <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                        <button ng-click="LoadAppointments(current_page)" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-refresh"></i> Refresh</button>
                                    </div>
                                    <div class="btn-group ib-btn-gp active-hook nk-act nk-email-inbox">
                                        <button ng-show="current_page > 1" ng-click="LoadAppointments($index - 1)" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-left-arrow"></i></button>
                                        <button ng-show="current_page < (total_pages -1)" ng-click="LoadAppointments($index + 1)" class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-right-arrow"></i></button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-inbox">
                                        <tbody>
                                            <tr class="unread" ng-repeat="appointment in appointments | filter:search:strict">
                                                <td class="">
                                                    <label><div class="icheckbox_square-green checked" style="position: relative;"><input type="checkbox" checked="" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></label>
                                                </td>
                                                <td><a href="#"><% appointment.user_name %></a></td>
                                                <td><a href="#"><% appointment.description %></a>
                                                </td>
                                                <td><% appointment.date %> <% appointment.time %></td>
                                                <td class="text-right mail-date"><% appointment.created_at %></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                       <div class="pagination-inbox">
                                        <ul class="wizard-nav-ac">
                                            <li><a class="btn waves-effect" ng-show="current_page > 1" ng-click="LoadAppointments($index - 1)" href="#"><i class="notika-icon notika-back"></i></a></li>
                                            <li class="<% $index==current_page ? 'active' : '' %>" ng-repeat="x in [].constructor(total_pages) track by $index"><a ng-click="LoadAppointments($index)" class="btn waves-effect" href="#"><% $index+1 %></a></li>
                                            <li><a class="btn waves-effect" ng-show="current_page < (total_pages -1)" ng-click="LoadAppointments($index + 1)" href="#"><i class="notika-icon notika-next-pro"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
    
            <form ng-submit="SendAppointment()">
                    <div class="modal fade" id="modalSendAppointment" name="modalSendAppointment" role="dialog" style="display: none;">
                        <div class="modal-dialog modals-default" style="width: 70%; margin-top: 10px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                <div class="modal-body">
                                    <h2>Send SMS</h2>
                                    
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <label for="selectCompany">Appointment Name</label>
                                        <input required="required" ng-model="appointment.name" class="selectpicker form-control" />
                                    </div>
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <label for="selectCompany">Appointment Description</label>
                                        <input required="required" ng-model="appointment.description" class="selectpicker form-control" />
                                    </div>

                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="bootstrap-select fm-cmp-mg">
                                                        <label for="selectCompany">Date</label>
                                                        <input required="required" ng-model="appointment.date" class="datepicker selectpicker form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bootstrap-select fm-cmp-mg">
                                                        <label for="selectCompany">Time</label>
                                                        <input required="required" ng-model="appointment.time" class="timepicker selectpicker form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <label for="selectCompany">Users to Add</label>
                                                
                                                <select required="required" class="selectpicker form-control" ng-options="user.email as user.name  for user in users" ng-model="user_email" id="user_email">
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                    <label for="selectCompany">&nbsp;</label>                                                
                                                    <button type="button" class="btn btn-primary btn-block" ng-click="AddUser()">Add</button>                                            
                                            </div>
                                    </div>
                                  
                                    <div class="bootstrap-select fm-cmp-mg">
                                            <label for="selectCompany">Send to</label>
                                            <input required="required" ng-model="appointment.emails" class="selectpicker form-control" />
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

</div>
@endsection

@section('pagescript')
    <link href="{{ asset('public/css/vanillaCalendar.css') }}" type="text/css" />
    <script src="{{ asset('public/scopes/DiallingController.js') }}"></script>
    <script src="{{ asset('public/js/vanillaCalendar.js') }}" type="text/javascript"></script>

    <script src="{{ asset('public/js/jquery.timepicker.min.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery.timepicker.min.css') }}" type="text/javascript"/>

    <script src="{{ asset('public/notika/js/summernote/summernote-updated.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/summernote/summernote-active.js') }}"></script>
    <script src="{{ asset('public/scopes/AppointmentController.js') }}"></script>
    <script type="text/javascript">
        $('#summernote').summernote();
        $(".datepicker").datepicker();
        $(".timepicker").timepicker();
    </script>
@endsection