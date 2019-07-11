@extends('layouts.admin')

@section('content')

<div class="row mg-t-30" ng-controller="ScriptController">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="normal-table-list">
            <div class="basic-tb-hd">
                <h2>Scripts</h2>
                <p>Current scripts on system</p>
            </div>
            <div class="bsc-tbl" ng-init="LoadScripts()">
                <img ng-show="loading_scripts" src="{{ asset('public/loading.gif') }}" />

                <div class="pull-left" style="margin: 20px;">
                    <a class="btn btn-success btn-sm" href="{{ route('home_create_script') }}"><i class="fa fa-star"></i>&nbsp;Create</a>
                </div>  

                <div class="pull-right" style="margin: 20px;">
                        <label>Search</label>
                        <input class="selectpicker form-control"  ng-model="search.$"/>
                </div>

                <table ng-hide="loading_scripts" class="table table-sc-ex">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="script in scripts | filter:search:strict">
                            <td><% script.id %></td>
                            <td><a href="{{ url('/registers/script/edit/') }}/<% script.id %>.html"><% script.name %></a></td>
                            <td><% script.company_name %></td>
                            <td><% script.status_name %></td>
                            <td>                               
                                <a class="btn btn-primary btn-sm" href="{{ url('/registers/script/edit/') }}/<% script.id %>.html"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm" ng-click="DeleteScript(script.id)"><i class="fa fa-times"></i></button>
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
    <script src="{{ asset('public/scopes/ScriptController.js') }}"></script>
@endsection