@extends('layouts.admin')

@section('content')

<div class="row mg-t-30" ng-controller="UserController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Users</h2>
                    <p>Current users on system</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadUsers()">
                    <img ng-show="loading_users" src="{{ asset('public/loading.gif') }}" />

                    <div class="pull-left" ng-hide="loading_clients" style="margin: 20px;">
                            <button class="btn btn-success btn-sm" ng-click="CreateUser()"><i class="fa fa-star"></i>&nbsp;Create</button>
                    </div>  

                    <div class="pull-right" style="margin: 20px;">
                            <input class="selectpicker form-control" />
                    </div>

                    <table ng-hide="loading_users" class="table table-sc-ex">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Site</th>
                                <th>Phone</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="user in users">
                                <td><% user.id %></td>
                                <td><% user.name %></td>
                                <td><% user.email %></td>
                                <td><% user.site %></td>
                                <td><% user.phone %></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" ng-click="EditPermission(user.id)"><i class="fa fa-key"></i></button>
                                    <!--<button class="btn btn-success btn-sm"><i class="fa fa-list"></i></button>-->
                                    <button class="btn btn-primary btn-sm" ng-click="EditUser(user.id)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" ng-click="DeleteUser(user.id)"><i class="fa fa-times"></i></button>
                                    <button class="btn btn-secondary btn-sm" ng-click="OpenSMSSender(user.phone)"><i class="fa fa-comments-o"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <form ng-submit="SendSms()">
        <div class="modal fade" id="modalSendSms" name="modalSendSms" role="dialog" style="display: none;">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <h2>Send SMS</h2>
                        
                        <div class="bootstrap-select fm-cmp-mg">
                            <label for="selectCompany">Message</label>
                            <input required="required" ng-model="pe" class="selectpicker form-control" />
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

        <form ng-submit="SavePermissions()">
            <div class="modal fade" id="modalEditPermission" name="modalEditPermission" role="dialog" style="display: none;">
                <div class="modal-dialog modals-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <h2 style="margin-bottom: 20px;">User Permissions</h2>
                            <div class="bootstrap-select fm-cmp-mg" style="margin: 10px;">
                                <div class="nk-toggle-switch" data-ts-color="green">
                                    <label for="chk_back_office_operator" class="ts-label" style="font-weight: 400">BackOffice Opetator</label>
                                    <input id="chk_back_office_operator" parse-int="" ng-true-value="1" ng-false-value="0" ng-model="permission.back_office_operator" type="checkbox" hidden="hidden">
                                    <label for="chk_back_office_operator" class="ts-helper"></label>
                                </div>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg" style="margin: 10px;">
                                <div class="nk-toggle-switch" data-ts-color="green">
                                    <label for="chk_front_office_operator" class="ts-label" style="font-weight: 400">FrontOffice Operator</label>
                                    <input id="chk_front_office_operator" parse-int="" ng-true-value="1" ng-false-value="0" ng-model="permission.front_office_operator"  type="checkbox" hidden="hidden">
                                    <label for="chk_front_office_operator" class="ts-helper"></label>
                                </div>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg" style="margin: 10px;">
                                <div class="nk-toggle-switch" data-ts-color="green">
                                    <label for="chk_select_company_to_work" class="ts-label" style="font-weight: 400">Allowed to select task</label>
                                    <input id="chk_select_company_to_work" parse-int="" ng-true-value="1" ng-false-value="0" ng-model="permission.select_company_to_work" type="checkbox" hidden="hidden">
                                    <label for="chk_select_company_to_work" class="ts-helper"></label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-top: 5px;">
                            <button type="submit" class="btn btn-default waves-effect">Save</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        <form ng-submit="SaveUser()">
            <div class="modal fade" id="modalEditUser" name="modalEditUser" role="dialog" style="display: none;">
                <div class="modal-dialog modals-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <h2>Edit/Create User</h2>
                            
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Name</label>
                                <input  ng-model="user.name" class="selectpicker form-control" />
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Phone</label>
                                <input required="required" ng-model="user.phone" class="selectpicker form-control" />
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Email</label>
                                <input required="required" ng-model="user.email" class="selectpicker form-control" />
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Site</label>
                                <input required="required" ng-model="user.site" class="selectpicker form-control" />
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Password</label>
                                <input type="password" ng-model="user.password" class="selectpicker form-control" />
                            </div>
                        </div>
                        <div class="modal-footer" style="margin-top: 5px;">
                            <button type="submit" class="btn btn-default waves-effect">Save</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('pagescript')
    <script src="{{ asset('public/scopes/UserController.js') }}"></script>
@endsection