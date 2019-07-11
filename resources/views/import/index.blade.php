
@extends('layouts.admin')

@section('content')
    
<div class="row mg-t-30" ng-controller="ImportController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Imports</h2>
                    <p>Manage imports</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadImports()">

                        <div class="pull-left" ng-hide="loading_clients" style="margin: 20px;">
                                <button class="btn btn-success btn-sm" ng-click="ImportFile()"><i class="fa fa-star"></i>&nbsp;Create</button>
                        </div>  

                        <table ng-hide="loading_imports" class="table table-sc-ex">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Status</th>
                                        <th>Company</th>
                                        <th>Created by</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="import in imports">
                                        <td><% $index+1 %></td>
                                        <td><% import.status_name %></td>
                                        <td><% import.company_name %></td>
                                        <td><% import.user_name.length > 0 ? import.user_name : 'No one' %></td>
                                        <td>
                                            <a href="" class="btn btn-success btn-sm" ng-disabled="import.total_files <= 0" ng-click="ShowProcessFile(import.id)">Process <% import.total_files %> files</a>
                                            <a href="" class="btn btn-danger btn-sm" ng-click="DeleteImport(import.id)"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalProcessFile" name="modalProcessFile" role="dialog" style="display: none;">
                <div class="modal-dialog modals-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <h2>Process Files</h2>
                            
                            <table ng-hide="loading_imports" class="table table-sc-ex">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Extension</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="file in import_files">
                                            <td><% $index+1 %></td>
                                            <td><% file.original_name %></td>
                                            <td><% file.extension %></td>
                                            <td>
                                                <a href="{{ url('/') }}/<% file.location %>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                <a href="" class="btn btn-success btn-sm" ng-disabled="file.processed" ng-click="ProcessFile(file, file.import_id)"><i class="fa fa-spinner fa-spin" ng-show="file.is_processing"></i>&nbsp;process</a>
                                            </td>
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

        <form ng-submit="SaveFile()">
                <div class="modal fade" id="modalImportFile" name="modalImportFile" role="dialog" style="display: none;">
                    <div class="modal-dialog modals-default">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                            </div>
                            <div class="modal-body">
                                <h2>Assign Task</h2>
                                
                                <div class="bootstrap-select fm-cmp-mg" ng-init="LoadCompanies()">
                                    <label for="selectCompany">Company</label>
                                    <select required="required" class="selectpicker form-control" ng-change="LoadHashes()" ng-options="company.id as company.name  for company in companies" ng-model="import.company_id" id="selectCompany">
                                    </select>
                                </div>

                                <div class="bootstrap-select fm-cmp-mg" ng-init="LoadStatuses()">
                                    <label for="selectCompany">Status</label>
                                    <select required="required" class="selectpicker form-control" ng-options="status.id as status.name  for status in statuses" ng-model="import.status_id" id="selectStatus">
                                    </select>
                                </div>
                                
                                <input type="hidden" value="{{ route('ajax_upload_file') }}" name="dropzone_url" id="dropzone_url" />

                                <div  class="multi-uploader-cs">
                                <div id="dropzone_test"  method="post" style="border: 2px dashed #00c292; margin-top: 20px;" action="/upload" class="dropzone">
                                    <div class="fallback">
                                            <input name="file" type="file" />
                                          </div>

                                          <div class="dz-message needsclick download-custom">
                                                <i class="notika-icon notika-cloud"></i>
                                                <h2>Drop files here or click to upload.</h2>
                                                <p><span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                                                </p>
                                            </div>
                                </div>
                                </div>                               
                            </div>
                            <div class="modal-footer" style="margin-top: 5px;">
                                <button type="submit" class="btn btn-default waves-effect">Save</button>
                                <button type="button" class="btn btn-default waves-effect" ng-click="CancelUpload()">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
</div> 
@endsection

@section('pagescript')
    <script src="{{ asset('public/notika/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('public/scopes/ImportController.js') }}"></script>
    <script type="text/javascript">
        
    </script>
@endsection