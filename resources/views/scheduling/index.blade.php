@extends('layouts.admin')

@section('content')

<div class="row mg-t-30" ng-controller="SchedulingController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Calls</h2>
                    <p>Next callbacks schedules</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadSchedulling()">
                    <img ng-show="loading_schedulling" src="{{ asset('public/loading.gif') }}" />

                    <div class="pull-right" style="margin: 20px;">
                            <label>Search</label>
                            <input class="selectpicker form-control"   ng-model="search.$"/>
                    </div>

                    <table ng-hide="loading_schedulling" class="table table-sc-ex">
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
                            <tr ng-repeat="schedulling in schedullings | filter:search:strict">
                                <td><% schedulling.id %></td>
                                <td><a href="{{ url('registers/clients/info/') }}/<% schedulling.client_id %>.html"><% schedulling.client_name %></a></td>
                                <td class="hidden-xs"><% schedulling.date_to_call %></td>
                                <td class="hidden-xs"><% schedulling.time_to_call %></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('dialling_select_company') }}?client_id=<% schedulling.client_id %>&client_name=<% schedulling.client_name %>"><i class="fa fa-phone"></i></a>
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
    <script src="{{ asset('public/scopes/SchedulingController.js') }}"></script>
@endsection