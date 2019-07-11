<!doctype html>
<html class="no-js"  ng-app="InsightCRM">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>RoyalTrading TSS | Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/font-awesome.min.css') }}">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('public/notika/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('public/notika/css/owl.transitions.css') }}">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/meanmenu/meanmenu.min.css') }}">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/animate.css') }}">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/normalize.css') }}">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- jvectormap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/jvectormap/jquery-jvectormap-2.0.3.css') }}">
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/notika-custom-icon.css') }}">
    
    <link rel="stylesheet" href="{{ asset('public/notika/css/dropzone.css') }}" />

    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/wave/waves.min.css') }}">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/main.css') }}">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/style.css') }}">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/responsive.css') }}">
    <!-- modernizr JS
		============================================ -->
    <script src="{{ asset('public/notika/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <style>
      .modal-dialog.modals-default .modal-content, .modal-dialog.modal-sm .modal-content, .modal-dialog.modal-large .modal-content {
        border-radius: 0px;
        padding: 41px 40px;
      }

      .fm-cmp-mg > label
      {
        margin-top: 10px;
      }

      .codeview > .note-codable
      {
        display: block;
      }

      .note-codable
      {
        display: none;
      }

      .datepicker 
      {
        padding: 6px 12px!important;
        font-size: 14px!important;
        border-radius: 4px!important;
      }

      .dropzone.dropzone-nk {
        border: 2px dashed #00c292;
      }

      thead {
        background-color: #2D3547;
      }

      .btn-primary{
        background-color: #2D3547;
        border-color: #2D3547;
      }

      .btn-primary:focus, .btn-primary:hover{
        background-color: #2D3547;
        border-color: #2D3547;
      }

      thead >  tr > th, thead > tr > td
      {
        color: #FFFFFF!important;
      } 

      .btn, select, input
      {
        border-radius: 0px!important;
      }

      .note-editable
      {
        /*height: auto!important;*/
        min-height: 220px!important;
      }

      .footer 
      {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 50px;
        bottom: 0;
        background-color: #f5f5f5;
      }

      .checked {
        color: orange;
      }
    </style>
</head>

