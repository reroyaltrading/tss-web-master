@extends('layouts.admin')

@section('content')

<div class="row mg-t-30" ng-controller="MaillingController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Templates</h2>
                    <p>Current mail templates on system</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadTemplates()">
                    <img ng-show="loading_templates" src="{{ asset('public/loading.gif') }}" />

                    <div class="pull-left" ng-hide="loading_templates" style="margin: 20px;">
                        <a class="btn btn-success btn-sm" href="{{ route('templates_create') }}"><i class="fa fa-star"></i>&nbsp;Create</a>
                    </div>  

                    <div class="pull-right" style="margin: 20px;">
                            <label>Search</label>
                            <input class="selectpicker form-control"   ng-model="search.$"/>
                    </div>

                    <table ng-hide="loading_templates" class="table table-sc-ex">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>   
                                <th class="hidden-xs">Created By</th>
                                <th class="hidden-xs">Created At</th>
                                <th colspan="4">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="template in templates | filter:search:strict">
                                <td><% template.id %></td>
                                <td><a href="{{ url('/mailling/templates/edit/') }}/<% template.id %>.html"><% template.name %></a></td>
                                <td class="hidden-xs"><% template.user_name %></td>
                                <td class="hidden-xs"><% template.created_at_formated %></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('/mailling/templates/edit/') }}/<% template.id %>.html"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm hidden-xs" ng-click="DeleteTemplate(template.id)"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>
@endsection

@section('pagescript')
    <script src="{{ asset('public/scopes/MaillingController.js') }}"></script>
@endsection