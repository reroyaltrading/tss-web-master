@extends('layouts.admin')

@section('content')

<div class="row mg-t-30" ng-controller="CalendarController">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="normal-table-list">
                <div class="basic-tb-hd">
                    <h2>Events</h2>
                    <p>Current events on system</p>
                </div>
                <div class="bsc-tbl" ng-init="LoadEvents()">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <thead>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Operator</th>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="event in events">
                                            <td><% $index+1 %></td>
                                            <td><% event.date_to_call %></td>
                                            <td><% event.client_name %></td>
                                            <td><% event.user_name %></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('pagescript')
    <link href='{{ asset('public/fullcalendar/core/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('public/fullcalendar/daygrid/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('public/fullcalendar/core/main.js') }}'></script>
    <script src='{{ asset('public/fullcalendar/interaction/main.js') }}'></script>
    <script src='{{ asset('public/fullcalendar/daygrid/main.js') }}'></script>
    <script src="{{ asset('node_modules/angular-fullcalendar/src/angular-fullcalendar.js') }}"></script>

    <script src="{{ asset('public/scopes/CalendarController.js') }}"></script>

    <script>
            document.addEventListener('DOMContentLoaded', function() {
              var calendarEl = document.getElementById('calendar');      
              var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid' ],
              });      

            calendar.on('dateClick', function(info) {
                console.log('clicked on ' + info.dateStr);
            });              

              calendar.render();
            });
      
          </script>
@endsection