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
                                <h2>Compose Mail Template</h2>
                                <p>Welcome to the <span class="bread-ntd">TSS</span> template creator</p>
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

    <div class="row mg-t-30">
        <div class="col-md-12">
                <div class="normal-table-list">
                        <div class="basic-tb-hd">
                            <h2>Main variables</h2>
                        </div>
                        <div class="bsc-tbl">
                            <ul>
                                <li style="margin: 2px;"><strong>@username</strong> Represents the username</li>
                                <li style="margin: 2px;"><strong>@today</strong> Represents the current date</li>
                                <li style="margin: 2px;"><strong>@company</strong> Represents the company name</li>
                            </ul>
                        </div>
                </div>
        </div>
    </div>

    <div class="row mg-t-30" ng-controller="MaillingController">
            <input type="hidden" value="{{ isset($template) ? $template->id : '0' }}" name="id" id="id"/>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="normal-table-list">
                    <div class="basic-tb-hd">
                        <h2>{{ isset($template) ? $template->name : 'Template' }}</h2>
                        <p>Current template on system</p>
                    </div>
                    <div class="bsc-tbl">
                        <div class="bootstrap-select fm-cmp-mg"  style="padding-bottom: 10px;">
                                    <label for="selectCompany">Name</label>
                                        <input class="selectpicker form-control" value="{{ isset($template) ? $template->name : 'Template' }}" required="required" id="template_name">
                        </div>
                        
                        <div class="html-editor-cm" id="summernote_root">
                            {!! isset($template) ? $template->content : '' !!}
                        </div>

                        <div class="vw-ml-action-ls text-right mg-t-20">
                                <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                    <button class="btn btn-default btn-sm waves-effect" ng-click="SaveTemplate()"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

    </div>
@endsection

@section('pagescript')
    <script src="{{ asset('public/scopes/MaillingController.js') }}"></script>
    <script src="{{ asset('public/notika/js/summernote/summernote-updated.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/summernote/summernote-active.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection