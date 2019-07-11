@extends('layouts.admin')

@section('content')
   
<div class="" ng-controller="ClientController">
<div class="row" ng-hide="is_locked">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list mg-t-30">
                <div class="cmp-tb-hd">
                    <h2>{{ $client->name }}</h2>
                    <p>Select the company you're will be working with</p>
                </div>
                <!--<img ng-show="loading_companies" src="{{ asset('public/loading.gif') }}" />-->

                <hr>

                <div class="tab-ctn">
                        <p class="ng-binding"><strong>Name:</strong>&nbsp;{{ $client->name }}</p>
                        <p class="ng-binding"><strong>Email:</strong>&nbsp;{{ $client->email }}</p>
                        <p class="ng-binding"><strong>Phone:</strong>&nbsp;{{ $client->phone }}</p>
                        <p class="ng-binding"><strong>State/Province:</strong>&nbsp;{{ $client->state_province }}</p>
                        <p class="ng-binding"><strong>Import:</strong>&nbsp;{{ $client->hash_import }}</p>
                        <p class="tab-mg-b-0"><strong>Description:</strong>&nbsp;{{ $client->description }}</p>
                    </div>

                

                @if(count($messages) > 0)
                    <hr>
                    <h3>Latest Messages</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Text</th>
                                    <th>Sent by</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $message->id}}</td>
                                        <td>{{ $message->message_text}}</td>
                                        <td>{{ $message->user_name}}</td>
                                    </tr>
                                @endforeach                            
                            </tbody>
                        </table>
                    </div>
                    @endif


                    @if(count($notes) > 0)
                    <hr>
                    <h3>Latest Notes</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Text</th>
                                    <th>Sent by</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notes as $note)
                                    <tr>
                                        <td>{{ $note->id}}</td>
                                        <td>{{ $note->description}}</td>
                                        <td>{{ $note->user_name}}</td>
                                    </tr>
                                @endforeach                            
                            </tbody>
                        </table>
                    </div>
                    @endif
            </div>
        </div>
</div>
</div>

@endsection