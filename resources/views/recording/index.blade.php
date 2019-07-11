@extends('layouts.admin')

@section('content')

<div class="row mg-t-30" ng-controller="RecordingController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Recordings</h2>
                    <p>Current clients on recordings</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadRecordings()">
                    <img ng-show="loading_recordings" src="{{ asset('public/loading.gif') }}" />

                    <div class="pull-right" style="margin: 20px;">
                            <input class="selectpicker form-control"  ng-model="search.$"/>
                    </div>

                    <table ng-hide="loading_recordings" class="table table-sc-ex">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Holder</th>
                                <th class="hidden-xs">Number</th>
                                <th class="hidden-xs">Called Number</th>
                                <th class="hidden-xs">Identifier</th>
                                <th class="hidden-xs">Company Id</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="recording in recordings | filter:search:strict">
                                <td><%recording.id%></td>
                                <td><%recording.extension_holder%></td>
                                <td><%recording.extension_number%></td>
                                <td><%recording.called_number%></td>
                                <td><%recording.internal_identifier%></td>
                                <td><%recording.company_id%></td>

                                <td>
                                    <audio controls>
                                        <source src="<%recording.file_location%>" type="audio/wav">
                                        Your browser does not support the audio element.
                                    </audio>
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
    <script src="{{ asset('public/scopes/RecordingController.js') }}"></script>
@endsection