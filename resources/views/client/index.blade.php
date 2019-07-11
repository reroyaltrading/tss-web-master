@extends('layouts.admin')

@section('content')

<div class="row mg-t-30" ng-controller="ClientController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Clients</h2>
                    <p>Current clients on system</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadClients(0)">
                    <img ng-show="loading_clients" src="{{ asset('public/loading.gif') }}" />

                    <div class="row">
                        <div class="col-md-6">
                                <label>&nbsp;</label>
                                <button class="btn btn-success btn-sm" ng-click="UnlockAll()"><i class="fa fa-unlock"></i>&nbsp;Unlock All</button>
                                <button class="btn btn-danger btn-sm" ng-click="LockAll()"><i class="fa fa-lock"></i>&nbsp;Lock All</button>
                        </div>
                        
                    </div> 

                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                                <label>Intems per Page</label>
                                <select class="selectpicker form-control" ng-model="items_per_page" ng-change="LoadClients(0)">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                    </select>
                        </div>
                        <div class="col-md-2">
                                    <label>Search</label>
                                    <input class="selectpicker form-control" ng-model="search.$"/>
                        </div>

                        <div class="col-md-2 col-md-offset-2" ng-init="LoadCompanies()">
                                <label>Company</label>
                            <select required="required" class="selectpicker form-control" ng-change="LoadHashes()" ng-options="company.id as company.name for company in companies" ng-model="selector.company_id" id="selected_company">
                                </select>
                        </div>
                        <div class="col-md-2">
                                <label>Hash</label>
                                <select required="required" class="selectpicker form-control" ng-options="hash.name as hash.name for hash in hashes" ng-model="selector.hash_import" id="selected_hash">
                                    </select>
                        </div>
                        <div class="col-md-2">
                                <button class="btn btn-success btn-sm btn-block" ng-click="ExportClients()"><i class="fa fa-lock"></i>&nbsp;Export</button>
                                <button class="btn btn-primary btn-sm btn-block" ng-click="LoadClients(0)"><i class="fa fa-lock"></i>&nbsp;Filter</button>
                        </div>

                        </div>                            
                    </div>
                    
                    <hr>

                    <table ng-hide="loading_clients" class="table table-sc-ex table-bordered ">
                        <thead  class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th class="hidden-xs">Phone</th>
                                <th class="hidden-xs">Email</th>
                                <th class="hidden-xs">Hash</th>
                                <th class="hidden-xs">Locked</th>
                                <th colspan="4">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="client in clients | filter:search:strict">
                                <td><% $index+1 %></td>
                                <td><a href="{{ url('/registers/clients/info/') }}/<% client.id %>.html"><% client.name %></a></td>
                                <td class="hidden-xs"><% client.phone %></td>
                                <td class="hidden-xs"><% client.email %></td>
                                <td class="hidden-xs"><% client.hash_import %></td>
                                <td class="hidden-xs"><% client.is_locked ? 'Yes' : 'No' %></td>
                                <td>
                                    <button class="btn <% client.is_locked ? 'btn-danger' : 'btn-success' %> btn-sm" ng-click="UnlockClient(client.id, client.is_locked)">
                                        <i class="fa fa-unlock" ng-show="client.is_locked"></i>
                                        <i class="fa fa-lock" ng-hide="client.is_locked"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" ng-click="EditClient(client.id)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm hidden-xs" ng-click="DeleteClient(client.id)"><i class="fa fa-times"></i></button>
                                    <button class="btn btn-success btn-sm hidden-xs" ng-click="OpenModalPurchases(client.phone, client.email)"><i class="fa fa-dollar"></i></button>
                                    <button class="btn btn-secondary btn-sm hidden-xs" ng-click="OpenSMSSender(client.phone)"><i class="fa fa-comments-o"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="btn-toolbar" role="toolbar" style="margin-top: 20px;">
                            <div class="btn-group notika-tl-btn">
                                <button ng-repeat="x in [].constructor(total_pages) track by $index" ng-click="LoadClients($index)" type="button" class="btn btn-<% $index==page ? 'primary' : 'default' %> notika-gp-primary waves-effect"><% $index+1 %></button>
                            </div>
                        </div>
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
                            <input required="required" ng-model="send_sms_message" class="selectpicker form-control" />
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

        <div class="modal fade" id="modalPurchases" name="modalPurchases" role="dialog" style="display: none;">
            <div class="modal-dialog modals-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
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
                    <div class="modal-footer" style="margin-top: 5px;">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

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
                                <input required="required" ng-model="client.phone" class="selectpicker form-control" />
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
                                <label for="selectCompany">Copany</label>
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

    </div>
@endsection

@section('pagescript')
    <script src="{{ asset('public/scopes/ClientController.js') }}"></script>
@endsection