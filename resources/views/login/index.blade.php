<!doctype html>
<html class="no-js" ng-app="InsightCRM">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Register | Insight CRM</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/bootstrap.min.css') }}">
    <!-- font awesome CSS
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
    <!-- summernote CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/summernote/summernote.css') }}">
    <!-- Range Slider CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/themesaller-forms.css') }}">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/normalize.css') }}">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/notika-custom-icon.css') }}">
    <!-- bootstrap select CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/bootstrap-select/bootstrap-select.css') }}">
    <!-- datapicker CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/datapicker/datepicker3.css') }}">
    <!-- Color Picker CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/color-picker/farbtastic.css') }}">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/chosen/chosen.css') }}">
    <!-- notification CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/notification/notification.css') }}">
    <!-- dropzone CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('public/notika/css/dropzone/dropzone.css') }}">
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
    
</head>

<body ng-controller="LoginController">
    <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}" />
    <input type="hidden" name="dash_main" id="dash_main" value="{{ route('dash_main') }}" />
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Login Register area Start-->
    <div class="login-content">
        <!-- Login -->
        <div class="nk-block toggled" id="l-login">
            <form class="nk-form" ng-submit="doLogin()" id="formLogin" name="formLogin">
                <div class="input-group">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                    <div class="nk-int-st">
                        <input type="text" class="form-control" ng-model="user.username" placeholder="Username">
                    </div>
                </div>
                <div class="input-group mg-t-15">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                    <div class="nk-int-st">
                        <input type="password" class="form-control" ng-model="user.password" placeholder="Password">
                    </div>
                </div>
                <div class="fm-checkbox">
                    <label><input type="checkbox"  ng-model="user.remember"  class="i-checks"> <i></i> Keep me signed in</label>
                </div>
                <button type="submit"  class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
            </form>
        </div>

        <!-- Register -->
        <div class="nk-block" id="l-register">
            <div class="nk-form">
                <div class="input-group">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                    <div class="nk-int-st">
                        <input type="text" class="form-control" placeholder="Username">
                    </div>
                </div>

                <div class="input-group mg-t-15">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                    <div class="nk-int-st">
                        <input type="text" class="form-control" placeholder="Email Address">
                    </div>
                </div>

                <div class="input-group mg-t-15">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                    <div class="nk-int-st">
                        <input type="password" class="form-control" placeholder="Password">
                    </div>
                </div>

                <a href="#l-login" data-ma-action="nk-login-switch" data-ma-block="#l-login" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow"></i></a>
            </div>

            <div class="nk-navigation rg-ic-stl">
                <a href="#" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i class="notika-icon notika-right-arrow"></i> <span>Sign in</span></a>
                <a href="" data-ma-action="nk-login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
            </div>
        </div>

        <!-- Forgot Password -->
        <div class="nk-block" id="l-forget-password">
            <div class="nk-form">
                <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>

                <div class="input-group">
                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                    <div class="nk-int-st">
                        <input type="text" class="form-control" placeholder="Email Address">
                    </div>
                </div>

                <a href="#l-login" data-ma-action="nk-login-switch" data-ma-block="#l-login" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow"></i></a>
            </div>

            <div class="nk-navigation nk-lg-ic rg-ic-stl">
                <a href="" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i class="notika-icon notika-right-arrow"></i> <span>Sign in</span></a>
                <a href="" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i class="notika-icon notika-plus-symbol"></i> <span>Register</span></a>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('public/notika/js/vendor/jquery-1.12.4.min.js') }}"></script>
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
    <!-- sparkline JS
		============================================ -->
    <script src="{{ asset('public/notika/js/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/sparkline/sparkline-active.js') }}"></script>
    <!-- flot JS
		============================================ -->
    <script src="{{ asset('public/notika/js/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/notika/js/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public/notika/js/flot/flot-active.js') }}"></script>
    <!-- knob JS
		============================================ -->
    <script src="{{ asset('public/notika/js/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('public/notika/js/knob/jquery.appear.js') }}"></script>
    <script src="{{ asset('public/notika/js/knob/knob-active.js') }}"></script>
    <!-- Input Mask JS
		============================================ -->
    <script src="{{ asset('public/notika/js/jasny-bootstrap.min.js') }}"></script>
    <!-- icheck JS
		============================================ -->
    <script src="{{ asset('public/notika/js/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/icheck/icheck-active.js') }}"></script>
    <!-- rangle-slider JS
		============================================ -->
    <script src="{{ asset('public/notika/js/rangle-slider/jquery-ui-1.10.4.custom.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/rangle-slider/jquery-ui-touch-punch.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/rangle-slider/rangle-active.js') }}"></script>
    <!-- datapicker JS
		============================================ -->
    <script src="{{ asset('public/notika/js/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('public/notika/js/datapicker/datepicker-active.js') }}"></script>
    <!-- bootstrap select JS
		============================================ -->
    <script src="{{ asset('public/notika/js/bootstrap-select/bootstrap-select.js') }}"></script>
    <!--  color-picker JS
		============================================ -->
    <script src="{{ asset('public/notika/js/color-picker/farbtastic.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/color-picker/color-picker.js') }}"></script>
    <!--  notification JS
		============================================ -->
    <script src="{{ asset('public/notika/js/notification/bootstrap-growl.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/notification/notification-active.js') }}"></script>
    <!--  summernote JS
		============================================ -->
    <script src="{{ asset('public/notika/js/summernote/summernote-updated.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/summernote/summernote-active.js') }}"></script>
    <!-- dropzone JS
		============================================ -->
    <script src="{{ asset('public/notika/js/dropzone/dropzone.js') }}"></script>
    <!--  wave JS
		============================================ -->
    <script src="{{ asset('public/notika/js/wave/waves.min.js') }}"></script>
    <script src="{{ asset('public/notika/js/wave/wave-active.js') }}"></script>
    <!--  chosen JS
		============================================ -->
    <script src="{{ asset('public/notika/js/chosen/chosen.jquery.js') }}"></script>
    <!--  Chat JS
		============================================ -->
    <script src="{{ asset('public/notika/js/chat/jquery.chat.js') }}"></script>
    <!--  todo JS
		============================================ -->
    <script src="{{ asset('public/notika/js/todo/jquery.todo.js') }}"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{ asset('public/notika/js/plugins.js') }}"></script>
    <!-- main JS
		============================================ -->
    <script src="{{ asset('public/notika/js/main.js') }}"></script>
	<!-- tawk chat JS
		============================================ -->
    <script src="{{ asset('public/notika/js/tawk-chat.js') }}"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL7PKZrZ7VbCtcYUE4nr4_WQaa0J9eorg"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{ asset('public/scopes/application.js') }}"></script>
    <script src="{{ asset('public/scopes/LoginController.js') }}"></script>

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('sw.js').then(function(registration) {
                // Registration was successful
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                // registration failed :(
                console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
</body>

</html>