<body>
    <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}" />
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a href="{{ route('home_index') }}"><img src="{{ asset('public/logo.png') }}" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">                      
                      <ul class="nav navbar-nav notika-top-nav">
                    
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search"></i></span></a>
                            <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                <div class="search-input">
                                    <i class="notika-icon notika-left-arrow"></i>
                                    <input type="text">
                                </div>
                            </div>
                        </li>
                        
                        <li class="nav-item nc-al">
                          <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span>
                            <i class="notika-icon notika-alarm"></i></span>
                            <!--<div class="spinner4 spinner-4"></div>
                            <div class="ntd-ctn"  >
                              <span id="totalNotifications">0</span></div>
                            </a>-->
                            <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
                                <div class="hd-mg-tt">
                                    <h2>Notification</h2>
                                </div>
                                <div class="hd-message-info">

                                </div>
                                <div class="hd-mg-va">
                                    <a href="{{ route('scheduling_index') }}">View All</a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item nc-al">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span>
                                {{ $user->name }}</span><div class="spinner4 spinner-4" id="spinnerNotification" style="display: none;"></div>
                                <div class="ntd-ctn" id="badgeNotification" style="display: none"><span id="totalNotifications">8</span></div></a>
                              </a>
                        </li>
                        <li class="nav-item dropdown">
                          <a href="{{ route('auth_get_logout') }}" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span>
                            <i class="notika-icon notika-close"></i></span></a>
                      </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Charts" href="#">Home</a>
                                    <ul class="collapse dropdown-header-top">
                                        <li><a href="{{ route('dash_main') }}">Home</a></li>
                                          <li><a href="{{ route('dialling_select_company') }}">Dialling</a></li>
                                          <li><a href="{{ route('calendar_index') }}">Calendar</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demoevent" href="#">Email</a>
                                    <ul id="demoevent" class="collapse dropdown-header-top">
                                        <li><a href="inbox.html">Inbox</a></li>
                                        <li><a href="view-email.html">View Email</a></li>
                                        <li><a href="compose-email.html">Compose Email</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#democrou" href="#">Interface</a>
                                    <ul id="democrou" class="collapse dropdown-header-top">
                                        <li><a href="animations.html">Animations</a></li>
                                        <li><a href="google-map.html">Google Map</a></li>
                                        <li><a href="data-map.html">Data Maps</a></li>
                                        <li><a href="code-editor.html">Code Editor</a></li>
                                        <li><a href="image-cropper.html">Images Cropper</a></li>
                                        <li><a href="wizard.html">Wizard</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demolibra" href="#">Charts</a>
                                    <ul id="demolibra" class="collapse dropdown-header-top">
                                        <li><a href="flot-charts.html">Flot Charts</a></li>
                                        <li><a href="bar-charts.html">Bar Charts</a></li>
                                        <li><a href="line-charts.html">Line Charts</a></li>
                                        <li><a href="area-charts.html">Area Charts</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demodepart" href="#">Tables</a>
                                    <ul id="demodepart" class="collapse dropdown-header-top">
                                        <li><a href="normal-table.html">Normal Table</a></li>
                                        <li><a href="data-table.html">Data Table</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demo" href="#">Forms</a>
                                    <ul id="demo" class="collapse dropdown-header-top">
                                        <li><a href="form-elements.html">Form Elements</a></li>
                                        <li><a href="form-components.html">Form Components</a></li>
                                        <li><a href="form-examples.html">Form Examples</a></li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#Miscellaneousmob" href="#">App views</a>
                                    <ul id="Miscellaneousmob" class="collapse dropdown-header-top">
                                        <li><a href="notification.html">Notifications</a>
                                        </li>
                                        <li><a href="alert.html">Alerts</a>
                                        </li>
                                        <li><a href="modals.html">Modals</a>
                                        </li>
                                        <li><a href="buttons.html">Buttons</a>
                                        </li>
                                        <li><a href="tabs.html">Tabs</a>
                                        </li>
                                        <li><a href="accordion.html">Accordion</a>
                                        </li>
                                        <li><a href="dialog.html">Dialogs</a>
                                        </li>
                                        <li><a href="popovers.html">Popovers</a>
                                        </li>
                                        <li><a href="tooltips.html">Tooltips</a>
                                        </li>
                                        <li><a href="dropdown.html">Dropdowns</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages</a>
                                    <ul id="Pagemob" class="collapse dropdown-header-top">
                                        <li><a href="contact.html">Contact</a>
                                        </li>
                                        <li><a href="invoice.html">Invoice</a>
                                        </li>
                                        <li><a href="typography.html">Typography</a>
                                        </li>
                                        <li><a href="color.html">Color</a>
                                        </li>
                                        <li><a href="login-register.html">Login Register</a>
                                        </li>
                                        <li><a href="404.html">404 Page</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row hidden-xs">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                      @if($permission->front_office_operator)
                        <li class="{{ $tab == 'home' ? 'active' : '' }}"><a data-toggle="tab" href="#Home"><i class="notika-icon notika-house"></i> Home</a>
                        </li>
                        <li class="{{ $tab == 'mail' ? 'active' : '' }}"><a data-toggle="tab" href="#mailbox" aria-expanded="false"><i class="notika-icon notika-mail"></i> Email</a>
                        </li>
                      @endif

                      @if($permission->front_office_operator)
                        <li class="{{ $tab == 'admin' ? 'active' : '' }}"><a data-toggle="tab" href="#Registers"><i class="notika-icon notika-form"></i> Admin</a>
                        </li>
                        <li class="{{ $tab == 'records' ? 'active' : '' }}"><a data-toggle="tab" href="#Recordings"><i class="notika-icon notika-cloud"></i> Recordings</a>
                        </li>
                      @endif

                      {{-- <li><a data-toggle="tab" href="#Appviews"><i class="notika-icon notika-app"></i> App views</a>
                      </li> --}}
                      <li class="{{ $tab == 'purchase' ? 'active' : '' }}"><a data-toggle="tab" href="#Purchase"><i class="notika-icon notika-credit-card"></i> Purchase</a>
                      </li>
                      <li class="{{ $tab == 'contactforms' ? 'active' : '' }}"><a data-toggle="tab" href="#ContactForms"><i class="notika-icon notika-form"></i> Contact Forms</a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                      <div id="Home" class="tab-pane in {{ $tab == 'home' ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('dash_main') }}">Home</a>
                                <li><a href="{{ route('dialling_select_company') }}">Dialling</a>
                                <li><a href="{{ route('scheduling_index') }}">Callbacks</a>
                                  <li><a href="{{ route('appointments_index') }}">Appointments</a>
                                <li><a href="{{ route('calendar_index') }}">Calendar</a>
                                <li><a href="{{ route('auth_get_logout') }}">Logout</a>
                                <!--<li><a id="btnExit" href="#">Exit</a>-->
                                </li>
                            </ul>
                        </div>
                        <div id="mailbox" class="tab-pane {{ $tab == 'mail' ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                  <a href="{{ route('templates_index') }}">Mail Templates</a>
                                </li>
                                <!--<li>
                                  <a href="{{ route('compose_index') }}">Compose Email</a>
                                </li>
                                <li>
                                  <a href="{{ route('sms_index') }}">Compose SMS</a>
                                </li>-->

                            </ul>
                        </div>
                        {{-- <div id="Appviews" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="#">App</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Feedback</a></li>
                            </ul>
                        </div> --}}
                        <div id="Purchase" class="tab-pane in {{ $tab == 'purchase' ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                          <ul class="notika-main-menu-dropdown">
                              <li><a href="{{ route('purchase_index') }}">List</a></li>
                              <li><a href="#">Online</a></li>
                              <li><a href="#">Stores</a></li>
                          </ul>
                        </div>
                        <div id="ContactForms" class="tab-pane in {{ $tab == 'contactforms' ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('rec_index') }}">List</a></li>
                            </ul>
                          </div>
                        <div id="Recordings" class="tab-pane {{ $tab == 'records' ? 'active' : '' }} notika-tab-menu-bg animated flipInX">
                          <ul class="notika-main-menu-dropdown">
                              <li><a href="{{ route('rec_index') }}">List</a></li>
                              <li><a href="#">Settings</a></li>
                              <li><a href="#">Service</a></li>
                          </ul>
                      </div>
                        <div id="Registers" class="tab-pane notika-tab-menu-bg {{ $tab == 'admin' ? 'active' : '' }} animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="{{ route('user_index') }}">Users</a>
                                </li>
                                <li><a href="{{ route('client_index') }}">Clients</a>
                                </li>
                                <li><a href="{{ route('script_index') }}">Scripts</a>
                                </li>
                                <li><a href="{{ route('company_index') }}">Companies</a>
                                </li>
                                <li><a href="{{ route('imports_index') }}"> Imports</a>
                                </li>
                                <li><a href="{{ route('tasks_index') }}"> Tasks</a>
                                </li>
                                <li><a href="{{ route('tasks_index') }}"> Feedback</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
    

    

    <!-- End Realtime sts area-->
    <!-- Start Footer area-->
    <!--<div class="footer footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p style="color: #323232;">Copyright © 2019. All rights reserved <a style="color: #323232;" href="#">R.E. RoyalTrading Inc</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- End Footer area-->
    <!-- jquery
		============================================ -->
    <script src="{{ asset('public/notika/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{ asset('public/notika/js/bootstrap.min.js') }}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{ asset('public/notika/js/wow.min.js') }}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{ asset('public/notika/js/jquery-price-slider.js') }}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{ asset('public/notika/js/owl.carousel.min.js') }}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{ asset('public/notika/js/jquery.scrollUp.min.js') }}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{ asset('public/notika/js/meanmenu/jquery.meanmenu.js') }}"></script>
    <!-- counterup JS
		============================================ -->
    <script src="{{ asset('public/notika/js/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/counterup/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/counterup/counterup-active.js') }}"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{ asset('public/notika/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- jvectormap JS
		============================================ -->
    <script src="{{ asset('public/notika/js/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('public/notika/js/jvectormap/jvectormap-active.js') }}"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{ asset('public/notika/js/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/sparkline/sparkline-active.js') }}"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{ asset('public/notika/js/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/notika/js/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public/notika/js/flot/curvedLines.js') }}"></script>
    <script src="{{ asset('public/notika/js/flot/flot-active.js') }}"></script>
    <!-- knob JS
		============================================ -->
    <script src="{{ asset('public/notika/js/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('public/notika/js/knob/jquery.appear.js') }}"></script>
    <script src="{{ asset('public/notika/js/knob/knob-active.js') }}"></script>
    <!--  wave JS
		============================================ -->
    <script src="{{ asset('public/notika/js/wave/waves.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/wave/wave-active.js') }}"></script>
    <!--  todo JS
		============================================ -->
    <script src="{{ asset('public/notika/js/todo/jquery.todo.js') }}"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{ asset('public/notika/js/plugins.js') }}"></script>
	<!--  Chat JS
		============================================ -->
    <script src="{{ asset('public/notika/js/chat/moment.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/chat/jquery.chat.js') }}"></script>

    <!-- main JS
		============================================ -->
    <script src="{{ asset('public/notika/js/main.js') }}"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="{{ asset('public/js/bootstrap-notify.min.js') }}"></script>

  
    <script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL7PKZrZ7VbCtcYUE4nr4_WQaa0J9eorg"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{ asset('public/scopes/application.js') }}"></script>
    @yield('pagescript')

    <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('{{ asset('sw.js') }}').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                    });
                });
            }

          // Enable pusher logging - don't include this in production
          Pusher.logToConsole = true;

          var pusher = new Pusher('848a83baf951a5b226e7', {
            cluster: 'us2',
            forceTLS: true
          });

          var channel = pusher.subscribe('my-channel');
          var count = 0;
          channel.bind('my-event', function(data) {
              count++; 

              if(data.user_id == {{$user->id}})
              {
                //alert(JSON.stringify(data));
                $("#badgeNotification").text(count);
                if(count > 0)
                {
                  $("#badgeNotification").css('display', 'block');
                  $("#spinnerNotification").css('display', 'block');
                }

                var html = "<a href='{{ route('scheduling_index') }}'> <div class='hd-message-sn'> <div class='hd-mg-ctn'> <h3>" 
                    + data.client_name +"</h3> <p>" + data.message + "</p></div></div></a>";
                $( ".hd-message-info" ).append(html);

                $.notify({  message:  data.client_name + " - " +  data.message  },{  type: 'info' });

                var audio = new Audio("{{ asset('public/notification/slow-spring-board.mp3') }}");
                audio.play();
              }
          });
          </script>
</body>

</html>