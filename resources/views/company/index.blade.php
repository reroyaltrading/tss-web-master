@extends('layouts.admin')

@section('content')

<div class="row mg-t-30" ng-controller="CompanyController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Companies</h2>
                    <p>Current companies on system</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadCompanies()">
                    <img ng-show="loading_companies" src="{{ asset('public/loading.gif') }}" />

                    <div class="pull-left" style="margin: 20px;">
                            <button class="btn btn-success btn-sm" ng-click="CreateCompany()"><i class="fa fa-star"></i>&nbsp;Create</button>
                    </div>  

                    <div class="pull-right" style="margin: 20px;">
                            <input class="selectpicker form-control" />
                    </div>

                    <table ng-hide="loading_companies" class="table table-sc-ex">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Site</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="company in companies">
                                <td><% company.id %></td>
                                <td><% company.name %></td>
                                <td><% company.site %></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" ng-click="EditCompany(company.id)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" ng-click="DeleteCompany(company.id)"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <form ng-submit="SaveCompany()">
            <div class="modal fade" id="modalEditCompany" name="modalEditCompany" role="dialog" style="display: none;">
                <div class="modal-dialog modals-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <h2>Send SMS</h2>
                            
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Name</label>
                                <input required="required" ng-model="company.name" class="selectpicker form-control" />
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                    <label for="selectCompany">Prefix</label>
                                    <input required="required" ng-model="company.prefix" class="selectpicker form-control" />
                                </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Site</label>
                                <input required="required" ng-model="company.site" class="selectpicker form-control" />
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
    <script src="{{ asset('public/scopes/CompanyController.js') }}"></script>
@endsection