@extends('layouts.admin')

@section('content')
    
<div class="row mg-t-30" ng-controller="TaskController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Tasks</h2>
                    <p>Recent tasks on the system</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadTasks()">
                        <table ng-hide="loading_tasks" class="table table-sc-ex">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Status</th>
                                        <th>Company</th>
                                        <th>Assigned to</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="task in tasks">
                                        <td><% $index+1 %></td>
                                        <td><% task.status_name %></td>
                                        <td><% task.company_name %></td>
                                        <td><% task.user_name.length > 0 ? task.user_name : 'No one' %><a class="btn btn-secondady" ng-click="AssignTask(task)"><i class="fa fa-edit"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                </div>
            </div>
        </div>


        <form ng-submit="SaveTask()">
            <div class="modal fade" id="modalSaveTask" name="modalSaveTask" role="dialog" style="display: none;">
                <div class="modal-dialog modals-default">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <h2>Assign Task</h2>
                            
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Company</label>
                                <select required="required" class="selectpicker form-control" ng-change="LoadHashes()" ng-options="company.id as company.name  for company in companies" ng-model="task.company_id" id="selectCompany">
                                </select>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Import</label>
                                <select required="required" class="selectpicker form-control" ng-options="hash.name as hash.name  for hash in hashes" ng-model="task.hash_import" id="selectHash">
                                </select>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg">
                                <label for="selectCompany">Status</label>
                                <select required="required" class="selectpicker form-control" ng-options="status.id as status.name  for status in statuses" ng-model="task.status_id" id="selectStatus">
                                </select>
                            </div>
                            <div class="bootstrap-select fm-cmp-mg" ng-init="LoadUsers()">
                                <label for="selectCompany">User</label>
                                <select required="required" class="selectpicker form-control" ng-options="user.id as user.name  for user in users" ng-model="task.user_id" id="selectStatus">
                                </select>
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
    <script src="{{ asset('public/scopes/TaskController.js') }}"></script>
@endsection