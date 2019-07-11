@extends('layouts.admin')

@section('content')

<div class="row  mg-t-30">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="breadcomb-list">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="breadcomb-wp">
                            <div class="breadcomb-icon">
                                <i class="fa fa-code"></i>
                            </div>
                            <div class="breadcomb-ctn">
                                <h2>Compose Script</h2>
                                <p>Welcome to the <span class="bread-ntd">TSS</span> script creator</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                        <div class="breadcomb-report">
                            <button data-toggle="tooltip" data-placement="left" title="" class="btn waves-effect" data-original-title="Guidelines"><i class="fa fa-info"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mg-t-30" ng-controller="ScriptController">
            <input type="hidden" value="{{ isset($script) ? $script->id : '0' }}" name="id" id="id"/>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="normal-table-list">
                    <div class="basic-tb-hd">
                        <h2>{{ isset($script) ? $script->name : 'Script' }}</h2>
                        <p>Current users on system</p>
                    </div>
                    <div class="bsc-tbl">
                        <div class="bootstrap-select fm-cmp-mg"  style="padding-bottom: 10px;" ng-init="LoadData()">
                                    <label for="selectCompany">Name</label>
                                        <input class="selectpicker form-control" ng-model="script.name" required="required" id="script_name">
                        </div>
                        <div class="bootstrap-select fm-cmp-mg"  style="padding-bottom: 10px;">
                            <label for="selectCompany">Company</label>
                                <select class="selectpicker form-control" required="required"  ng-options="company.id as company.name  for company in companies" ng-model="script.company_id" id="script_company_id">
                                </select>
                        </div>
                        <div class="bootstrap-select fm-cmp-mg"  style="padding-bottom: 10px;">
                                <label for="selectCompany">Status</label>
                                    <select required="required" class="selectpicker form-control" ng-options="status.id as status.name  for status in statuses" ng-model="script.status_id" id="script_status_id">
                                    </select>
                            </div>

                        <div class="html-editor-cm" id="summernote_root">
                            {!! isset($script) ? $script->content : 'Script' !!}
                        </div>

                        <div class="vw-ml-action-ls text-right mg-t-20">
                                <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                    <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-next"></i> Send to Revision</button>
                                    <button class="btn btn-default btn-sm waves-effect" ng-click="SaveScript()"><i class="fa fa-save"></i> Save</button>
                                    <button class="btn btn-default btn-sm waves-effect"><i class="notika-icon notika-trash"></i> Remove</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

    </div>
@endsection

@section('pagescript')
    <script src="{{ asset('public/scopes/ScriptController.js') }}"></script>
    <script src="{{ asset('public/notika/js/summernote/summernote-updated.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/summernote/summernote-active.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection