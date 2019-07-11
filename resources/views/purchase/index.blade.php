
@extends('layouts.admin')

@section('content')
    
<div class="row mg-t-30" ng-controller="PurchaseController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Imports</h2>
                    <p>Manage imports</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadPurchases()">
                        <div class="pull-left" ng-hide="loading_clients" style="margin: 20px;">
                                <button class="btn btn-success btn-sm" ng-click="ImportFile()"><i class="fa fa-star"></i>&nbsp;Create</button>
                        </div>  

                        <table ng-hide="loading_purchases" class="table table-sc-ex">
                            <table class="table table-sc-ex">
                                <thead>
                                    <tr>
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
                                        <td><% purchase.paid_date %></td>
                                        <td><% purchase.order_total %></td>
                                        <td><% purchase.order_tax %></td>
                                        <td><% purchase.order_status %></td>
                                        <td><% purchase.company %></td>
                                    </tr>
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
</div> 
@endsection

@section('pagescript')
    <script src="{{ asset('public/scopes/PurchaseController.js') }}"></script>
@endsection