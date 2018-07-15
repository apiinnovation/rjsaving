<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ระบบกองทุนออมทรัพย์ รัจนาการ</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>
        <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">

        <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}"> 
        <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}"> 

    </head>
    <body>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="limiter">
                <div class="container-login100" style="background-image: url({{asset('images/bg-01.jpg')}})">
                    <div class="wrap-login100">
                        <span class="login100-form-logo">
                            <i class="zmdi zmdi-landscape"></i>
                        </span>

                        <span class="login100-form-title p-b-34 p-t-27">
                            Log in
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                            <input class="input100" type="text" name="XVUserCode" id="XVUserCode" placeholder="Username">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" name="XVUserPassword" id="XVUserPassword" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>

                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>


        <!-- <div id="dropDownSelect1"></div> -->

        <script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('js/login.js')}}"></script>

    </body>
</html>

