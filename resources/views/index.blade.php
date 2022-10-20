@guest
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <span class="login100-form-title p-b-26">
                        Admin Login
                    </span>
                    <span class="login100-form-title p-b-48">
                        <i class="zmdi zmdi-font"></i>
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                        <input class="input100 @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            type="email" required name="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password"
                            required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                            ? 'checked' : '' }}>

                        <label class="wrap-input100 validate-input" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('vendor/animsition/js/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{ asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/main.js')}}"></script>

</body>

</html>
@endguest
@auth

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/mini_logo.png')}}')}}" type="image/png">

    <link rel="stylesheet" href="{{ asset('css/bootstrap1.min.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/themefy_icon/themify-icons.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/niceselect/css/nice-select.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/owl_carousel/css/owl.carousel.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/gijgo/gijgo.min.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/font_awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/tagsinput/tagsinput.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/datepicker/date-picker.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/vectormap-home/vectormap-2.0.2.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/scroll/scrollable.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/datatable/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/datatable/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/datatable/css/buttons.dataTables.min.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/text_editor/summernote-bs4.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/morris/morris.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/material_icon/material-icons.css')}}">

    <link rel="stylesheet" href="{{ asset('css/metisMenu.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style1.css')}}">
    <link rel="stylesheet" href="{{ asset('css/colors/default.css')}}" id="colorSkinCSS">
</head>

<center>
    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <a href="{{ route('home') }}" class="btn_1 radius_btn d-block text-center">Home</a>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <a href="{{ route('attendlist') }}" class="btn_1 radius_btn d-block text-center">Attendance History</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <a href="{{ route('exerciselist') }}" class="btn_1 radius_btn d-block text-center">Exercise History</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <a href="{{ route('std') }}" class="btn_1 radius_btn d-block text-center">Students List</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <a href="{{ route('lstexm') }}" class="btn_1 radius_btn d-block text-center">Exams List</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn_1 radius_btn d-block text-center" type="submit">Logout</button>
            </form>
        </div>
    </div>

</center>
@endauth