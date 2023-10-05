<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eclectic | {{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets2') }}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets2') }}/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets2') }}/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('assets2') }}/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="{{ route('aksilogin') }}" method="POST">

                    <span class="login100-form-title" style="margin-bottom: 50px">
                        <img src="{{ asset('logo eclectic web.png') }}" alt="" width="250">
                        <p style="text-transform: uppercase; margin-top: 20px; font-weight: bold; font-size: 17px">
                            Office Management
                            System</p>
                    </span>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" placeholder="Type your email">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    @if ($errors->has('email'))
                        <script>
                            window.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: '{{ $errors->first('email') }}',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        </script>
                    @endif

                    <div style="margin-bottom: 5px; margin-top: 20px; margin-left: 100px;">
                        <span class="label-input100">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember"
                                style="margin-left: -100px">
                            <label class="form-check-label" for="gridCheck" style="margin-left: -100px">
                                Keep Me Logged In
                            </label>
                        </span>
                        <div class="text-right" style="margin-top: -25px">
                            <a href="#">
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn p-t-20" style="padding-bottom: 10px">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>

                    <div class="txt1 text-center p-t-20 p-b-20">
                        <span>
                            Jika ada kendala, bisa menghubungi WA di bawah dengan melampirkan Screenshot
                        </span>
                    </div>
                    <div class="flex-c-t">
                        <a href="https://wa.me/+6281351741856" class="login100-social-item"
                            style="background-color: #00FF00">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ asset('assets2') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('assets2') }}/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2') }}/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets2/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
